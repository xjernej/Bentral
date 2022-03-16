<?php

if (!class_exists('Bentral_Shortcode_Search_Fields')) {
    class Bentral_Shortcode_Search_Fields
    {
        public static function render($atts)
        {
            $templateFile      = 'search-form.php';
            $version           = Bentral::version();
            $componentPath     = Bentral::get_plugin_url();
            $bentralDatePicker = get_option('bentral_date_picker');
            $allowedTags = '';
            if (isset($atts['allowed-tags'])) {
                $allowedTags = $atts['allowed-tags'];
            }

            if (intval(get_option('bentral_disable_tailwind')) != 1) {
                wp_enqueue_style('bentral-tailwind-css', $componentPath . 'assets/components/tailwind/tailwind.min.css', [], $version);
            }

            wp_enqueue_style('bentral-search-style', $componentPath . 'assets/front/search.min.css', [], $version);
            wp_enqueue_script('jquery');

            if ($bentralDatePicker == 'html') {
                wp_enqueue_style('jquery-ui');
                wp_enqueue_script('bentral-search-form-html', $componentPath . 'assets/front/searchFormHtml.min.js', ['jquery-ui-datepicker'], $version, true);
            }
            if ($bentralDatePicker == 'input') {
                wp_enqueue_style('bentral-search-flatpickr', $componentPath . 'assets/components/flatpickr/flatpickr.min.css', [], $version);
                wp_enqueue_script('bentral-search-flatpickr', $componentPath . 'assets/components/flatpickr/flatpickr.min.js', [], $version, true);
                wp_enqueue_script('bentral-search-form-input', $componentPath . 'assets/front/searchFormInput.min.js', ['jquery'], $version, true);
            }

            ob_start();
            include locate_template($templateFile) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $templateFile;
            return ob_get_clean();
        }
    }
}