<?php

try {
    $page_id = get_queried_object_id();

    if (!empty($page_id)) {
        include 'bentral_helpers.php';
        $lang         = bentral_widget_language();
        $bentral_data = bentral_unit_data($page_id, $lang);
        if (!empty($bentral_data)){
            echo V(V($bentral_data,'unit'),'size').' m<sup>2</sup>';
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