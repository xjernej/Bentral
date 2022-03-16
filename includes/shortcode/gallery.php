<?php

if (!class_exists('Bentral_Shortcode_Gallery')) {
    class Bentral_Shortcode_Gallery
    {
        public static function render($atts)
        {
            $template_file                     = 'gallery.php';
            $version                           = Bentral::version();
            $componentPath                     = Bentral::get_plugin_url();
            $bentral_gallery_type              = get_option('bentral_gallery_type') ?: 'thumbnail';
            $bentral_gallery_slider_auto_play  = intval(get_option('bentral_gallery_slider_auto_play'));
            $bentral_gallery_slider_fullscreen = intval(get_option('bentral_gallery_slider_fullscreen'));

            if (isset($atts['type'])){
                $bentral_gallery_slider_type      = $atts['type'];
            } else {
                $bentral_gallery_slider_type       = get_option('bentral_gallery_slider_type') ?: 'thumbnail';
            }

            if (isset($atts['delay'])){
                $bentral_gallery_slider_delay      = $atts['delay'];
            } else {
                $bentral_gallery_slider_delay      = intval(get_option('bentral_gallery_slider_delay'));
            }

            if (isset($atts['width'])){
                $bentral_gallery_slider_width      = $atts['width'];
            } else {
                $bentral_gallery_slider_width      = get_option('bentral_gallery_slider_width') ?: '100%';
            }

            if (isset($atts['height'])){
                $bentral_gallery_slider_height      = $atts['height'];
            } else {
                $bentral_gallery_slider_height     = get_option('bentral_gallery_slider_height') ?: '500';
            }
            if (intval(get_option('bentral_disable_tailwind')) != 1) {
                wp_enqueue_style('bentral-tailwind-css', $componentPath . 'assets/components/tailwind/tailwind.min.css', [], $version);
            }

            if ($bentral_gallery_type == 'slider') {
                wp_enqueue_style('bentral-royalslider', $componentPath . 'assets/components/royalslider/royalslider.css', [], $version);
                wp_enqueue_style('bentral-royalslider-skins', $componentPath . 'assets/components/royalslider/skins/universal/rs-universal.css', [], $version);
                wp_enqueue_style('bentral-royalslider-visible-nearby-simple', $componentPath . 'assets/components/royalslider/templates-css/rs-visible-nearby-simple.css', [], $version);
                wp_enqueue_script('bentral-royalslider', $componentPath . 'assets/components/royalslider/jquery.royalslider.min.js', array('jquery'), $version, 'all');
            } else {
                wp_enqueue_style('bentral-lightbox', $componentPath . 'assets/components/gallery/simple-lightbox.min.css', [], $version);
                wp_enqueue_script('bentral-lightbox', $componentPath . 'assets/components/gallery/simple-lightbox.min.js', [], $version, 'all');
            }

            wp_enqueue_script('bentral-gallery', $componentPath . 'assets/front/gallery.min.js', [], $version, 'all');

            ob_start();
            include locate_template($template_file) ?: Bentral::get_plugin_path() . 'templates/shortcode/' . $template_file;
            return ob_get_clean();
        }
    }
}