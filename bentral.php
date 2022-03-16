<?php

/**
 * Plugin Name: Bentral
 * Description: Search, reservation, page creation for Bentral portal. More info: <a href="https://www.bentral.com/">bentral.com</a>.
 * Version: 2.4.7
 * Author: INTERSPLET d.o.o.
 * Author URI: http://www.intersplet.com/
 * License: GPL v3
 * Text Domain: bentral
 */

//#region require

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/request.php';
require_once __DIR__ . '/includes/admin-templates.php';
require_once __DIR__ . '/includes/admin-settings.php';
require_once __DIR__ . '/includes/admin-properties.php';
require_once __DIR__ . '/includes/admin-widgets.php';
require_once __DIR__ . '/includes/search-controller.php';
require_once __DIR__ . '/includes/shortcode/form-reserve.php';
require_once __DIR__ . '/includes/shortcode/search-fields.php';
require_once __DIR__ . '/includes/shortcode/search-results.php';
require_once __DIR__ . '/includes/shortcode/map.php';
require_once __DIR__ . '/includes/shortcode/maps.php';
require_once __DIR__ . '/includes/shortcode/reviews.php';
require_once __DIR__ . '/includes/shortcode/gallery.php';
require_once __DIR__ . '/includes/shortcode/list.php';
require_once __DIR__ . '/includes/shortcode/calendar.php';
require_once __DIR__ . '/includes/shortcode/price.php';
require_once __DIR__ . '/includes/shortcode/intro.php';
require_once __DIR__ . '/includes/shortcode/desc.php';
require_once __DIR__ . '/includes/shortcode/services.php';
require_once __DIR__ . '/includes/shortcode/cards.php';
require_once __DIR__ . '/includes/shortcode/title.php';
require_once __DIR__ . '/includes/shortcode/property_title.php';
require_once __DIR__ . '/includes/shortcode/capacity.php';
require_once __DIR__ . '/includes/shortcode/capacity_additional.php';
require_once __DIR__ . '/includes/shortcode/floor_size.php';
require_once __DIR__ . '/includes/shortcode/shortcode-text.php';
require_once __DIR__ . '/includes/shortcode/shortcode-widget.php';

//#endregion

define('Bentral_FILE', __FILE__);

if (!class_exists('Bentral ')) {
    class Bentral
    {
        public function __construct()
        {
            $this->init();
            register_activation_hook(Bentral_FILE, [$this, 'bentral_activate']);
        }

        public static function version()
        {
            return '2.4.7';
        }

        public function bentral_activate()
        {
            $oldVersion = get_option('bentral_gallery_image_source') ?: '1.0.0';
            if ($oldVersion == '1.0.0') {
                update_option('page_title_type', 'official');
                update_option('bentral_image_columns', 4);
                update_option('bentral_reviews_count', 5);
                update_option('page_title_type', 'official');
                update_option('bentral_type', 'bentral_search');
                update_option('bentral_form_init_option', 'onDocumentReady');
                update_option('bentral_date_picker', 'input');
                update_option('bentral_form_max_guests_count', 1);
                update_option('bentral_disable_tailwind', 0);
                update_option('bentral_form_days_between_dates', 1);
                update_option('bentral_form_days_from_today', 0);
                update_option('bentral_form_detect_lang', 1);
                update_option('bentral_auto_open_from_date', 0);
                update_option('bentral_auto_open_to_date', 1);
                update_option('bentral_root_url', '');
                update_option('bentral_custom_image_path', '');
                update_option('bentral_lang_settings', Bentral_Admin_Templates::defaulLanguageData());
                update_option('bentral_widget_calendar_month_number', 2);
                update_option('bentral_widget_calendar_month_columns', 2);
                update_option('bentral_widget_calendar_month_change', 1);
                update_option('bentral_widget_calendar_legend', 1);
                update_option('bentral_gallery_type', 'slider');
                update_option('bentral_gallery_image_source', 'wordpress');
                update_option('bentral_gallery_type', 'thumbnail');
                update_option('bentral_gallery_slider_type', 'gallery');
                update_option('bentral_gallery_slider_fullscreen', 1);
                update_option('bentral_gallery_slider_auto_play', 1);
                update_option('bentral_result_template_selected', 'jasna');
            }

            if ($oldVersion > '2.0.0') {
                $this->update_property_desc();
            }

            update_option('bentral_version', self::version());
        }

        public static function get_plugin_path()
        {
            return plugin_dir_path(__FILE__);
        }

        public static function get_plugin_url()
        {
            return plugin_dir_url(__FILE__);
        }

        protected function init()
        {
            register_activation_hook(__FILE__, [$this, 'flush_rewrites']);

            add_action('admin_init', [$this, 'set_admin_message']);
            add_action('init', [$this, 'create_bentral_post_type']);
            add_action('rest_api_init', [$this, 'register_rest_routes']);
            add_action('plugins_loaded', [$this, 'plugin_load_textdomain']);
            add_action('admin_menu', [$this, 'create_menu_links']);

            /* OLD SHORTCODE */
            add_shortcode('bentral_search_fields', [Bentral_Shortcode_Search_Fields::class, 'render']);
            add_shortcode('bentral_search_results', [Bentral_Shortcode_Search_Results::class, 'render']);
            add_shortcode('bentral_form_reserve', [Bentral_Shortcode_Search_Fields::class, 'render']);
            add_shortcode('bentral_reservation', [Bentral_Shortcode_Form_Reserve::class, 'render']);
            add_shortcode('bentral_price', [Bentral_Shortcode_Price::class, 'render']);
            add_shortcode('bentral_intro', [Bentral_Shortcode_Intro::class, 'render']);
            add_shortcode('bentral_description', [Bentral_Shortcode_Desc::class, 'render']);
            add_shortcode('bentral_gallery', [Bentral_Shortcode_Gallery::class, 'render']);
            add_shortcode('bentral_map', [Bentral_Shortcode_Map::class, 'render']);
            add_shortcode('bentral_maps', [Bentral_Shortcode_Maps::class, 'render']);
            add_shortcode('bentral_reviews', [Bentral_Shortcode_Reviews::class, 'render']);
            add_shortcode('bentral_list', [Bentral_Shortcode_List::class, 'render']);
            add_shortcode('bentral_services', [Bentral_Shortcode_Services::class, 'render']);
            add_shortcode('bentral_cards', [Bentral_Shortcode_PropertiesCards::class, 'render']);
            add_shortcode('bentral_title', [Bentral_Shortcode_Title::class, 'render']);
            add_shortcode('bentral_property_title', [Bentral_Shortcode_Property_Title::class, 'render']);
            add_shortcode('bentral_capacity', [Bentral_Shortcode_Capacity::class, 'render']);
            add_shortcode('bentral_capacity_additional', [Bentral_Shortcode_Capacity_Additional::class, 'render']);
            add_shortcode('bentral_floor_size', [Bentral_Shortcode_Floor_Size::class, 'render']);

            /* NEW SHORTCODE */
            add_shortcode('bentral-widget', [Bentral_Shortcode_Widget::class, 'render']);
            add_shortcode('bentral-text', [Bentral_Shortcode_Text::class, 'render']);

            $settings_page = new Bentral_Admin_Settings();
            $settings_page->init();
        }

        public function update_property_desc()
        {
            $properties         = get_option('bentral_all_properties');
            $custom_description = get_option('bentral_custom_description');
            foreach ($properties as $property) {
                if (isset($property['custom_description'])) {
                    $bentral_unit = 'bentral_' . $property['property']['id'] . '_' . $property['unit']['id'];
                    if (empty($custom_description[$bentral_unit])) {
                        $custom_description[$bentral_unit] = $property['custom_description'];
                    }
                }
            }
        }

        public function create_bentral_post_type()
        {
            if (!post_type_exists('bentral_property')) {
                $args = [
                    'labels'       => [
                        'name'          => _x('Bentral Properties', 'post type general name', 'bentral'),
                        'singular_name' => _x('Bentral Property', 'post type singular name', 'bentral'),
                    ],
                    'description'  => __('Bentral Property custom post type.', 'bentral'),
                    'public'       => false,
                    'rewrite'      => false,
                    'show_in_menu' => false,
                    'has_archive'  => false,
                    'supports'     => ['custom-fields'],
                ];
                register_post_type('bentral_property', $args);
            }
        }

        public function plugin_load_textdomain()
        {
            load_plugin_textdomain('bentral', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function flush_rewrites()
        {
            $this->create_bentral_post_type();
            flush_rewrite_rules();
        }

        public function set_admin_message()
        {
            if (!empty($_SESSION['bentral_admin_message'])) {
                add_action('admin_notices', function () {
                    ?>
                    <div class="notice <?php
                    echo $_SESSION['bentral_admin_message']['type'] ?> is-dismissible">
                        <p>
                            <strong><?php
                                echo $_SESSION['bentral_admin_message']['message']; ?></strong>
                        </p>
                    </div>
                    <?php
                    unset($_SESSION['bentral_admin_message']);
                });
            }
        }

        public function create_menu_links()
        {
            add_menu_page(
                __('Bentral', 'bentral'),
                __('Bentral', 'bentral'),
                'manage_options',
                'bentral-options',
                [Bentral_Admin_Settings::class, 'render'],
                self::get_plugin_url() . 'assets/bentral.png',
                100
            );

            add_submenu_page(
                'bentral-options',
                __('Options', 'bentral'),
                __('Options', 'bentral'),
                'manage_options',
                'bentral-options',
                [Bentral_Admin_Settings::class, 'render']
            );

            add_submenu_page(
                'bentral-options',
                __('Properties', 'bentral'),
                __('Properties', 'bentral'),
                'manage_options',
                'bentral-properties',
                [$this, 'render_properties_list']
            );

            add_submenu_page(
                'bentral-options',
                __('Widgets', 'bentral'),
                __('Widgets', 'bentral'),
                'manage_options',
                'bentral-widgets',
                [$this, 'render_widgets']
            );

        }

        public function render_properties_list()
        {
            $list = new Bentral_Admin_Properties();
            $list->render();
        }

        public function render_widgets()
        {
            $list = new Bentral_Admin_Widgets();
            $list->render();
        }

        public function register_rest_routes()
        {
            $searchRoute = new Bentral_Search_Controller();
            $searchRoute->register_routes();
        }

    }
}

$bentral_plugin = new Bentral();
