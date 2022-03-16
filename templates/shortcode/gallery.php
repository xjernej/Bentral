<style><?php echo wp_unslash(get_option('bentral_gallery_style')); ?></style>
<?php
try {
    $page_id = get_queried_object_id();

    if (isset($atts['id'])) {
        $page_id = $atts['id'];
    }

    if (!empty($page_id)) {
        include 'bentral_helpers.php';

        $bentral_key                  = get_option('bentral_embed_key');
        $lang                         = page_language();
        $uri_path                     = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $bentralUnit         = ($page_id == '<first>')
            ? bentral_first_unit()
            : bentral_unit_data($page_id, $lang);
        $bentral_property_id = V(V($bentralUnit, 'property'), 'id');
        $bentral_unit_id     = V(V($bentralUnit, 'unit'), 'id');
        $bentral_gallery_type         = get_option('bentral_gallery_type') ?: 'thumbnail';
        $bentral_gallery_image_source = get_option('bentral_gallery_image_source') ?: 'wordpress';

        switch ($bentral_gallery_type){
            case 'thumbnail':
                include 'galleryType/thumbnail.php';
                break;
            case 'slider':
                include 'galleryType/slider.php';
                break;
        }
    } else {
        echo 'BENTRAL GALLERY ERROR : NO POST ID';
    }
}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}