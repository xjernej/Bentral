<?php

try {
    $page_id = get_queried_object_id();

    if (isset($atts['id'])) {
        $page_id = $atts['id'];
    }

    if (!empty($page_id)) {
        include 'bentral_helpers.php';

        $bentral_key         = get_option('bentral_embed_key');
        $lang                = bentral_widget_language();
        $bentralUnit         = ($page_id == '<first>')
            ? bentral_first_unit()
            : bentral_unit_data($page_id, $lang);
        $bentral_property_id = V(V($bentralUnit, 'property'), 'id');
        $bentral_unit_id     = V(V($bentralUnit, 'unit'), 'id');

        if ((!empty($bentral_property_id)) && (!empty($bentral_unit_id))) {
            $params   = [];
            $params[] = 'id=' . $bentral_property_id;
            $params[] = 'uid=' . $bentral_unit_id;
            $params[] = 'lang=' . $lang;
            $params[] = 'key=' . $bentral_key;
            $params[] = 'width=full';
            $params[] = 'poweredby=0';
            $params[] = 'limit=' . get_option('bentral_reviews_count');

            if (intval(get_option('bentral_widget_reviews_enable') ? : '0') == 1) {
                $params[] = 'header-bg=' . str_replace('#', '', get_option('bentral_widget_reviews_head_1_bg'));
                $params[] = 'header-color=' . str_replace('#', '', get_option('bentral_widget_reviews_head_1_font'));
                $params[] = 'header2-bg=' . str_replace('#', '', get_option('bentral_widget_reviews_head_2_bg'));
                $params[] = 'header2-color=' . str_replace('#', '', get_option('bentral_widget_reviews_head_2_font'));
                $params[] = 'table-bg=' . str_replace('#', '', get_option('bentral_widget_reviews_table_bg'));
                $params[] = 'table-color=' . str_replace('#', '', get_option('bentral_widget_reviews_table_font'));
                $params[] = 'border-color=' . str_replace('#', '', get_option('bentral_widget_reviews_border_color'));
                if (intval(get_option('bentral_widget_reviews_sum')) == 0) {
                    $params[] = 'overall_rating=0';
                }
                if (intval(get_option('bentral_widget_reviews_author')) == 0) {
                    $params[] = 'author=0';
                }
                if (intval(get_option('bentral_widget_reviews_type')) == 0) {
                    $params[] = 'traveler_type=0';
                }
                if (intval(get_option('bentral_widget_reviews_date')) == 0) {
                    $params[] = 'dates=0';
                }
            }

            echo '<script src="//www.bentral.com/service/embed/reviews.js?' . implode('&', $params) . '"></script>';
        } else {
            echo '[bentral_reviews]: NO PROPERTY DATA';
        }
    } else {
        echo '[bentral_reviews] : NO POST ID';
    }
} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}

