<?php

try {
    $page_id = get_queried_object_id();

    if (!empty($page_id)) {
        include 'bentral_helpers.php';
        $lang     = bentral_widget_language();
        $property = bentral_unit_data($page_id, $lang);
        if (!empty($property)){
            echo V(V($property,'property'), 'name');
        } else {
            echo 'NOT LINK TO BENTRAL PROPERTY';
        }
    } else {
        echo 'NO POST ID';
    }
}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}