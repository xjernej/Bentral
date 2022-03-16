<?php

if (!class_exists('Bentral_Shortcode_Price')) {
    class Bentral_Shortcode_Price
    {
        public static function render($atts)
        {
            $template_file = 'price.php';

            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}