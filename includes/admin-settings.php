<?php

if (!class_exists('Bentral_Admin_Settings')) {
    class Bentral_Admin_Settings
    {
        public function init()
        {
            add_action('wp_ajax_bentral_verify_key', [$this, 'verify_key']);
            add_action('wp_ajax_bentral_properties_list', [Bentral_Admin_Properties::class, 'properties_list']);
            add_action('wp_ajax_bentral_properties_import', [Bentral_Admin_Properties::class, 'properties_import']);
            add_action('wp_ajax_bentral_property_sync', [Bentral_Admin_Properties::class, 'property_sync']);
            add_action('wp_ajax_bentral_properties_set_post', [Bentral_Admin_Properties::class, 'properties_set_post']);
            add_action('wp_ajax_bentral_properties_table', [Bentral_Admin_Properties::class, 'properties_table']);
            add_action('wp_ajax_bentral_properties_desc', [Bentral_Admin_Properties::class, 'properties_desc']);
            add_action('wp_ajax_bentral_load_language', [Bentral_Admin_Properties::class, 'load_language']);
            add_action('wp_ajax_bentral_save_language', [Bentral_Admin_Properties::class, 'save_language']);
            add_action('wp_ajax_bentral_result_template', [Bentral_Admin_Properties::class, 'result_template']);
            add_action('wp_ajax_bentral_delete_all', [Bentral_Admin_Properties::class, 'delete_all']);
            add_action('wp_ajax_bentral_unit_delete', [Bentral_Admin_Properties::class, 'unit_delete']);
            add_action('wp_ajax_bentral_properties_delete', [Bentral_Admin_Properties::class, 'properties_delete']);
            add_action('admin_enqueue_scripts', [$this, 'set_assets']);
        }

        public function set_assets($hook_suffix)
        {
            $version  = Bentral::version();
            $compPath = Bentral::get_plugin_url() . 'assets/components/';

            if ($hook_suffix === 'toplevel_page_bentral-options') {
                wp_enqueue_style('bentral-select2-css', $compPath . 'select2/css/select2.min.css');
                wp_enqueue_script('bentral-select2-js', $compPath . 'select2/js/select2.min.js', ['jquery']);
                wp_enqueue_script('bentral-block-js', Bentral::get_plugin_url() . 'assets/components/blockUI/jquery.blockUI.js', ['jquery'], filemtime(Bentral::get_plugin_path() . 'assets/components/blockUI/jquery.blockUI.js'), true);
                wp_enqueue_style('bentral-settings', Bentral::get_plugin_url() . 'assets/admin/settings.css', []);

                // settings
                wp_enqueue_script('bentral-settings-js', Bentral::get_plugin_url() . 'assets/admin/settings.js', ['jquery'], $version, true);

                // bootstrap
                wp_enqueue_style('bentral-settings-bootstrap-css', $compPath . 'bootstrap/css/bootstrap.min.css');
                wp_enqueue_script('bentral-settings-bootstrap-js', $compPath . 'bootstrap/js/bootstrap.min.js', ['jquery'], $version, true);

                wp_localize_script('jquery', 'styleCss', wp_enqueue_code_editor(['type' => 'text/css']));
                wp_localize_script('jquery', 'styleHtml', wp_enqueue_code_editor(['type' => 'text/html']));
                wp_localize_script('jquery', 'styleJson', wp_enqueue_code_editor(['type' => 'application/json']));

                wp_localize_script('bentral-settings-js', 'BentralSettings', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-verify-key-nonce'), 'action' => 'bentral_verify_key', 'failure_text' => __('Failed to verify API Key', 'bentral'), 'verifying_text' => __('Verifying', 'bentral'), 'verify_key_text' => __('Verify key', 'bentral'), 'key_valid' => __('Valid key'), 'key_invalid' => __('Invalid key')
                ]);

                wp_localize_script('bentral-settings-js', 'BentralLoadLanguage', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-load-language-nonce'), 'action' => 'bentral_load_language'
                ]);

                wp_localize_script('bentral-settings-js', 'BentralSaveLanguage', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-save-language-nonce'), 'action' => 'bentral_save_language'
                ]);

                wp_localize_script('bentral-settings-js', 'BentralResultTemplate', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-result-template--nonce'), 'action' => 'bentral_result_template'
                ]);
            }

            if ($hook_suffix === 'bentral_page_bentral-properties') {
                wp_enqueue_style('bentral-select2-css', $compPath . 'select2/css/select2.min.css');
                wp_enqueue_script('bentral-select2-js', $compPath . 'select2/js/select2.min.js', ['jquery']);
                wp_enqueue_script('bentral-block-js', Bentral::get_plugin_url() . 'assets/components/blockUI/jquery.blockUI.js', ['jquery'], filemtime(Bentral::get_plugin_path() . 'assets/components/blockUI/jquery.blockUI.js'), true);
                wp_enqueue_style('bentral-settings', Bentral::get_plugin_url() . 'assets/admin/settings.css', []);

                wp_enqueue_style('bentral-properties-css', Bentral::get_plugin_url() . 'assets/admin/properties.css', []);
                wp_enqueue_script('bentral-properties-js', Bentral::get_plugin_url() . 'assets/admin/properties.js', ['jquery'], filemtime(Bentral::get_plugin_path() . 'assets/admin/properties.js'), true);

                // bootstrap
                wp_enqueue_style('bentral-settings-bootstrap-css', $compPath . 'bootstrap/css/bootstrap.min.css');
                wp_enqueue_script('bentral-settings-bootstrap-js', $compPath . 'bootstrap/js/bootstrap.min.js', ['jquery'], $version, true);

                wp_localize_script('bentral-properties-js', 'BentralPropertyList', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-list-nonce'), 'action' => 'bentral_properties_list'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralDeleteAll', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-delete-all-nonce'), 'action' => 'bentral_delete_all'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralPropertyImport', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-import-nonce'), 'action' => 'bentral_properties_import'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralPropertySync', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-sync-nonce'), 'action' => 'bentral_property_sync'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralPropertyTable', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-table-nonce'), 'action' => 'bentral_properties_table'
                ]);
                wp_localize_script('bentral-properties-js', 'BentralPropertyDesc', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-desc-nonce'), 'action' => 'bentral_properties_desc'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralPropertySetPost', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-set-post-nonce'), 'action' => 'bentral_properties_set_post'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralPropertyDelete', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-properties-delete-nonce'), 'action' => 'bentral_properties_delete'
                ]);

                wp_localize_script('bentral-properties-js', 'BentralUnitDelete', [
                    'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('bentral-unit-delete-nonce'), 'action' => 'bentral_unit_delete'
                ]);

            }

            if ($hook_suffix === 'bentral_page_bentral-widgets') {
                wp_enqueue_style('bentral-select2-css', $compPath . 'select2/css/select2.min.css');
                wp_enqueue_script('bentral-select2-js', $compPath . 'select2/js/select2.min.js', ['jquery']);
                wp_enqueue_script('bentral-block-js', Bentral::get_plugin_url() . 'assets/components/blockUI/jquery.blockUI.js', ['jquery'], filemtime(Bentral::get_plugin_path() . 'assets/components/blockUI/jquery.blockUI.js'), true);
                wp_enqueue_style('bentral-settings', Bentral::get_plugin_url() . 'assets/admin/settings.css', []);

                // css
                wp_enqueue_style('bentral-widget-bootstrap', $compPath . 'bootstrap/css/bootstrap.min.css');
                wp_enqueue_style('bentral-widget-spectrum', $compPath . 'spectrum/spectrum.css');
                wp_enqueue_style('bentral-widget-list', Bentral::get_plugin_url() . 'assets/admin/widgets.css', []);

                // js
                wp_enqueue_script('bentral-widget-list', Bentral::get_plugin_url() . 'assets/admin/widgets.js', ['jquery'], $version, true);
                wp_enqueue_script('bentral-widget-bootstrap', $compPath . 'bootstrap/js/bootstrap.min.js', ['jquery'], $version, true);
                wp_enqueue_script('bentral-widget-spectrum', $compPath . 'spectrum/spectrum.js', ['jquery'], $version, true);

            }
        }

        public static function validateLang($lang)
        {
            $languages = json_decode(wp_unslash($lang), true);
            if (!empty($languages)) {
                foreach ($languages as $key => &$language) {
                    if (!isset($language['days'])) {
                        switch ($key) {
                            case 'si':
                            case 'sl':
                                $language['days'] = ["day1" => "Po", "day2" => "To", "day3" => "Sr", "day4" => "Če", "day5" => "Pe", "day6" => "So", "day7" => "Ne"];
                            case 'us':
                            case 'en':
                                $language['days'] = ["day1" => "Mo", "day2" => "Tu", "day3" => "We", "day4" => "Th", "day5" => "Fr", "day6" => "Sa", "day7" => "Su"];
                            case 'de':
                                $language['days'] = ["day1" => "Mo", "day2" => "Di", "day3" => "Wir", "day4" => "Do", "day5" => "Fr", "day6" => "Sa", "day7" => "So"];
                            case 'it':
                                $language['days'] = ["day1" => "Lu", "day2" => "Tu", "day3" => "Noi", "day4" => "Gio", "day5" => "ven", "day6" => "Sa", "day7" => "Dom"];
                            case 'ru':
                                $language['days'] = ["day1" => "Пн", "day2" => "Вт", "day3" => "Мы", "day4" => "Чт", "day5" => "Пт", "day6" => "Sa", "day7" => "Вс"];
                            case 'hr':
                                $language['days'] = ["day1" => "Mo", "day2" => "Tu", "day3" => "Mi", "day4" => "Th", "day5" => "Pet", "day6" => "Sa", "day7" => "Ned"];
                        }
                    }
                    if (!isset($language['month'])) {
                        switch ($key) {
                            case 'si':
                            case 'sl':
                                $language['month'] = ["mon1" => "Jan", "mon2" => "Feb", "mon3" => "Mar", "mon4" => "Apr", "mon5" => "Maj", "mon6" => "Jun", "mon7" => "Jul", "mon8" => "Avg", "mon9" => "Sep", "mon10" => "Okt", "mon11" => "Nov", "mon12" => "Dec"];
                            case 'us':
                            case 'en':
                                $language['month'] = ["mon1" => "Jan", "mon2" => "Feb", "mon3" => "Mar", "mon4" => "Apr", "mon5" => "May", "mon6" => "Jun", "mon7" => "Jul", "mon8" => "Aug", "mon9" => "Sep", "mon10" => "Oct", "mon11" => "Nov", "mon12" => "Dec"];
                            case 'de':
                                $language['month'] = ["mon1" => "Jan", "mon2" => "Feb", "mon3" => "Mar", "mon4" => "Apr", "mon5" => "Maj", "mon6" => "Jun", "mon7" => "Jul", "mon8" => "Avg", "mon9" => "Sep", "mon10" => "Okt", "mon11" => "Nov", "mon12" => "Dec"];
                            case 'it':
                                $language['month'] = [
                                    "mon1" => "Jan", "mon2" => "Feb", "mon3" => "Mar", "mon4" => "Apr", "mon5" => "May", "mon6" => "Jun", "mon7" => "Jul", "mon8" => "Aug", "mon9" => "Set", "mon10" => "Ott", "mon11" => "Nuovo", "mon12" => "Dic"
                                ];
                            case 'ru':
                                $language['month'] = ["mon1" => "Январь", "mon2" => "Февраль", "mon3" => "марш", "mon4" => "апреля", "mon5" => "Май", "mon6" => "июнь", "mon7" => "июль", "mon8" => "август", "mon9" => "сентябрь", "mon10" => "Октябрь", "mon11" => "Ноябрь", "mon12" => "Декабрь"];
                            case 'hr':
                                $language['month'] = ["mon1" => "Jan", "mon2" => "Vel", "mon3" => "Ožu", "mon4" => "Tra", "mon5" => "Svi", "mon6" => "Lip", "mon7" => "Srp", "mon8" => "Kol", "mon9" => "Ruj", "mon10" => "Lis", "mon11" => "Nov", "mon12" => "Pro"];
                        }
                    }
                }
            }
            $l = json_encode($languages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return ($l != false) ? $l : $lang;
        }

        public static function render()
        {
            if (isset($_POST['submit'])) {
                if (wp_verify_nonce($_POST['wp_bentral_submit_nonce'], 'wp_submit_bentral_settings')) {
                    // Bentral settings
                    update_option('bentral_api_key', $_POST['api_key']);
                    update_option('bentral_embed_key', $_POST['embed_key']);
                    update_option('bentral_type', $_POST['bentral_type']);
                    update_option('bentral_page_template', $_POST['bentral_page_template']);
                    update_option('bentral_page_postmeta', $_POST['page_postmeta']);
                    update_option('bentral_image_template', $_POST['image_template']);
                    update_option('bentral_import_type', $_POST['import_type']);
                    update_option('bentral_thumbnail_source', $_POST['bentral_thumbnail_source']);
                    update_option('bentral_thumbnail_size', $_POST['bentral_thumbnail_size']);
                    update_option('bentral_custom_import_type', $_POST['bentral_custom_import_type']);
                    update_option('bentral_page_title_type', $_POST['page_title_type']);
                    update_option('bentral_search_debug', $_POST['bentral_search_debug']);
                    update_option('bentral_https_ssl_verify', $_POST['bentral_https_ssl_verify']);
                    // Search settings
                    update_option('bentral_form_init_option', $_POST['bentral_form_init_option']);
                    update_option('bentral_date_picker', $_POST['bentral_date_picker']);
                    update_option('bentral_form_language', $_POST['bentral_form_language']);
                    update_option('bentral_form_max_guests_count', $_POST['bentral_form_max_guests_count']);
                    update_option('bentral_disable_tailwind', $_POST['bentral_disable_tailwind']);
                    update_option('bentral_form_default_guests', $_POST['bentral_form_default_guests']);
                    update_option('bentral_form_days_from_today', $_POST['bentral_form_days_from_today']);
                    update_option('bentral_form_days_between_dates', $_POST['bentral_form_days_between_dates']);
                    update_option('bentral_form_detect_lang', $_POST['bentral_form_detect_lang']);
                    update_option('bentral_language_plugin', $_POST['bentral_language_plugin']);
                    update_option('bentral_custom_result_site_url', $_POST['bentral_custom_result_site_url']);
                    update_option('bentral_result_property_title', $_POST['bentral_result_property_title']);
                    update_option('bentral_result_property_lang_url', $_POST['bentral_result_property_lang_url']);
                    update_option('bentral_results_custom_url', $_POST['bentral_results_custom_url']);
                    update_option('bentral_gallery_auto_init', $_POST['bentral_gallery_auto_init']);
                    update_option('bentral_gallery_image_source', $_POST['bentral_gallery_image_source']);
                    update_option('bentral_gallery_type', $_POST['bentral_gallery_type']);
                    update_option('bentral_gallery_slider_type', $_POST['bentral_gallery_slider_type']);
                    update_option('bentral_gallery_slider_auto_play', $_POST['bentral_gallery_slider_auto_play']);
                    update_option('bentral_gallery_slider_delay', $_POST['bentral_gallery_slider_delay']);
                    update_option('bentral_gallery_slider_fullscreen', $_POST['bentral_gallery_slider_fullscreen']);
                    update_option('bentral_gallery_slider_width', $_POST['bentral_gallery_slider_width']);
                    update_option('bentral_gallery_slider_height', $_POST['bentral_gallery_slider_height']);
                    update_option('bentral_image_columns', $_POST['bentral_image_columns']);
                    update_option('bentral_service_style', $_POST['bentral_service_style'] ?? '');
                    update_option('bentral_service_style_css', $_POST['bentral_service_style_css'] ?? '');
                    update_option('bentral_service_template', $_POST['bentral_service_template'] ?? '');
                    update_option('bentral_results_offset', intval($_POST['bentral_results_offset']));
                    update_option('bentral_translation_language_selected', $_POST['bentral_translation_language_selected']);
                    update_option('bentral_result_template_selected', $_POST['bentral_result_template_selected']);
                    // Google maps settings
                    update_option('bentral_google_api_key', $_POST['bentral_google_api_key']);
                    update_option('bentral_google_center_lat', $_POST['bentral_google_center_lat']);
                    update_option('bentral_google_center_lng', $_POST['bentral_google_center_lng']);
                    update_option('bentral_google_zoom', $_POST['bentral_google_zoom']);
                    update_option('bentral_google_zoom_single', $_POST['bentral_google_zoom_single']);
                    update_option('bentral_google_type', $_POST['bentral_google_type']);
                    update_option('bentral_auto_open_from_date', $_POST['bentral_auto_open_from_date']);
                    update_option('bentral_auto_open_to_date', $_POST['bentral_auto_open_to_date']);
                    update_option('bentral_root_url', $_POST['bentral_root_url']);
                    update_option('bentral_custom_image_path', $_POST['bentral_custom_image_path']);
                    // Language settings
                    if (empty($_POST['bentral_lang_settings'])) {
                        update_option('bentral_lang_settings', Bentral_Admin_Templates::defaulLanguageData());
                    } else {
                        update_option('bentral_lang_settings', self::validateLang($_POST['bentral_lang_settings']));
                    }
                    // Style
                    update_option('bentral_search_style', $_POST['bentral_search_style']);
                    update_option('bentral_result_style', $_POST['bentral_result_style']);
                    update_option('bentral_gallery_style', $_POST['bentral_gallery_style']);
                    update_option('bentral_card_style', $_POST['bentral_card_style']);
                    // Template
                    update_option('bentral_search_result_template', $_POST['bentral_search_result_template']);
                    update_option('bentral_search_root_result_template', $_POST['bentral_search_root_result_template']);
                    update_option('bentral_empty_search_result', $_POST['bentral_empty_search_result']);
                    update_option('bentral_error_search_result', $_POST['bentral_error_search_result']);
                    if (isset($_POST['bentral_page_template'])) {
                        update_option('bentral_page_template', $_POST['bentral_page_template']);
                    }
                    if (empty($_POST['bentral_card_template'])) {
                        update_option('bentral_card_template', Bentral_Admin_Templates::defaultCardTemplate());
                    } else {
                        update_option('bentral_card_template', $_POST['bentral_card_template']);
                    }

                    // Reviews
                    update_option('bentral_reviews_count', $_POST['bentral_reviews_count']);

                    $_SESSION['bentral_admin_message'] = [
                        'type' => 'updated', 'message' => __('Settings successfully saved.', 'bentral'),
                    ];
                } else {
                    $_SESSION['bentral_admin_message'] = [
                        'type' => 'error', 'message' => __('Invalid form key.', 'bentral'),
                    ];
                }
            }
            include Bentral::get_plugin_path() . 'templates/admin/settings.php';
        }

        public function verify_key()
        {
            check_ajax_referer('bentral-verify-key-nonce', 'nonce');
            $request = new Bentral_Request();
            $request->execute('/v1/properties', $_POST['bentral_key']);
            wp_die(json_encode([
                'valid' => $request->getResponseCode() === 200,
            ]));
        }

    }
}