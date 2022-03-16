<?php

if (!class_exists('Bentral_Shortcode_Search_Results')) {
    class Bentral_Shortcode_Search_Results
    {
        public static function render($atts)
        {
            $templateFile  = 'search-results.php';
            $version       = Bentral::version();
            $componentPath = Bentral::get_plugin_url();

            wp_enqueue_style('bentral-search-results-fa', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css', [], $version);
            wp_enqueue_style('bentral-search-results', $componentPath . 'assets/front/search_results.min.css', [], $version);

            ob_start();
            include locate_template($templateFile) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $templateFile;
            return ob_get_clean();
        }
    }
}