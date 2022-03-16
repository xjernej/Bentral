<?php

if (!class_exists('Bentral_Shortcode_Text')) {
    class Bentral_Shortcode_Text
    {
        public static function render($atts)
        {
            $type  = '';
            if (isset($atts['type'])){
                $type  = $atts['type'];
            }
            switch ($type) {
                case 'title':
                    return Bentral_Shortcode_Title::render();
                case 'property-title':
                    return Bentral_Shortcode_Property_Title::render();
                case 'intro':
                    return Bentral_Shortcode_Intro::render();
                case 'description':
                    return Bentral_Shortcode_Desc::render();
                case 'capacity':
                    return Bentral_Shortcode_Capacity::render();
                case 'capacity-additional':
                    return Bentral_Shortcode_Capacity_Additional::render();
                case 'floor-size':
                    return Bentral_Shortcode_Floor_Size::render();
                default:
                    return '[bentral-text] - type is missing';
            }
        }
    }
}