<?php

use Bentral\Wordpress\Media;
use Bentral\Wordpress\Token;

if (!class_exists('Bentral_Admin_Properties')) {

    class Bentral_Admin_Properties
    {
        public static function render()
        {
            if (isset($_POST['submit'])) {
                if (wp_verify_nonce($_POST['wp_bentral_submit_nonce'], 'wp_submit_bentral_settings')) {

                };
                ob_clean();
                wp_safe_redirect(admin_url('admin.php?page=bentral-properties'));
            }
            include Bentral::get_plugin_path() . 'templates/admin/properties.php';
        }

        private static function bentral_property_title($property, $lang = 'en')
        {
            if (!in_array($lang, ['en', 'sl', 'de', 'it'])) {
                $lang = 'en';
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
            return htmlspecialchars_decode($post_title);
        }

        private static function get_properties()
        {
            return get_option('bentral_all_properties');
        }

        private static function get_custom_intro()
        {
            return get_option('bentral_custom_intro');
        }

        private static function get_custom_description()
        {
            return get_option('bentral_custom_description');
        }

        private static function set_properties($properties, $lang = '')
        {
            update_option('bentral_all_properties', $properties);
        }

        private static function wp_editor($content, $editor_id, $settings = [])
        {
            if (!class_exists('_WP_Editors', false)) {
                require ABSPATH . WPINC . '/class-wp-editor.php';
            }
            _WP_Editors::editor($content, $editor_id, $settings);
        }

        private static function import($property_id, $unit_id, $force_picture_download)
        {
            global $wpdb;
            ini_set('max_execution_time', 0);
            date_default_timezone_set('Europe/Ljubljana');
            $token           = new Token();
            $media           = new Media();
            $errors          = '';
            $page_template   = get_option('bentral_page_template') ?: Bentral_Admin_Templates::defaultPageTemplate();
            $image_template  = get_option('bentral_image_template') ?: Bentral_Admin_Templates::defaultGalleryTemplate();
            $properties      = self::get_properties();
            $postmeta_option = wp_unslash(get_option('bentral_page_postmeta') ?: '{}');
            $custom_postmeta = json_decode($postmeta_option, true);
            $post_type       = get_option('bentral_import_type') ?: 'page';
            $lang            = $_POST['lang'];
            if ($post_type === 'custom') {
                $post_type = get_option('bentral_custom_import_type');
            }
            $pID  = 'bentral_' . $property_id . '_' . $unit_id;
            $item = $properties[$pID];
            if (!empty($item)) {
                $post_id    = $item['post_id'];
                $property   = $item['property'];
                $unit       = $item['unit'];
                $post_title = self::bentral_property_title($item, $lang);

                if (get_post_status($post_id) !== false) {
                    update_post_meta($post_id, 'post_title', $post_title);
                    update_post_meta($post_id, 'post_name', sanitize_title($post_title));
                    update_post_meta($post_id, 'post_type', $post_type);
                    update_post_meta($post_id, 'post_status', 'publish');
                    update_post_meta($post_id, 'post_content', '');
                } else {
                    $my_post = [
                        'post_title'   => wp_strip_all_tags($post_title),
                        'post_name'    => sanitize_title($post_title),
                        'post_content' => '[PLACEHOLDER]',
                        'post_status'  => 'publish',
                        'post_type'    => $post_type,
                        'post_author'  => intval(get_current_user_id())
                    ];
                    $post_id = wp_insert_post($my_post);
                }
                // update custom postmeta data
                if (is_array($custom_postmeta)) {
                    if (!empty($custom_postmeta)) {
                        foreach ($custom_postmeta as $pm_key => $pm_value) update_post_meta($post_id, $pm_key, $pm_value);
                    }
                }
                // update basic bantel data
                update_post_meta($post_id, 'bentral_property_id', $property['id']);
                update_post_meta($post_id, 'bentral_unit_id', $unit['id']);
                update_post_meta($post_id, 'bentral_property_lat', $property['coordinates']['lat']);
                update_post_meta($post_id, 'bentral_property_lon', $property['coordinates']['lon']);
                update_post_meta($post_id, 'bentral_updated', date('Y-m-d H:i:s'));
                $images_for_download = [];
                $images_for_delete   = [];
                $images_imported     = [];
                $images_bentral      = $unit['images'];

                if ($force_picture_download) {
                    $args        = [
                        'post_parent' => $post_id, 'post_type' => 'attachment', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC',
                    ];
                    $attachments = get_children($args);
                    foreach ($attachments as $attachment) {
                        wp_delete_attachment($attachment->ID);
                    }
                    foreach ($images_bentral as $image) {
                        $media->createFromBentralImageUrl($image['url'], $post_id);
                    }
                } else {
                    $attachments = $media->getPostImageList($post_id);
                    foreach ($attachments as $attachment) {
                        $img_url           = get_post_meta($attachment->ID, 'bentral_property_image_url', true);
                        $images_imported[] = $img_url;
                        $img_exist         = false;
                        foreach ($images_bentral as $image) {
                            if ($image['url'] == $img_url) {
                                $img_exist = true;
                            }
                        }
                        if (!$img_exist) {
                            $images_for_delete[] = $attachment;
                        }
                    }
                    foreach ($images_bentral as $image) {
                        if (!in_array($image['url'], $images_imported)) {
                            $images_for_download[] = $image['url'];
                        }
                    }
                    // download missing images
                    if (!empty($images_for_download)) {
                        foreach ($images_for_download as $image) {
                            $images[] = $media->createFromBentralImageUrl($image, $post_id);
                        }
                    }
                    // delete unused images
                    if (!empty($images_for_delete)) {
                        foreach ($images_for_delete as $image) {
                            wp_delete_attachment($image->ID);
                        }
                    }
                }
                $index       = 0;
                $images_html = [];
                $post_images = $media->getPostImageList($post_id);
                foreach ($post_images as $image) {
                    $images_html[] = $token->replaceImageTokens($image_template, [
                        'url' => wp_get_attachment_image_src($image->ID, 'full')[0], 'thumbUrl' => wp_get_attachment_image_src($image->ID, 'thumbnail')[0]
                    ]);

                    if ($index === 0) {
                        update_post_meta($post_id, 'bentral_first_image_id', $image->ID);
                        $data['mainImage'] = wp_get_attachment_image_src($image->ID, 'full')[0];
                        // SET Featured Image
                        set_post_thumbnail($post_id, $image->ID);
                    }
                    $index++;
                }
                $data['page_id'] = $post_id;
                $data['id']      = $property['id'];
                $data['name']    = $post_title;
                $data['address'] = $property['address'];
                $data['city']    = $property['city'];
                $data['postcode']            = $property['postcode'];
                $data['country']             = $property['country'];
                $data['lon']                 = $property['coordinates']['lon'];
                $data['lat']                 = $property['coordinates']['lat'];
                $data['capacity_basic']      = $unit['capacityBasic'];
                $data['capacity_additional'] = $unit['capacityAdditional'];
                $data['images']              = implode('', $images_html);
                $data['services']            = $unit['services'];
                $post_content                = $token->replacePageTokens($post_id, $property_id, $unit_id, $page_template, $data);
                wp_update_post([
                    'ID'           => $post_id,
                    'post_title'   => $post_title,
                    'post_content' => $post_content,
                    'post_type'    => $post_type,
                ]);

                if (is_wp_error($post_id)) {
                    $errors = $post_id->get_error_messages();
                }
                $properties[$pID]['post_id'] = $post_id;
                $properties[$pID]['updated'] = date('Y-m-d H:i:s');
                self::set_properties($properties);
            }
            wp_die(json_encode([
                'id'      => $post_id,
                'title'   => $post_title,
                'updated' => date('Y-m-d H:i:s'),
                'url'     => get_permalink($post_id),
                'valid'   => 200,
                'errors'  => $errors
            ]));
        }

        public static function find_value($AData, $AKey, $AValue, $ReturnField, $AIgnoreCase = true)
        {
            if (!empty($AData)) {
                foreach ($AData as $rec) {
                    $V = $rec[$AKey];
                    if ($AIgnoreCase) {
                        if (mb_strtolower($V) == mb_strtolower($AValue)) {
                            if (is_array($ReturnField)) {
                                $VALUE = [];
                                for ($i = 1; $i < sizeof($ReturnField); $i++) {
                                    $VALUE[] = $AData[$ReturnField[$i]];
                                }
                                return implode($ReturnField[0], $VALUE);

                            } else {
                                return $rec[$ReturnField];
                            }
                            break;
                        }
                    } else {
                        if ($V == $AValue) {
                            if (is_array($ReturnField)) {
                                $VALUE = [];
                                for ($i = 1; $i < sizeof($ReturnField); $i++) {
                                    $VALUE[] = $AData[$ReturnField[$i]];
                                }
                                return implode($ReturnField[0], $VALUE);

                            } else {
                                return $rec[$ReturnField];
                            }
                            break;
                        }
                    }
                }
            }
        }

        private static function processPropertyUnit($property, $properties_ids, $propertyId, $unitId, $apiKey)
        {
            try {
                set_time_limit(0);
                $bentral_request = new Bentral_Request();
                $api_fields      = '?fields=id,type,label,unofficial_name,capacity_basic,capacity_additional,class_official,class_type,view,size,size_additional,services,images';
                $bentral_request->execute("/v1/properties/{$propertyId}/units/{$unitId}" . $api_fields, $apiKey);
                if ($bentral_request->getResponseCode() === 200) {
                    $unitData = $bentral_request->getData();
                    if (!empty($unitData)) {
                        $pID               = 'bentral_' . $propertyId . '_' . $unitData['id'];
                        $bentralProperties = self::get_properties();
                        $oldPost           = [];
                        $oldPostId         = '';
                        $oldCustomUrl      = '';
                        $oldTags           = '';
                        // copy old Bentrla property from WP
                        if (isset($bentralProperties[$pID])) {
                            $oldPropertyData = $bentralProperties[$pID];
                            if (isset($oldPropertyData['post'])) $oldPost = $oldPropertyData['post'];
                            if (isset($oldPropertyData['post_id'])) $oldPostId = $oldPropertyData['post_id'];
                            if (isset($oldPropertyData['customURL'])) $oldCustomUrl = $oldPropertyData['customURL'];
                            if (isset($oldPropertyData['tags'])) $oldTags = $oldPropertyData['tags'];
                        }
                        $max_guests         = intval(get_option('bentral_max_capacity'));
                        $capacityBasic      = intval($unitData['capacityBasic']);
                        $capacityAdditional = intval($unitData['capacityAdditional']);
                        if ($max_guests < ($capacityBasic + $capacityAdditional)) {
                            update_option('bentral_max_capacity', ($capacityBasic + $capacityAdditional));
                        }
                        $pdata              = [];
                        $pdata['property']  = $property;
                        $pdata['unit']      = $unitData;
                        $pdata['post']      = $oldPost;
                        $pdata['post_id']   = $oldPostId;
                        $pdata['customURL'] = $oldCustomUrl;
                        $pdata['tags']      = $oldTags;

                        if (count($properties_ids) === 1) {
                            $properties_ids   = $properties_ids[0];
                            $pdata['post_id'] = $properties_ids['post_id'];
                        }
                        return $pdata;
                    }
                }
                return null;
            }
            catch (Exception $e) {
                update_option('bentral_sync_error', json_encode($e->getMessage()));
            }
        }

        private static function addNewProperty($propertyId, $unitId, $data)
        {
            $pID              = 'bentral_' . $propertyId . '_' . $unitId;
            $properties       = get_option('bentral_all_properties') ?? [];
            $properties[$pID] = $data;
            update_option('bentral_all_properties', $properties);
        }

        private static function processProperty($propertyId, $apiKey)
        {
            global $wpdb;
            set_time_limit(0);
            $bentral_request  = new Bentral_Request();
            $propertiesIdList = $wpdb->get_results("SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = 'bentral_unit_id' GROUP BY meta_value", ARRAY_A);
            $bentral_request->execute("/v1/properties/{$propertyId}", $apiKey);
            if ($bentral_request->getResponseCode() === 200) {
                $property = $bentral_request->getData();
                $bentral_request->execute("/v1/properties/{$property['id']}/units?fields=id", $apiKey);
                if ($bentral_request->getResponseCode() === 200) {
                    $unitList = $bentral_request->getData();
                    // get all unit data
                    foreach ($unitList as $unitRow) {
                        $propertyData = self::processPropertyUnit($property, $propertiesIdList, $property['id'], $unitRow['id'], $apiKey);
                        // add unit to list
                        self::addNewProperty($property['id'], $unitRow['id'], $propertyData);
                    }
                }
            }
        }

        private static function listOfAllPropertiesAndUnits()
        {
            $apiKey          = get_option('bentral_api_key');
            $bentral_request = new Bentral_Request();
            $bentral_request->execute('/v1/properties', $apiKey);

            $list = [];
            if ($bentral_request->getResponseCode() === 200) {
                $data = $bentral_request->getData();
                update_option('bentral_sync_properties', $data);

                $i = 1;
                foreach ($data as $property) {
                    $propertyId = $property['id'];
                    $bentral_request->execute("/v1/properties/{$propertyId}/units", $apiKey);
                    $list[$propertyId]          = [];
                    $list[$propertyId]['code']  = $bentral_request->getResponseCode();
                    $list[$propertyId]['name']  = $property['name'];
                    $list[$propertyId]['units'] = $bentral_request->getData();
                    $i++;
                }
                update_option('bentral_sync_list', $list);
            }
        }

        public static function properties_list()
        {
            check_ajax_referer('bentral-properties-list-nonce', 'nonce');

            self::listOfAllPropertiesAndUnits();
            date_default_timezone_set('Europe/Ljubljana');
            update_option('bentral_all_properties_update', date('Y-m-d H:i:s'));

            wp_die(json_encode([
                'data' => '', 'valid' => 200,
            ]));
        }

        public static function properties_set_post()
        {
            $property_id   = isset($_POST['property_id']) ? $_POST['property_id'] : '';
            $unit_id       = isset($_POST['unit_id']) ? $_POST['unit_id'] : '';
            $post_id       = isset($_POST['post_id']) ? $_POST['post_id'] : '';
            $postCustomUrl = isset($_POST['customURL']) ? $_POST['customURL'] : '';
            $lang          = isset($_POST['lang']) ? $_POST['lang'] : '';
            $properties    = self::get_properties();
            $unit_name     = "";
            if (!empty($properties)) {
                $pID = 'bentral_' . $property_id . '_' . $unit_id;
                if (!empty($post_id)) {
                    $properties[$pID]['post_id']     = $post_id;
                    $properties[$pID]['post'][$lang] = $post_id;

                    if ((!isset($properties[$pID]['customURL'])) || (!is_array($properties[$pID]['customURL']))) {
                        $properties[$pID]['customURL'] = [];
                    }
                    $properties[$pID]['customURL'][$lang] = $postCustomUrl;

                    update_post_meta($post_id, 'bentral_property_id', $properties[$pID]['property']['id']);
                    update_post_meta($post_id, 'bentral_unit_id', $properties[$pID]['unit']['id']);
                    update_post_meta($post_id, 'bentral_property_lat', $properties[$pID]['property']['coordinates']['lat']);
                    update_post_meta($post_id, 'bentral_property_lon', $properties[$pID]['property']['coordinates']['lon']);

                    $img_full_url = "";
                    $img_full     = wp_get_attachment_image_src($properties[$pID]['unit']['images'][0]['url'], 'full');
                    if (!empty($img_full)) {
                        $img_full_url = $img_full[0];
                    }
                    $img_thumbnail_url = "";
                    $img_thumbnail     = wp_get_attachment_image_src($properties[$pID]['unit']['images'][0]['url'], 'thumbnail');
                    if (!empty($img_thumbnail)) {
                        $img_thumbnail_url = $img_thumbnail[0];
                    }
                    update_post_meta($post_id, 'bentral_first_image_id', [
                        'url' => $img_full_url, 'thumbUrl' => $img_thumbnail_url
                    ]);
                    $unit_name = '<a href="' . get_permalink($post_id) . '" target="_blank">' . self::bentral_property_title($properties[$pID]) . '</a>';
                } else {
                    $post_id                              = $properties[$pID]['post_id'];
                    $properties[$pID]['post_id']          = null;
                    $properties[$pID]['post'][$lang]      = null;
                    $properties[$pID]['customURL'][$lang] = null;
                    $pID                                  = 'bentral_' . $properties[$pID]['property']['id'] . '_' . $properties[$pID]['unit']['id'];
                    $unit_name                            = self::bentral_property_title($properties[$pID]);
                    delete_post_meta($post_id, 'bentral_property_id');
                    delete_post_meta($post_id, 'bentral_unit_id');
                    delete_post_meta($post_id, 'bentral_property_lat');
                    delete_post_meta($post_id, 'bentral_property_lon');
                    delete_post_meta($post_id, 'bentral_first_image_id');
                }
                self::set_properties($properties);
            }

            wp_die(json_encode([
                'link' => get_permalink($post_id), 'property_link' => $unit_name, 'data' => 'OK', 'valid' => 200,
            ]));
        }

        public static function properties_import()
        {
            $propertyId   = $_POST['property_id'];
            $unitId       = $_POST['unit_id'];
            $force_import = (intval($_POST['force_import']) == 1) ? true : false;
            self::property_sync($propertyId, $unitId, false);
            self::import($propertyId, $unitId, $force_import);
        }

        public static function property_sync($property = null, $unit = null, $die = true)
        {
            global $wpdb;
            $propertyId        = ($property == null) ? $_POST['property_id'] : $property;
            $propertyUnitId    = ($unit == null) ? $_POST['unit_id'] : $unit;
            $propertiesIdList  = $wpdb->get_results("SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = 'bentral_unit_id' GROUP BY meta_value", ARRAY_A);
            $apiKey            = get_option('bentral_api_key');
            $request           = new Bentral_Request();
            $propertyListPosts = self::propertyListPosts();
            $request->execute("/v1/properties/{$propertyId}", $apiKey);
            if ($request->getResponseCode() === 200) {
                $propertyData            = self::processPropertyUnit($request->getData(), $propertiesIdList, $propertyId, $propertyUnitId, $apiKey);
                $propertyData['updated'] = date('Y-m-d H:i:s');
                $property                = $propertyData['property'];
                $propertyUnit            = $propertyData['unit'];
                $customIntro             = get_option('bentral_custom_intro');
                $customDescription       = get_option('bentral_custom_description');
                self::addNewProperty($propertyId, $propertyUnitId, $propertyData);
            }

            $propertyHTML = '';
            include Bentral::get_plugin_path() . 'includes/table/unit.php';
            if ($die) {
                wp_die(json_encode(['data' => $propertyHTML, 'valid' => 200]));
            }
        }

        public static function properties_delete()
        {
            $post_id = $_POST['post_id'];
            if (!empty($post_id)) {
                $attachments = get_attached_media('', $post_id);
                foreach ($attachments as $attachment) {
                    wp_delete_attachment($attachment->ID, 'true');
                }
                $post_meta = get_post_meta($post_id);
                foreach ($post_meta as $key => $val) {
                    delete_post_meta($post_id, $key);
                }
                wp_delete_post($post_id, true);

                $properties_delete = get_option('bentral_delete_properties');
                if (($k = array_search($post_id, $properties_delete)) !== false) {
                    unset($properties_delete[$k]);
                    update_option('bentral_delete_properties', $properties_delete);
                }
            }

            wp_die(json_encode([
                'id' => $post_id, 'valid' => 200,
            ]));

        }

        public static function properties_desc()
        {
            check_ajax_referer('bentral-properties-desc-nonce', 'nonce');
            $intro       = $_POST['intro'];
            $tags        = $_POST['tags'];
            $description = $_POST['description'];
            $property    = $_POST['property'];
            $unit        = $_POST['unit'];
            $lang        = $_POST['lang'];
            if ($lang == null) {
                $lang = get_option('bentral_form_language');
            }

            // INTRO
            $customIntro = self::get_custom_intro();
            if (empty($customIntro)) {
                $customIntro = [];
            }
            $customIntro['bentral_' . $property . '_' . $unit][$lang] = htmlspecialchars($intro);
            update_option('bentral_custom_intro', $customIntro);

            // DESCRIPTION
            $customDescription = self::get_custom_description();
            if (empty($customDescription)) {
                $customDescription = [];
            }
            $customDescription['bentral_' . $property . '_' . $unit][$lang] = htmlspecialchars($description);
            update_option('bentral_custom_description', $customDescription);

            // TAGS
            $properties                                               = self::get_properties();
            $properties['bentral_' . $property . '_' . $unit]['tags'] = $tags;
            update_option('bentral_all_properties', $properties);

            wp_die(json_encode([
                'data' => 'OK', 'valid' => 200,
            ]));
        }

        private static function propertyListPosts()
        {
            $post_type = get_option('bentral_import_type') ?: 'page';
            if ($post_type === 'custom') {
                $post_type = get_option('bentral_custom_import_type');
            }
            $query = new WP_Query([
                'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC'
            ]);
            return $query->posts;
        }

        public static function properties_table()
        {
            check_ajax_referer('bentral-properties-table-nonce', 'nonce');

            $propertyListPosts  = self::propertyListPosts();
            $customIntro        = self::get_custom_intro();
            $custom_description = self::get_custom_description();
            $propertyHTML       = '';
            include Bentral::get_plugin_path() . 'includes/table/units.php';
            wp_die(json_encode(['data' => $propertyHTML, 'valid' => 200]));
        }

        public static function unit_delete()
        {
            $propertyId = isset($_POST['property_id']) ? $_POST['property_id'] : '';
            $unitId     = isset($_POST['unit_id']) ? $_POST['unit_id'] : '';
            $pId        = 'bentral_' . $propertyId . '_' . $unitId;
            $properties = get_option('bentral_all_properties');
            $newData    = [];
            foreach ($properties as $key => $property) {
                if ($key != $pId) {
                    $newData[] = $property;
                }
            }
            update_option('bentral_all_properties', $newData);
            wp_die(json_encode([
                'status' => true, 'valid' => 200
            ]));
        }

        public static function delete_all()
        {
            delete_option('bentral_all_properties');
            delete_option('bentral_all_properties_update');
            delete_option('bentral_sync_properties');
            delete_option('bentral_delete_properties');
            delete_option('bentral_max_capacity');

            /*
            $properties = self::get_properties();
            foreach ($properties as $property) {
                $post_id = $property['post_id'];
                if (!empty($post_id)) {
                    $attachments = get_attached_media('', $post_id);
                    foreach ($attachments as $attachment) {
                        wp_delete_attachment($attachment->ID, 'true');
                    }
                    $post_meta = get_post_meta($post_id);
                    foreach ($post_meta as $key => $val) {
                        delete_post_meta($post_id, $key);
                    }
                    wp_delete_post($post_id, true);

                    $properties_delete = get_option('bentral_delete_properties');
                    if (($k = array_search($post_id, $properties_delete)) !== false) {
                        unset($properties_delete[$k]);
                    }
                }
            }
            */

            wp_die(json_encode([
                'status' => true, 'valid' => 200,
            ]));
        }

        public static function load_language()
        {
            check_ajax_referer('bentral-load-language-nonce', 'nonce');
            wp_die(json_encode([
                'data' => 'OK', 'valid' => 200,
            ]));
        }

        public static function save_language()
        {
            check_ajax_referer('bentral-save-language-nonce', 'nonce');
            wp_die(json_encode([
                'data' => 'OK', 'valid' => 200,
            ]));
        }

        public static function result_template()
        {
            check_ajax_referer('bentral-result-template--nonce', 'nonce');

            $data = Bentral_Admin_Templates::templateResults($_POST['template']);

            wp_die(json_encode([
                'template' => $data['template'], 'style' => $data['style'], 'valid' => 200,
            ]));
        }
    }
}