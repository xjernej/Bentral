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

            if (intval(get_option('bentral_widget_calendar_enable') ? : '0') == 1) {

                $params[] = 'months=' . get_option('bentral_widget_calendar_month_number');
                $params[] = 'cols=' . get_option('bentral_widget_calendar_month_columns');
                $params[] = 'header-bg=' . str_replace('#', '', get_option('bentral_widget_calendar_head_1_bg'));
                $params[] = 'header-color=' . str_replace('#', '', get_option('bentral_widget_calendar_head_1_font'));
                $params[] = 'header2-bg=' . str_replace('#', '', get_option('bentral_widget_calendar_head_2_bg'));
                $params[] = 'header2-color=' . str_replace('#', '', get_option('bentral_widget_calendar_head_2_font'));
                $params[] = 'table-bg=' . str_replace('#', '', get_option('bentral_widget_calendar_table_bg'));
                $params[] = 'table-color=' . str_replace('#', '', get_option('bentral_widget_calendar_table_font'));
                $params[] = 'border-color=' . str_replace('#', '', get_option('bentral_widget_calendar_border_color'));
                if (intval(get_option('bentral_widget_calendar_border_enable')) == 0) {
                    $params[] = 'border-width=0';
                }
                if (intval(get_option('bentral_widget_calendar_month_change')) == 0) {
                    $params[] = 'list=false';
                }
                if (intval(get_option('bentral_widget_calendar_legend')) == 0) {
                    $params[] = 'legend=false';
                }
            }

            echo '<script src="//www.bentral.com/service/embed/calendar.js?' . implode('&', $params) . '"></script>';
        } else {
            echo 'BENTRAL CALENDAR ERROR : NO PROPERTY DATA';
        }
    } else {
        echo 'BENTRAL CALENDAR ERROR : NO POST ID';
    }
} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}