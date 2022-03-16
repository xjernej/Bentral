<?php

if (!class_exists('Bentral_Shortcode_List')) {
    class Bentral_Shortcode_List
    {
        public static function render($atts)
        {
            $template_file = 'list.php';

            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}