<?php

use Bentral\Token\TokenInterface;

$result             = '';
$properties         = get_option('bentral_all_properties');
$bentral_type       = get_option('bentral_type') ? : 'page';
$page_language      = page_language();
$img_url            = Bentral::get_plugin_url() . 'assets/placeholder-image.jpg';
$thumbSource        = get_option('bentral_thumbnail_source');
$search_title_type  = get_option('bentral_result_property_title');
$add_page_lang_link = intval(get_option('bentral_result_property_lang_url') ? : '0');
$page_title_type    = get_option('bentral_page_title_type');
$custom_lang        = json_decode(wp_unslash(get_option('bentral_lang_settings')), true);
$lng                = [];
$bentral_type       = get_option('bentral_type');
$template           = wp_unslash(get_option('bentral_card_template') ? : trim(Bentral_Admin_Templates::defaultCardTemplate()));

if (isset($custom_lang[$page_language])) {
    $lng = $custom_lang[$page_language];
}

if (!empty($properties)) {
    include 'bentral_helpers.php';

    $items = [];
    foreach ($properties as $property_data) {
        if ($bentral_type == 'bentral_full') {
            $page_id = V($property_data, 'post_id');
        } else {
            $page_id = V(V($property_data, 'post'), $page_language);
        }
        if (!empty($page_id)) {
            $property      = $property_data['property'];
            $property_unit = $property_data['unit'];
            $post_id       = bentral_property_post_id($property_data, $page_language);
            $img_url       = bentral_property_image($property_unit, $post_id);
            $post_title    = bentral_property_title($property_data, $post_id);
            $page_link     = create_page_link($post_id, $add_page_lang_link, $page_language);
            $templatePost  = array(
                'ID'                  => $post_id,
                'title'               => $post_title,
                'address'             => $property['address'] . ', ' . $property['zip'] . ' ' . $property['city'],
                'capacity_basic'      => $property_unit['capacityBasic'],
                'capacity_additional' => $property_unit['capacityAdditional'],
                'link'                => $page_link,
                'thumb'               => $img_url,
                'property'            => $property,
                'unit'                => $property_unit,
            );

            $STAR_ON  = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg>';
            $STAR_OFF = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-gray-400"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg>';

            $item    = str_replace('{{ link }}', V($templatePost, 'link'), $template);
            $item    = str_replace(TokenInterface::EMBED_RESULT_IMAGE_URL, V($templatePost, 'thumb'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_TITLE, V($templatePost, 'title'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_ADDRESS, V($templatePost, 'address'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_BASIC_TITLE, V($lng, 'capacity_basic'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_BASIC_VALUE, V($templatePost, 'capacity_basic', 0), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_TITLE, V($lng, 'capacity_additional'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_CAPACITY_ADDITIONAL_VALUE, V($templatePost, 'capacity_additional', 0), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_PRICE, V($templatePost, 'price'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_CURRENCY, V($templatePost, 'currency'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_BOOK_TITLE, V($lng, 'book'), $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_STAR_ON, $STAR_ON, $item);
            $item    = str_replace(TokenInterface::EMBED_RESULT_STAR_OFF, $STAR_OFF, $item);
            $items[] = [
                'title' => $post_title,
                'data'  => $item
            ];
        }
    }

    usort($items, function ($item1, $item2) {
        return $item1['title'] <=> $item2['title'];
    });
}
?>
<style><?php echo wp_unslash(get_option('bentral_card_style')); ?></style>
<div class="flex flex-wrap bentral-properties-cards hidden"><?php
    foreach ($items as $i) {
        echo V($i,'data');
    };
    ?></div>