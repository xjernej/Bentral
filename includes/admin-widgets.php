<?php

use Bentral\Wordpress\Media;
use Bentral\Wordpress\Token;

if (!class_exists('Bentral_Admin_Widgets')) {

    class Bentral_Admin_Widgets
    {
        public static function render()
        {
            if (isset($_POST['submit'])) {
                if (wp_verify_nonce($_POST['wp_bentral_submit_nonce'], 'wp_submit_bentral_widgets')) {
                    // reservation
                    update_option('bentral_widget_search_tags', $_POST['bentral_widget_search_tags']);
                    update_option('bentral_widget_search_enable', $_POST['bentral_widget_search_enable']);
                    update_option('bentral_widget_search_head_1_bg', $_POST['bentral_widget_search_head_1_bg']);
                    update_option('bentral_widget_search_head_1_font', $_POST['bentral_widget_search_head_1_font']);
                    update_option('bentral_widget_search_head_2_bg', $_POST['bentral_widget_search_head_2_bg']);
                    update_option('bentral_widget_search_head_2_font', $_POST['bentral_widget_search_head_2_font']);
                    update_option('bentral_widget_search_table_bg', $_POST['bentral_widget_search_table_bg']);
                    update_option('bentral_widget_search_table_font', $_POST['bentral_widget_search_table_font']);
                    update_option('bentral_widget_search_button_bg', $_POST['bentral_widget_search_button_bg']);
                    update_option('bentral_widget_search_button_font', $_POST['bentral_widget_search_button_font']);
                    update_option('bentral_widget_search_border_enable', $_POST['bentral_widget_search_border_enable']);
                    update_option('bentral_widget_search_border_color', $_POST['bentral_widget_search_border_color']);
                    // calendar
                    update_option('bentral_widget_calendar_month_number', $_POST['bentral_widget_calendar_month_number']);
                    update_option('bentral_widget_calendar_month_columns', $_POST['bentral_widget_calendar_month_columns']);
                    update_option('bentral_widget_calendar_month_change', $_POST['bentral_widget_calendar_month_change']);
                    update_option('bentral_widget_calendar_legend', $_POST['bentral_widget_calendar_legend']);
                    update_option('bentral_widget_calendar_enable', $_POST['bentral_widget_calendar_enable']);
                    update_option('bentral_widget_calendar_head_1_bg', $_POST['bentral_widget_calendar_head_1_bg']);
                    update_option('bentral_widget_calendar_head_1_font', $_POST['bentral_widget_calendar_head_1_font']);
                    update_option('bentral_widget_calendar_head_2_bg', $_POST['bentral_widget_calendar_head_2_bg']);
                    update_option('bentral_widget_calendar_head_2_font', $_POST['bentral_widget_calendar_head_2_font']);
                    update_option('bentral_widget_calendar_table_bg', $_POST['bentral_widget_calendar_table_bg']);
                    update_option('bentral_widget_calendar_table_font', $_POST['bentral_widget_calendar_table_font']);
                    update_option('bentral_widget_calendar_border_enable', $_POST['bentral_widget_calendar_border_enable']);
                    update_option('bentral_widget_calendar_border_color', $_POST['bentral_widget_calendar_border_color']);

                    // price
                    update_option('bentral_widget_price_enable', $_POST['bentral_widget_price_enable']);
                    update_option('bentral_widget_price_head_1_bg', $_POST['bentral_widget_price_head_1_bg']);
                    update_option('bentral_widget_price_head_1_font', $_POST['bentral_widget_price_head_1_font']);
                    update_option('bentral_widget_price_head_2_bg', $_POST['bentral_widget_price_head_2_bg']);
                    update_option('bentral_widget_price_head_2_font', $_POST['bentral_widget_price_head_2_font']);
                    update_option('bentral_widget_price_table_bg', $_POST['bentral_widget_price_table_bg']);
                    update_option('bentral_widget_price_table_font', $_POST['bentral_widget_price_table_font']);
                    update_option('bentral_widget_price_border_enable', $_POST['bentral_widget_price_border_enable']);
                    update_option('bentral_widget_price_border_color', $_POST['bentral_widget_price_border_color']);

                    // reviews
                    update_option('bentral_reviews_count', $_POST['bentral_reviews_count']);
                    update_option('bentral_widget_reviews_sum', $_POST['bentral_widget_reviews_sum']);
                    update_option('bentral_widget_reviews_author', $_POST['bentral_widget_reviews_author']);
                    update_option('bentral_widget_reviews_type', $_POST['bentral_widget_reviews_type']);
                    update_option('bentral_widget_reviews_date', $_POST['bentral_widget_reviews_date']);
                    update_option('bentral_widget_reviews_enable', $_POST['bentral_widget_reviews_enable']);
                    update_option('bentral_widget_reviews_head_1_bg', $_POST['bentral_widget_reviews_head_1_bg']);
                    update_option('bentral_widget_reviews_head_1_font', $_POST['bentral_widget_reviews_head_1_font']);
                    update_option('bentral_widget_reviews_head_2_bg', $_POST['bentral_widget_reviews_head_2_bg']);
                    update_option('bentral_widget_reviews_head_2_font', $_POST['bentral_widget_reviews_head_2_font']);
                    update_option('bentral_widget_reviews_table_bg', $_POST['bentral_widget_reviews_table_bg']);
                    update_option('bentral_widget_reviews_table_font', $_POST['bentral_widget_reviews_table_font']);
                    update_option('bentral_widget_reviews_border_enable', $_POST['bentral_widget_reviews_border_enable']);
                    update_option('bentral_widget_reviews_border_color', $_POST['bentral_widget_reviews_border_color']);
                };
                ob_clean();
                wp_safe_redirect(admin_url('admin.php?page=bentral-widgets'));
            }
            include Bentral::get_plugin_path() . 'templates/admin/widgets.php';
        }
    }
}