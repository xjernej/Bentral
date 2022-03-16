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

            $arrival      = V($_GET,'arrival','');
            $departure    = V($_GET,'departure','');
            $persons      = V($_GET,'persons','');

            $params   = [];
            $params[] = 'id=' . $bentral_property_id;
            $params[] = 'unit=' . $bentral_unit_id;
            $params[] = 'lang=' . $lang;
            $params[] = 'key=' . $bentral_key;
            if (!empty($arrival)){
                $params[] = 'arrival=' . $arrival;
            }
            if (!empty($departure)){
                $params[] = 'departure=' . $departure;
            }
            if (!empty($persons)){
                $params[] = 'persons=' . $persons;
            }

            $params[] = 'poweredby=0';
            $params[] = 'width=full';

            if (intval(get_option('bentral_widget_search_enable') ? : '0') == 1) {
                $params[] = 'header-bg=' . str_replace('#', '', get_option('bentral_widget_search_head_1_bg'));
                $params[] = 'header-color=' . str_replace('#', '', get_option('bentral_widget_search_head_1_font'));
                $params[] = 'header2-bg=' . str_replace('#', '', get_option('bentral_widget_search_head_2_bg'));
                $params[] = 'header2-color=' . str_replace('#', '', get_option('bentral_widget_search_head_2_font'));
                $params[] = 'table-bg=' . str_replace('#', '', get_option('bentral_widget_search_table_bg'));
                $params[] = 'table-color=' . str_replace('#', '', get_option('bentral_widget_search_table_font'));
                $params[] = 'btn-bg=' . str_replace('#', '', get_option('bentral_widget_search_button_bg'));
                $params[] = 'btn-color=' . str_replace('#', '', get_option('bentral_widget_search_button_font'));
                $params[] = 'border-color=' . str_replace('#', '', get_option('bentral_widget_search_border_color'));
                if (intval(get_option('bentral_widget_search_border_enable')) == 0) {
                    $params[] = 'border-width=0';
                }
            }

            echo '<script src="//www.bentral.com/service/embed/booking.js?' . implode('&', $params) . '"></script>';
        } else {
            $params   = [];
            $params[] = 'lang=' . $lang;
            $params[] = 'key=' . $bentral_key;
            if (!empty($arrival)){
                $params[] = 'arrival=' . $arrival;
            }
            if (!empty($departure)){
                $params[] = 'departure=' . $departure;
            }
            if (!empty($persons)){
                $params[] = 'persons=' . $persons;
            }

            $params[] = 'poweredby=0';
            $params[] = 'width=full';
            echo '<script src="//www.bentral.com/service/embed/booking.js?' . implode('&', $params) . '"></script>';
        }
    } else {
        echo 'BENTRAL RESERVATION ERROR : NO POST ID';
    }

} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}