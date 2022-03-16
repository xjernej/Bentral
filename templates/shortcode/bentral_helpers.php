<?php

if (!function_exists('V')) {
    function V($d, $f, $e = '')
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
}

if (!function_exists('auto_page_language')) {
    function auto_page_language()
    {
        $lang_code    = '';
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
}

if (!function_exists('page_language')) {
    function page_language()
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
                    $slugs         = V($settings, 'url-slugs');
                    $selected_lang = V($slugs, $lang_iso);
                    break;
                case 'weglot':
                    $selected_lang = weglot_get_current_language();
                    break;
                default: // auto
                    $selected_lang = auto_page_language();
                    break;
            }
            if (empty($selected_lang)) {
                $selected_lang = auto_page_language();
            }
            return $selected_lang;
        } else {
            return get_option('bentral_form_language');
        }
    }
}

if (!function_exists('bentral_widget_language')) {
    function bentral_widget_language()
    {
        $lang = page_language();
        if (in_array($lang, ['si', 'sl'])) {
            $lang = 'sl';
        }
        if (in_array($lang, ['en', 'uk'])) {
            $lang = 'en';
        }
        return $lang;
    }
}

if (!function_exists('bentral_unit_data')) {
    function bentral_unit_data($pageId, $lang)
    {
        $properties = get_option('bentral_all_properties');
        if (empty($properties)) {
            return null;
        }
        $linkType = get_option('bentral_type') ?: 'bentral_search';
        switch ($linkType) {
            case 'bentral_full':
                foreach ($properties as $property) {
                    $postId = V($property, 'post_id');
                    if ($postId == $pageId) {
                        return $property;
                    }
                }
                break;
            default:
                foreach ($properties as $property) {
                    $postIds = V($property, 'post');
                    if (V($postIds, $lang) == $pageId) {
                        return $property;
                    }
                }
                break;
        }
        return null;
    }
}

if (!function_exists('bentral_property_data')) {
    function bentral_property_data($propertyId, $unitId)
    {
        $properties = get_option('bentral_all_properties');
        if (empty($properties)) {
            return null;
        }

        $pID = 'bentral_' . $propertyId . '_' . $unitId;
        return V($properties, $pID);
    }
}

if (!function_exists('bentral_first_unit')) {
    function bentral_first_unit()
    {
        $properties = get_option('bentral_all_properties');
        if (empty($properties)) {
            return null;
        }
        foreach ($properties as $property) {
            return $property;
        }
    }
}

if (!function_exists('bentral_property_title')) {
    function bentral_property_title($property, $post_id = null, $lang = null, $ignorePropertyTitleType = false)
    {
        $search_title_type = get_option('bentral_result_property_title');
        if ($ignorePropertyTitleType) {
            $search_title_type = 'bentral';
        }
        if ($search_title_type == 'bentral') {

            if ($lang == null) {
                $lang = page_language();
            }

            $title_type = get_option('bentral_page_title_type');
            switch ($title_type) {
                case 'property':
                    $post_title = $property['property']['name'];
                    break;
                case 'unit':
                    $post_title = $property['unit']['label'];
                    break;
                case 'type_unit':
                    $post_title = ucfirst($property['unit']['type']) . ' ' . $property['unit']['label'];
                    break;
                case 'property_unit':
                    $post_title = $property['property']['name'];
                    if (!empty($property['unit']['label'])) {
                        $post_title .= ' - ' . ucfirst($property['unit']['label']);
                    }
                    break;
                case 'property_type_unit':
                    $post_title = $property['property']['name'];
                    if (!empty($property['unit']['type'])) {
                        $post_title .= ' - ' . ucfirst($property['unit']['type']);
                    }
                    if (!empty($property['unit']['label'])) {
                        $post_title .= ' - ' . ucfirst($property['unit']['label']);
                    }
                    break;
                case 'unofficial':
                    $post_title = ucfirst($property['unit']['unofficialName']);
                    break;
                case 'property_unofficial':
                    $post_title = $property['property']['name'];
                    if (!empty($property['unit']['unofficialName'])) {
                        $post_title .= ' - ' . ucfirst($property['unit']['unofficialName']);
                    }
                    break;
                case 'official':
                    if (!empty($property['unit']['officialName'])) {
                        $key = array_search($lang, array_column($property['unit']['officialName'], 'language'));
                        if ($key !== false) {
                            $post_title = $property['unit']['officialName'][$key]['title'];
                        } else {
                            $post_title = $property['unit']['officialName'][0]['title'];
                        }
                    } else {
                        $post_title = 'Uradno ime ni izpolnjeno [ ' . ucfirst($property['unit']['type']) . ' ' . $property['unit']['label'] . ' - ' . ucfirst($property['unit']['unofficialName']) . ' ]';
                    }
                    break;
                case 'property_official':
                    if (!empty($property['unit']['officialName'])) {
                        $key = array_search($lang, array_column($property['unit']['officialName'], 'language'));
                        if ($key !== false) {
                            $post_title = $property['property']['name'] . ' - ' . $property['unit']['officialName'][$key]['title'];
                        } else {
                            $post_title = $property['property']['name'] . ' - ' . $property['unit']['officialName'][0]['title'];
                        }
                    } else {
                        $post_title = 'Uradno ime ni izpolnjeno [ ' . ucfirst($property['unit']['type']) . ' ' . $property['unit']['label'] . ' - ' . ucfirst($property['unit']['unofficialName']) . ' ]';
                    }
                    break;
            }
            if (empty($post_title)) {
                $post_title = $property['property']['name'] . ' - ' . $property['unit']['name'];

            }
        } else {
            $post_title = get_the_title($post_id);
        }
        return htmlspecialchars_decode($post_title);
    }
}

if (!function_exists('bentral_property_post_id')) {
    function bentral_property_post_id($property, $pageLanguage)
    {
        $post_id      = '';
        $bentral_type = get_option('bentral_type') ?: 'page';

        if ($bentral_type == 'bentral_full') {
            $post_id = $property['post_id'];
        } else {
            if (isset($property['post'])) {
                if (isset($property['post'][$pageLanguage])) {
                    $post_id = $property['post'][$pageLanguage];
                }
            }
        }
        return $post_id;
    }
}

if (!function_exists('bentral_property_image')) {
    function bentral_property_image($property, $post_id)
    {
        $img_url     = '';
        $thumbSource = get_option('bentral_thumbnail_source');
        if ($thumbSource == 'bentral') {
            if (isset($property['images'])) {
                if (count($property['images']) > 0) {
                    $img_url = $property['images'][0]['url'];
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
            };
            // unit image
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
        return $img_url;
    }
}

if (!function_exists('bentral_page_date_format')) {
    function bentral_page_date_format($page_lang, $custom_lang)
    {
        $days_from_today = intval(get_option('bentral_form_days_from_today'));
        $days_between    = intval(get_option('bentral_form_days_between_dates'));
        if (empty($days_between)) {
            $days_between = 2;
        } else {
            $days_between += 1;
        }
        $lang        = V($custom_lang, $page_lang);
        $date_format = V(V($lang, 'date_format'), 'dropdown');
        if ($days_from_today > 0) {
            $str_time_from = date('Y-m-d') . " + {$days_from_today} days";
        } else {
            $str_time_from = date('Y-m-d');
        }

        $str_time_to = date('Y-m-d') . " + {$days_between} days";
        $time_form   = strtotime($str_time_from);
        $time_to     = strtotime($str_time_to);
        $month_form  = date("m", $time_form);
        $month_to    = date("m", $time_to);
        $langMonth   = V($lang, 'month');
        return [
            'format'       => $date_format,
            'date_from'    => date('Y-m-d', $time_form),
            'date_to'      => date('Y-m-d', $time_to),
            'display_from' => date($date_format, $time_form),
            'display_to'   => date($date_format, $time_to),
            'day_from'     => date('d', $time_form),
            'day_to'       => date('d', $time_to),
            'month_from'   => V($langMonth, 'mon' . intval($month_form)),
            'month_to'     => V($langMonth, 'mon' . intval($month_to))
        ];
    }
}

if (!function_exists('wp_parse_url')) {
    function wp_parse_url($url, $component = -1)
    {
        $to_unset = [];
        $url      = (string)$url;

        if ('//' === substr($url, 0, 2)) {
            $to_unset[] = 'scheme';
            $url        = 'placeholder:' . $url;
        } elseif ('/' === substr($url, 0, 1)) {
            $to_unset[] = 'scheme';
            $to_unset[] = 'host';
            $url        = 'placeholder://placeholder' . $url;
        }

        $parts = parse_url($url);

        if (false === $parts) {
            // Parsing failure.
            return $parts;
        }

        // Remove the placeholder values.
        foreach ($to_unset as $key) {
            unset($parts[$key]);
        }

        return _get_component_from_parsed_url_array($parts, $component);
    }
}

if (!function_exists('unparse_url')) {
    function unparse_url($parsed_url)
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
}

if (!function_exists('create_page_link')) {
    function create_page_link($page_id, $add_page_lang_link, $search_lang)
    {
        $page_link = get_page_link($page_id);
        if ($add_page_lang_link == 1) {
            $p               = parse_url($page_link);
            $language_plugin = get_option('bentral_language_plugin');
            switch ($language_plugin) {
                case 'wpml':
                    $p['path'] = '/' . $search_lang . $p['path'];
                    break;
                case 'loco':
                case 'polylang':
                    $p['path'] = '/' . $search_lang . $p['path'];
                    break;
                case 'translatepress':
                    $settings    = get_option('trp_settings', false);
                    $defaultLang = get_option('bentral_form_language');
                    if ($defaultLang !== $search_lang) {
                        if (strpos($p['path'], $defaultLang) === false) {
                            $p['path'] = '/' . $search_lang . $p['path'];
                        } else {
                            $p['path'] = str_replace('/' . $defaultLang . '/', '/' . $search_lang . '/', $p['path']);
                        }
                    } else {
                        if (isset($settings['add-subdirectory-to-default-language']) && $settings['add-subdirectory-to-default-language'] !== 'yes') {
                            $p['path'] = '/' . $search_lang . $p['path'];
                        }
                    }
                    break;
                case 'weglot':
                    $p['path'] = '/' . $search_lang . $p['path'];
                    break;
                default: // auto
                    $p['path'] = '/' . $search_lang . $p['path'];
                    break;
            }
            $page_link = unparse_url($p);
        }
        return $page_link;
    }
}