<?php
$page_id = get_queried_object_id();
if (isset($atts['id'])) {
    $page_id = $atts['id'];
}

include 'bentral_helpers.php';

if (!empty($page_id)) {
    $selected_lang       = page_language();
    $bentral_property_id = get_post_meta($page_id, 'bentral_property_id')[0];
    $bentral_unit_id     = get_post_meta($page_id, 'bentral_unit_id')[0];
    $custom_description  = get_option('bentral_custom_description');
    $pID                 = 'bentral_' . $bentral_property_id . '_' . $bentral_unit_id;
    if (isset($custom_description[$pID])) {
        $descriptions = $custom_description[$pID];
        if (isset($descriptions[$selected_lang])) {
            echo nl2br(htmlspecialchars_decode($descriptions[$selected_lang]));
        }
    }
} else {
    echo 'BENTRAL DESCRIPTION ERROR : NO POST ID';
}