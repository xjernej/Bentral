<?php

if (!class_exists('Bentral_Shortcode_Capacity_Additional')) {
    class Bentral_Shortcode_Capacity_Additional
    {
        public static function render()
        {
            $template_file = 'capacity_additional.php';
            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}