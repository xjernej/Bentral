<?php

if (!function_exists('serviceIcon')) {

    function serviceIcon($service)
    {
        switch ($service) {
            case 'internet':
                return '<i class="fas fa-wifi"></i>';
                break;
            case 'ac':
                return '<i class="fas fa-snowflake"></i>';
                break;
            case 'infantBed':
                return '<i class="fas fa-bed"></i>';
                break;
            case 'extraBed':
                return '<i class="fas fa-bed"></i>';
                break;
            case 'taxAdult':
                return '<i class="fas fa-euro-sign"></i>';
                break;
            case 'taxChild':
                return '<i class="fas fa-euro-sign"></i>';
                break;
            case 'reservation':
                return '<i class="far fa-calendar-times"></i>';
                break;
            case 'registration':
                return '<i class="far fa-calendar-times"></i>';
                break;
            case 'deposit':
                return '<i class="fas fa-euro-sign"></i>';
                break;
            case 'finalCleaning':
                return '<i class="fas fa-broom"></i>';
                break;
            case 'pet':
                return '<i class="fas fa-paw"></i>';
                break;
            case 'breakfast':
                return '<i class="fas fa-utensils"></i>';
                break;
            case 'halfboard':
                return '<i class="fas fa-utensils"></i>';
                break;
            case 'fullboard':
                return '<i class="fas fa-utensils"></i>';
                break;
            case 'other':
                return '<i class="fab fa-diaspora"></i>';
                break;
        }
    }
}

if (!function_exists('getServiceLabel')) {
    function getServiceLabel($labelType, $selected_lang)
    {
        $services = V($selected_lang, 'services');
        if (!empty($services)) {
            if (isset($services[$labelType])) {
                return $services[$labelType];
            }
        } else {
            $services = [
                'ac'            => __('Klimatska naprava', 'bentral'),
                'breakfast'     => __('Zajtrk', 'bentral'),
                'deposit'       => __('Deposit', 'bentral'),
                'extraBed'      => __('Dodatno pomožno ležišče', 'bentral'),
                'infantBed'     => __('Otroška posteljica', 'bentral'),
                'halfboard'     => __('Polpenzion', 'bentral'),
                'fullboard'     => __('Polni penzion', 'bentral'),
                'finalCleaning' => __('Zaključno čiščenje', 'bentral'),
                'internet'      => __('Internet', 'bentral'),
                'pet'           => __('Hišni ljubljenčki', 'bentral'),
                'registration'  => __('Prijavnina', 'bentral'),
                'reservation'   => __('Rezervacija', 'bentral'),
                'taxAdult'      => __('Turistična taksa (odrasli)', 'bentral'),
                'taxChild'      => __('Turistična taksa (otroci)', 'bentral'),
            ];
            if (isset($services[$labelType])) {

                return $services[$labelType];
            }
        }
        return 'NO LANG FOR : ' . $labelType;
    }
}

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
        $properties          = get_option('bentral_all_properties');
        if (!empty($properties)) {
            $pID = 'bentral_' . $bentral_property_id . '_' . $bentral_unit_id;
            if (isset($properties[$pID])) {
                echo '<style>' . wp_unslash(get_option('bentral_service_style_css')) . '</style>';
                $property = $properties[$pID];

                if (isset($property['unit']['services'])) {
                    $services      = $property['unit']['services'];
                    $service_style = get_option('bentral_service_style');
                    switch ($service_style) {
                        case 'table' :
                            echo '<div class="bentral-services"><table class="bentral-service-table"><tbody>';
                            foreach ($services as $service) {
                                if ($service['exists']) {
                                    echo '<tr>';
                                    echo '<td class="service-icon">' . serviceIcon($service['service']) . '</td>';
                                    if ($service['service'] == 'other') {
                                        if ($service['service']['price']['type'] == 'extra') {
                                            echo '<td class="service-title">' . $service['description'] . ' (' . $service['price']['amount'] . ' ' . $service['price']['currency'] . ')</td>';
                                        } else {
                                            echo '<td class="service-title">' . $service['description'] . '</td>';
                                        }
                                    } else {
                                        echo '<td class="service-title">' . getServiceLabel($service['service'], $lang) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            echo '</table></tbody></div>';
                            break;
                        default :
                            echo '<div class="bentral-services">';
                            foreach ($services as $service) {
                                if ($service['exists']) {
                                    echo '<div class="item" data-type="' . $service['service'] . '">';
                                    echo serviceIcon($service['service']);
                                    if ($service['service'] == 'other') {
                                        if ($service['price']['type'] == 'extra') {
                                            echo '<span class="title">' . $service['description'] . ' (' . $service['price']['amount'] . ' ' . $service['price']['currency'] . ')</span>';
                                        } else {
                                            echo '<span class="title">' . $service['description'] . '</span>';
                                        }
                                    } else {
                                        echo '<span class="title">' . getServiceLabel($service['service'], $lang) . '</span>';
                                    }
                                    echo '</div>';
                                }
                            }
                            echo '</div>';
                            break;
                    }
                }
            }
        }
    }
}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}
