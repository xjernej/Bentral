<?php
$bentral_gallery_columns = get_option('bentral_image_columns') ?: 4;
$image_template          = wp_unslash(get_option('bentral_image_template') ?: trim(Bentral_Admin_Templates::defaultGalleryTemplate()));
$galleryHTML             = '<div class="bentral-gallery container mx-auto space-y-2 lg:space-y-0 lg:gap-2 lg:grid lg:grid-cols-' . $bentral_gallery_columns . '" data-gallery-id="<?=$page_id;?>" data-gallery-type="<?=$bentral_gallery_type;?>" data-columns="' . $bentral_gallery_columns . '">';
$galleryHTML             = '<div class="bentral-gallery container grid grid-cols-' . $bentral_gallery_columns . ' gap-1 mx-auto" data-gallery-id="' . $page_id . '" data-gallery-type="' . $bentral_gallery_type . '">';
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
                $imageUrl      = wp_get_attachment_image_src($image->ID, 'full')[0];
                $imageThumbUrl = wp_get_attachment_image_src($image->ID, $thumbSize)[0];
                $image         = str_replace('{{ property_image_url }}', $imageUrl, $image_template);
                $image         = str_replace('{{ property_image_url_thumb }}', $imageThumbUrl, $image);
                $galleryHTML   .= $image;
            }
        } else {
            $properties = get_option('bentral_all_properties');
            $property   = V($properties, 'bentral_' . $bentral_property_id . '_' . $bentral_unit_id);

            if (!empty($property)) {
                $unit        = V($property, 'unit');
                $unit_images = V($unit, 'images');
                if (!empty($unit_images)) {
                    foreach ($unit_images as $image) {
                        $imageUrl      = V($image, 'url');
                        $imageThumbUrl = V($image, 'url');
                        $image         = str_replace('{{ property_image_url }}', $imageUrl, $image_template);
                        $image         = str_replace('{{ property_image_url_thumb }}', $imageThumbUrl, $image);
                        $galleryHTML   .= $image;
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
                    $imageUrl      = V($image, 'url');
                    $imageThumbUrl = V($image, 'url');
                    $image         = str_replace('{{ property_image_url }}', $imageUrl, $image_template);
                    $image         = str_replace('{{ property_image_url_thumb }}', $imageThumbUrl, $image);
                    $galleryHTML   .= $image;
                }
            }
        }
        break;
    default:
        echo 'BENTRAL GALLERY ERROR : NO IMAGE SOURCE TYPE';
        break;
}
$galleryHTML .= '</div>';
echo $galleryHTML;