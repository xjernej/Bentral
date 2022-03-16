<?php

if (!class_exists('Bentral_Shortcode_Widget')) {
    class Bentral_Shortcode_Widget
    {
        public static function render($atts)
        {
            $type  = '';
            if (isset($atts['type'])){
                $type  = $atts['type'];
            }
            switch ($type) {
                case 'search-form':
                    return Bentral_Shortcode_Search_Fields::render($atts);
                case 'search-results':
                    return Bentral_Shortcode_Search_Results::render($atts);
                case 'reservation':
                    return Bentral_Shortcode_Form_Reserve::render($atts);
                case 'gallery':
                    return Bentral_Shortcode_Gallery::render($atts);
                case 'list':
                    return Bentral_Shortcode_List::render($atts);
                case 'map':
                    return Bentral_Shortcode_Map::render($atts);
                case 'maps':
                    return Bentral_Shortcode_Maps::render($atts);
                case 'price':
                    return Bentral_Shortcode_Price::render($atts);
                case 'reviews':
                    return Bentral_Shortcode_Reviews::render($atts);
                case 'calendar':
                    return Bentral_Shortcode_Calendar::render($atts);
                case 'cards':
                    return Bentral_Shortcode_PropertiesCards::render($atts);
                case 'services':
                    return Bentral_Shortcode_Services::render($atts);
                default:
                    return '[bentral-widget] - type is missing';
            }
        }
    }
}