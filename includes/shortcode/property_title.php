<?php

if (!class_exists('Bentral_Shortcode_Property_Title')) {
    class Bentral_Shortcode_Property_Title
    {
        public static function render()
        {
            $template_file = 'property_title.php';
            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}