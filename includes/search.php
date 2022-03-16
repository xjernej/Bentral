<?php

use Bentral\Request;
use Bentral\Token\TokenInterface;

class Bentral_Search
{
    private $debugLog = [];
    private $isDebug  = false;

    public function V($d, $f, $e = '')
    {
        if (isset($d[$f])) {
            if ($d[$f] != '') {
                return $d[$f];
            } else {
                return $e;
            }
        } else {
            return $e;
        }
    }

    public function D($var, $data)
    {
        if ($this->isDebug) {
            $this->debugLog[$var] = $data;
        }
    }

    public function auto_page_language()
    {
        $uri_segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if (count($uri_segments) >= 2) {
            $url_lang = $uri_segments[1];
            if (in_array($url_lang, ['si', 'sl'])) {
                $lang_code = 'sl';
            }
            if (in_array($url_lang, ['en', 'uk'])) {
                $lang_code = 'en';
            }
        }

        if ($lang_code == 'index.php') {
            $uri_segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if (count($uri_segments) >= 2) {
                $url_lang = $uri_segments[2];
                if (in_array($url_lang, ['si', 'sl'])) {
                    $lang_code = 'sl';
                }
                if (in_array($url_lang, ['en', 'uk'])) {
                    $lang_code = 'en';
                }
            }
        }

        if (empty($lang_code)) {
            return get_option('bentral_form_language');
        }
        return $lang_code;
    }

    public function page_language()
    {
        $selected_lang    = '';
        $detect_lang_code = intval(get_option('bentral_form_detect_lang'));
        if ($detect_lang_code == 1) {
            $language_plugin = get_option('bentral_language_plugin');
            switch ($language_plugin) {
                case 'wpml':
                    if (!empty(ICL_LANGUAGE_CODE)) {
                        $selected_lang = ICL_LANGUAGE_CODE;
                    }
                    break;
                case 'loco':
                case 'polylang':
                    if (function_exists('pll_current_language')) {
                        $selected_lang = pll_current_language();
                    }
                    break;
                case 'translatepress':
                    $lang_iso      = get_locale();
                    $settings      = get_option('trp_settings', false);
                    $slugs         = $this->V($settings, 'url-slugs');
                    $selected_lang = $this->V($slugs, $lang_iso);
                    break;
                case 'weglot':
                    $selected_lang = weglot_get_current_language();
                    break;
                default: // auto
                    $selected_lang = self::auto_page_language();
                    break;
            }
            if (empty($selected_lang)) {
                $selected_lang = self::auto_page_language();
            }
            return $selected_lang;
        } else {
            return get_option('bentral_form_language');
        }
    }

    public function get_properties()
    {
        return get_option('bentral_all_properties');
    }

    public function unparse_url($parsed_url)
    {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass'] : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }

    public function bentral_page_search_paramters($page_link, $from = null, $to = null, $persons = null)
    {
        $params = [];
        if (!empty($from)) {
            $params[] = "arrival={$from}";
        }
        if (!empty($to)) {
            $params[] = "departure={$to}";
        }
        if (!empty($persons)) {
            $params[] = "persons={$persons}";
        }
        return (strpos($page_link, '?') === false) ? $page_link . '?' . implode('&', $params) : $page_link . '&' . implode('&', $params);
    }

    public function bentral_custom_url($customPageUrl, $from = null, $to = null, $persons = null)
    {
        if (!empty($customPageUrl)) {
            return $this->bentral_page_search_paramters($customPageUrl, $from, $to, $persons);
        }
        return '';
    }

    public function bentral_page_url($page_id, $add_page_lang_link, $search_lang, $from = null, $to = null, $persons = null)
    {
        $custom_url = trim(get_option('bentral_results_custom_url'));
        $page_link  = get_page_link($page_id);
        if ($add_page_lang_link == 1) {
            $search_lang_url = $search_lang;
            if (!empty($custom_url)) {
                $search_lang_url .= '/' . $custom_url;
            }
            $p               = parse_url($page_link);
            $language_plugin = get_option('bentral_language_plugin');
            switch ($language_plugin) {
                case 'wpml':
                    $p['path'] = '/' . $search_lang_url . $p['path'];
                    break;
                case 'loco':
                case 'polylang':
                    $p['path'] = '/' . $search_lang_url . $p['path'];
                    break;
                case 'translatepress':
                    $settings    = get_option('trp_settings', false);
                    $defaultLang = get_option('bentral_form_language');
                    if ($defaultLang !== $search_lang) {
                        if (strpos($p['path'], $defaultLang) === false) {
                            $p['path'] = '/' . $search_lang_url . $p['path'];
                        } else {
                            $p['path'] = str_replace('/' . $defaultLang . '/', '/' . $search_lang_url . '/', $p['path']);
                        }
                    } else {
                        if (isset($settings['add-subdirectory-to-default-language']) && $settings['add-subdirectory-to-default-language'] !== 'yes') {
                            $p['path'] = '/' . $search_lang_url . $p['path'];
                        }
                    }
                    break;
                case 'weglot':
                    $p['path'] = '/' . $search_lang_url . $p['path'];
                    break;
                default:
                    $p['path'] = '/' . $search_lang_url . $p['path'];
                    break;
            }
            $page_link = $this->unparse_url($p);
        } else {
            $p         = parse_url($page_link);
            $p['path'] = $custom_url . $p['path'];
            $page_link = $this->unparse_url($p);
        }

        return $this->bentral_page_search_paramters($page_link, $from, $to, $persons);
    }

    public function search($lang, $persons, $from, $to, $tags)
    {
        $this->isDebug = boolval(get_option('bentral_search_debug'));
        $allowedTags   = ($tags != '*') ? explode(',', $tags) : [];
        try {
            $apiKey        = get_option('bentral_api_key');
            $page_language = $lang;
            if (empty($page_language)) {
                $page_language = self::page_language();
            }
            $lng                       = [];
            $bentral_type              = get_option('bentral_type');
            $custom_lang               = json_decode(wp_unslash(get_option('bentral_lang_settings')), true);
            $search_title_type         = get_option('bentral_result_property_title');
            $add_page_lang_link        = intval(get_option('bentral_result_property_lang_url') ?: '0');
            $enableCustomResultSiteUrl = intval(get_option('bentral_custom_result_site_url'));

            if (isset($custom_lang[$page_language])) {
                $lng = $custom_lang[$page_language];
            }
            $empty_html = wp_unslash(get_option('bentral_empty_search_result'));
            $error_html = wp_unslash(get_option('bentral_error_search_result'));

            if (!is_numeric($persons)) {
                return str_replace('{{ message }}', 'Param $persons must be a number', $error_html);
            }

            if (!DateTime::createFromFormat('Y-m-d', $from) || !DateTime::createFromFormat('Y-m-d', $to)) {
                return str_replace('{{ message }}', 'Either $from or $to param is not a valid DateTime format.', $error_html);
            }
            $page_title_type = get_option('bentral_page_title_type');
            $bentral_request = new Bentral_Request();
            $bentral_request->execute("/v1/properties/search?persons={$persons}&from={$from}&to={$to}&lang={$lang}", $apiKey);

            $this->D('url', "/v1/properties/search?persons={$persons}&from={$from}&to={$to}&lang={$lang}");
            $this->D('apiKey', $apiKey);
            $this->D('ResponseCode', $bentral_request->getResponseCode());
            $this->D('ResponseData', $bentral_request->getData());
            if ($this->debugLog) {
                return '<pre style="width: 100%">' . json_encode($this->debugLog, JSON_PRETTY_PRINT) . '</pre>';
            }

            if ($bentral_request->getResponseCode() == 200) {
                $units = $bentral_request->getData();
                $this->D('ResponseData', $units);
                if (empty($units)) {
                    if (isset($lng['results_empty'])) {
                        if (!empty($lng['results_empty'])) {
                            return str_replace('{{ message }}', $lng['results_empty'], $empty_html);
                        } else {
                            return str_replace('{{ message }}', 'No results', $empty_html);
                        }
                    } else {
                        return str_replace('{{ message }}', 'No results', $empty_html);
                    }
                } else {
                    $result     = '';
                    $template   = wp_unslash(get_option('bentral_search_result_template') ?: trim(Bentral_Admin_Templates::defaultResultsTemplate()));
                    $properties = $this->get_properties();

                    $custom_intro       = get_option('bentral_custom_intro');
                    $custom_description = get_option('bentral_custom_description');

                    foreach ($units as $unit) {
                        $customPageUrl = '';
                        $pID           = 'bentral_' . $unit['property_id'] . '_' . $unit['unit_id'];

                        if (isset($properties[$pID])) {
                            $property_data = $properties[$pID];
                            $property      = $property_data['property'];
                            $property_unit = $property_data['unit'];

                            $property_tags = '';
                            if (isset($property_data['tags'])) {
                                $property_tags = explode(',', $property_data['tags']);
                            }
                            $post_id = '';
                            if ($bentral_type == 'bentral_full') {
                                $post_id = $property_data['post_id'];
                            } else {
                                if (isset($property_data['post'])) {
                                    if (isset($property_data['post'][$page_language])) {
                                        $post_id = $property_data['post'][$page_language];
                                    }
                                }
                                if (isset($property_data['customURL'])) {
                                    if (isset($property_data['customURL'][$page_language])) {
                                        $customPageUrl = $property_data['customURL'][$page_language];
                                    }
                                }
                            }
                        }
                        // check wi
                        $tagFound = true;
                        if (!empty($allowedTags)) {
                            $tagFound = false;
                            if (!empty($property_tags)) {
                                foreach ($property_tags as $tag) {
                                    if (in_array($tag, $allowedTags)) {
                                        $tagFound = true;
                                        break;
                                    }
                                }
                            }
                        }

                        if ($tagFound == false) {
                            continue;
                        }

                        if (empty($post_id)) {
                            continue;
                        }

                        $custom_image_path = get_option('bentral_custom_image_path');
                        if (empty($custom_image_path)) {
                            $img_url = Bentral::get_plugin_url() . 'assets/placeholder-image.jpg';
                        } else {
                            $img_url = $custom_image_path . 'd4-bentral/assets/placeholder-image.jpg';
                        }

                        //#region IMAGE

                        // bentral first image
                        $thumbSource = get_option('bentral_thumbnail_source');
                        if ($thumbSource == 'bentral') {
                            if (isset($property_unit['images'])) {
                                if (count($property_unit['images']) > 0) {
                                    $img_url = $property_unit['images'][0]['url'];
                                }
                            } else {
                                if (isset($property['images'])) {
                                    if (count($property['images']) > 0) {
                                        $img_url = $property['images'][0]['url'];
                                    }
                                }
                            }
                        } else {
                            $thumbSize = get_option('bentral_thumbnail_size') ?: 'medium';
                            $thumb     = wp_get_attachment_image_src(get_post_meta($post_id, 'bentral_first_image_id', true), $thumbSize);
                            if ($thumb !== false) {
                                $img_url = $thumb[0];
                            } else {
                                // post thumb image
                                $thumb_img = get_the_post_thumbnail($post_id, 'medium');
                                preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $thumb_img, $r);
                                $img_url = array_pop($r);
                            }
                            // unit imgage
                            if (empty($img_url)) {
                                if (isset($property_unit['images'])) {
                                    if (count($property_unit['images']) > 0) {
                                        $img_url = $property_unit['images'][0]['url'];
                                    }
                                }
                            }
                            // property image
                            if (empty($img_url)) {
                                if (isset($property['images'])) {
                                    if (count($property['images']) > 0) {
                                        $img_url = $property['images'][0]['url'];
                                    }
                                }
                            }
                        }
                        //#endregion

                        //#region TITLE
                        $unit_label = $property_unit['unofficialName'];
                        if (empty($unit_label)) {
                            $unit_label = ucfirst($property_unit['type']) . ' ' . $property_unit['label'];
                        }
                        if ($search_title_type == 'bentral') {
                            switch ($page_title_type) {
                                case 'property':
                                    $post_title = $property['name'];
                                    break;
                                case 'unit':
                                    $post_title = $unit_label;
                                    break;
                                default :
                                    if (!empty($unit_label)) {
                                        $unit_label = ' - ' . $unit_label;
                                    }
                                    $post_title = $property['name'] . $unit_label;
                                    break;
                            }
                        } else {
                            $post_title = get_the_title($post_id);
                        }
                        //#endregion

                        if ($enableCustomResultSiteUrl == 1) {
                            $page_link = $this->bentral_custom_url($customPageUrl, $from, $to, $persons);
                        } else {
                            $page_link = $this->bentral_page_url($post_id, $add_page_lang_link, $lang, $from, $to, $persons);
                        }

                        //#region REPLACE DATA

                        $introText = '';
                        if (isset($custom_intro[$pID])) {
                            $intro = $custom_intro[$pID];
                            if (isset($intro[$page_language])) {
                                $introText = nl2br(htmlspecialchars_decode($intro[$page_language]));
                            }
                        }

                        $descriptionText = '';
                        if (isset($custom_description[$pID])) {
                            $description = $custom_description[$pID];
                            if (isset($description[$page_language])) {
                                $descriptionText = nl2br(htmlspecialchars_decode($description[$page_language]));
                                $descriptionText = str_ireplace('<p>', '', $descriptionText);
                                $descriptionText = str_ireplace('</p>', '', $descriptionText);
                            }
                        }

                        $templatePost = [
                            'ID'                  => $post_id,
                            'title'               => $post_title,
                            'property_title'      => $property['name'],
                            'price'               => $unit['amount'],
                            'currency'            => $unit['currency'],
                            'address'             => $property['address'] . ', ' . $property['zip'] . ' ' . $property['city'],
                            'capacity_basic'      => $property_unit['capacityBasic'],
                            'capacity_additional' => $property_unit['capacityAdditional'],
                            'link'                => $page_link, 'thumb' => $img_url,
                            'property'            => $property,
                            'unit'                => $property_unit,
                            'floor_size'          => $property_unit['size']
                        ];

                        $STAR_ON  = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg>';
                        $STAR_OFF = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-gray-400"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg>';

                        $item   = str_replace(TokenInterface::EMBED_RESULT_LINK, $this->V($templatePost, 'link'), $template);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_IMAGE_URL, $this->V($templatePost, 'thumb'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_TITLE, $this->V($templatePost, 'title'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_PROPERTY_TITLE, $this->V($templatePost, 'property_title'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_ADDRESS, $this->V($templatePost, 'address'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_BASIC_TITLE, $this->V($lng, 'capacity_basic'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_BASIC_VALUE, $this->V($templatePost, 'capacity_basic', 0), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_TITLE, $this->V($lng, 'capacity_additional'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_VALUE, $this->V($templatePost, 'capacity_additional', 0), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_PRICE, $this->V($templatePost, 'price'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_CURRENCY, $this->V($templatePost, 'currency'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_BOOK_TITLE, $this->V($lng, 'book'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_FLOOR_SIZE, $this->V($templatePost, 'floor_size'), $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_INTRO, $introText, $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_DESCRIPTION, $descriptionText, $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_STAR_ON, $STAR_ON, $item);
                        $item   = str_replace(TokenInterface::EMBED_RESULT_STAR_OFF, $STAR_OFF, $item);
                        $result .= $item;
                    }
                    //#endregion

                    if (empty($result)) {
                        return str_replace('{{ message }}', $lng['results_empty'], $empty_html);
                    }
                    return $result;
                }
            } else {
                $message = $bentral_request->getData();
                if (isset($message->errors)) {
                    return str_replace('{{ message }}', json_encode($message->errors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), $error_html);
                } else if (isset($message['message'])) {
                    return str_replace('{{ message }}', $message['message'], $error_html);
                } else {
                    return str_replace('{{ message }}', $lng['results_error'], $error_html);
                }
            }
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
}