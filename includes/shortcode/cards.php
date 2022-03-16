<?php

if (!class_exists('Bentral_Shortcode_PropertiesCards')) {
    class Bentral_Shortcode_PropertiesCards
    {
        public static function render($atts)
        {
            $template_file = 'cards.php';
            $componentPath = Bentral::get_plugin_url();
            $version       = Bentral::version();

            wp_enqueue_style('bentral-search-results-fa', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css');
            wp_enqueue_style('bentral-search-results-css', $componentPath . 'assets/front/search_results.min.css', [], $version);
            wp_enqueue_script('bentral-cards-js', $componentPath . 'assets/front/cards.js', [], $version, true);

            $template = wp_unslash(get_option('bentral_card_template') ?: trim(Bentral_Admin_Templates::defaultCardTemplate()));
            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}