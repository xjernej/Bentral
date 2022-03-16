<?php
$galleryHTML   = '';
$imageGallery  = [];
$imageTemplate = '<a class="rsImg" href="{{ property_image_url }}"><img src="{{ property_image_url_thumb }}" class="rsTmb"/></a>';

switch ($bentral_gallery_image_source) {
    case 'wordpress' :
        $images    = get_posts(
            [
                'post_parent'    => $page_id,
                'post_status'    => 'inherit',
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'order'          => 'ASC',
                'orderby'        => 'ID',
                'posts_per_page' => -1
            ]
        );
        $thumbSize = get_option('bentral_thumbnail_size') ?: 'medium';
        if (!empty($images)) {
            foreach ($images as $image) {
                $imageUrl       = wp_get_attachment_image_src($image->ID, 'full')[0];
                $imageThumbUrl  = wp_get_attachment_image_src($image->ID, $thumbSize)[0];
                $gImg           = str_replace('{{ property_image_url }}', $imageUrl, $imageTemplate);
                $gImg           = str_replace('{{ property_image_url_thumb }}', $imageUrl, $gImg);
                $imageGallery[] = $gImg;
            }
        } else {
            $properties = get_option('bentral_all_properties');
            $property   = V($properties, 'bentral_' . $bentral_property_id . '_' . $bentral_unit_id);

            if (!empty($property)) {
                $unit        = V($property, 'unit');
                $unit_images = V($unit, 'images');
                if (!empty($unit_images)) {
                    foreach ($unit_images as $image) {
                        $imageUrl       = V($image, 'url');
                        $imageThumbUrl  = V($image, 'url');
                        $gImg           = str_replace('{{ property_image_url }}', $imageUrl, $imageTemplate);
                        $gImg           = str_replace('{{ property_image_url_thumb }}', $imageUrl, $gImg);
                        $imageGallery[] = $gImg;
                    }
                }
            }
        }
        break;
    case 'bentral' :
        $properties = get_option('bentral_all_properties');
        $property   = V($properties, 'bentral_' . $bentral_property_id . '_' . $bentral_unit_id);
        if (!empty($property)) {
            $unit        = V($property, 'unit');
            $unit_images = V($unit, 'images');
            if (!empty($unit_images)) {
                foreach ($unit_images as $image) {
                    $imageUrl       = V($image, 'url');
                    $imageThumbUrl  = V($image, 'url');
                    $gImg           = str_replace('{{ property_image_url }}', $imageUrl, $imageTemplate);
                    $gImg           = str_replace('{{ property_image_url_thumb }}', $imageUrl, $gImg);
                    $imageGallery[] = $gImg;
                }
            }
        }
        break;
    default:
        echo 'BENTRAL GALLERY ERROR : NO IMAGE SOURCE TYPE';
        break;
}

$sliderOptions = [];
$sliderOptions[] = 'data-gallery-id="' . $page_id . '"';
$sliderOptions[] = 'data-gallery-type="' . $bentral_gallery_type . '"';
$sliderOptions[] = 'data-slider-width="' . $bentral_gallery_slider_width . '"';
$sliderOptions[] = 'data-slider-height="' . $bentral_gallery_slider_height . '"';
$sliderOptions[] = 'data-slider-type="' . $bentral_gallery_slider_type . '"';
$sliderOptions[] = 'data-slider-auto-play="' . $bentral_gallery_slider_auto_play . '"';
$sliderOptions[] = 'data-slider-delay="' . $bentral_gallery_slider_delay . '"';
$sliderOptions[] = 'data-slider-fullscreen="' . $bentral_gallery_slider_fullscreen . '"';

switch ($bentral_gallery_slider_type){
    case 'gallery';
        $sliderType = 'rsHor rs-image-gallery rsWithThumbs rsWithThumbsHor';
        break;
    case 'gallery_vertical';
        $sliderType = 'rs-gallery-vertical-fade rsHor rsFade rsWithThumbs rsWithThumbsVer';
        break;
    case 'visible_nearby';
        $sliderType = 'visibleNearbySimple rsHor rsWithBullets';
        break;
    default:
        $sliderType = 'rs-default-template rsHor rsWithBullets';
        break;
}

?>
<div class="bentral-gallery royalSlider rsUni <?=$sliderType;?>" style="width: <?=$bentral_gallery_slider_width;?>; height: <?=$bentral_gallery_slider_height;?>; touch-action: pan-y;" <?= implode(' ', $sliderOptions) ?>>
    <?= implode('', $imageGallery) ?>
</div>