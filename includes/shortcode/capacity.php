<?php

if (!class_exists('Bentral_Shortcode_Capacity')) {
    class Bentral_Shortcode_Capacity
    {
        public static function render()
        {
            $template_file = 'capacity.php';
            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}