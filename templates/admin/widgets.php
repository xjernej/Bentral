<?php

if (!function_exists('bentral_shortcode')) {
    function bentral_shortcode($shortcode, $type = 'widget', $imageURL = null, $imageWidth = '100%', $customShortCodeAttr = '',$customStyle = '')
    {
        $shortcodeText = '[bentral-' . $type . ' type="' . $shortcode . '" id="<first>"'.$customShortCodeAttr.']';
        $shortcodeTextNoId = '[bentral-' . $type . ' type="' . $shortcode . '"'.$customShortCodeAttr.']';
        $widget        = '';
        if ($imageURL === null) {
            $widget = do_shortcode($shortcodeText);
        } else {
            if ($imageURL !== false) {
                $widget = '<img style="float: left; width:' . $imageWidth . ';" src="' . Bentral::get_plugin_url() . $imageURL . '" />';
            }
        }
        return '<h3 style="margin-top: 0">' . translate('Shortcode', 'bentral') . '</h3>
            <div class="xVar" style="padding: 5px 10px; width: 250px;">'.$shortcodeTextNoId.'</div>
            <hr>
            <h3>' . translate('Preview', 'bentral') . '</h3>
            <div style="margin-right: 20px; border: 1px solid #ddd; max-height: 600px; overflow: auto;'.$customStyle.'">' . $widget . '
        </div>
        ';
    }
}

if (!function_exists('bentral_setting_color')) {
    function bentral_setting_color($title, $name)
    {
        return '
        <div class="row">
            <div class="col-md-4">
                <label class="bentral-label">' . translate($title, 'bentral') . '</label>
            </div>
            <div class="col-md-8">
                <input class="bentral-color form-control" name="' . $name . '" value="' . esc_attr(get_option($name)) . '"/>
            </div>
        </div>
        ';
    }
}

if (!function_exists('bentral_setting_input')) {
    function bentral_setting_input($title, $name, $disabled = 'No', $enabled = 'Yes')
    {
        $value = get_option($name) ?: '';
        return '
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-4">
                <label class="bentral-label">' . translate($title, 'bentral') . '</label>
            </div>
            <div class="col-md-8">
                <input class="bentral-select form-control" name="' . $name . '" value="'.$value.'" />
            </div>
        </div>';
    }
}

if (!function_exists('bentral_setting_checkbox')) {
    function bentral_setting_checkbox($title, $name, $disabled = 'No', $enabled = 'Yes')
    {
        $option = intval(get_option($name) ?: '0');
        $selYes = ($option == 1) ? 'selected' : '';
        $selNo  = ($option == 0) ? 'selected' : '';
        return '
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-4">
                <label class="bentral-label">' . translate($title, 'bentral') . '</label>
            </div>
            <div class="col-md-8">
                <select class="bentral-select form-control" name="' . $name . '">
                    <option value="0" ' . $selNo . '>' . $disabled . '</option>
                    <option value="1" ' . $selYes . '>' . $enabled . '</option>
                </select>
            </div>
        </div>';
    }
}

if (!function_exists('bentral_setting_number')) {
    function bentral_setting_number($title, $name, $from = 1, $to = 10)
    {
        $option  = intval(get_option($name) ?: '0');
        $options = [];

        for ($i = $from; $i <= $to; $i++) {
            $selected  = ($option == $i) ? 'selected' : '';
            $options[] = '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
        }

        return '
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-4">
                <label class="bentral-label">' . translate($title, 'bentral') . '</label>
            </div>
            <div class="col-md-8">
                <select class="bentral-select form-control" name="' . $name . '">
                    ' . implode('', $options) . '
                </select>
            </div>
        </div>';
    }
}

if (!function_exists('bentral_setting_input')) {
    function bentral_setting_input($title, $name, $defaultValue)
    {
        return '
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-4">
                <label class="bentral-label">' . translate($title, 'bentral') . '</label>
            </div>
            <div class="col-md-8">
                <input class="bentral-input form-control" name="' . $name . '" value="'.$defaultValue.'" />
            </div>
        </div>';
    }
}

if (!function_exists('bentral_setting_select')) {
    function bentral_setting_select($title, $name, $optionsData, $defaultValue)
    {
        $option  = get_option($name) ?: $defaultValue;
        $options = [];
        foreach ($optionsData as $item) {
            $selected  = ($option == $item['value']) ? 'selected' : '';
            $options[] = '<option value="' . $item['value'] . '" ' . $selected . '>' . $item['text'] . '</option>';
        }
        return '
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-4">
                <label class="bentral-label">' . translate($title, 'bentral') . '</label>
            </div>
            <div class="col-md-8">
                <select class="bentral-select form-control" name="' . $name . '">
                    ' . implode('', $options) . '
                </select>
            </div>
        </div>';
    }
}

if (!function_exists('bentral_setting_section')) {
    function bentral_setting_section($title)
    {
        return '<h4 class="bentral-section">' . $title . '</h4>';
    }
}

if (!function_exists('tabHeader')) {
    function tabHeader($section, $showButton = false)
    {
        $btn = ($showButton) ? '<input type="submit" name="submit" id="submit" class="button button-primary" style="width: 150px!important;" value="Save changes">' : '';

        return '<div class="tab-topbar">
    <div class="subheader-options-group topbar-title">
        <h3><span class="page-title">Bentral widgets</span> <span class="sep">»</span> <span class="subpage-title">' . $section . '</span></h3>
        <span class="action-toolbar">' . $btn . '</span>
    </div>
</div>
<div class="tab-content">
    <div class="card-group">
    
';
    }
}

if (!function_exists('tabFooter')) {
    function tabFooter()
    {
        return '</div></div>';
    }
}

?>
<form method="post" novalidate="novalidate">
    <?php
    wp_nonce_field('wp_bentral_submit_nonce') ?>
    <?php
    wp_nonce_field('wp_submit_bentral_widgets', 'wp_bentral_submit_nonce') ?>
    <div class="row bentral-admin">
        <div class="col-xs-12 bentral-tab-container">
            <div class="col-xs-2 bentral-tab-menu" style="width: 250px; height: 100%">
                <div class="menu-head" style="text-align: center; display: block;">
                    <img src="<?= Bentral::get_plugin_url() . 'assets/bentral-logo.png'; ?>">
                    <h3>Bentral Widgets<span class="version"><?= Bentral::version() ?></span></h3>
                </div>
                <div class="list-group">
                    <a href="#" data-tab="reservation" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Reservation form', 'bentral') ?></a>
                    <a href="#" data-tab="calendar" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Calendar', 'bentral') ?></a>
                    <a href="#" data-tab="price" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Price', 'bentral') ?></a>
                    <a href="#" data-tab="reviews" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Reviews', 'bentral') ?></a>
                    <a href="#" data-tab="search-form" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Search form', 'bentral') ?></a>
                    <a href="#" data-tab="search-result" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Search results', 'bentral') ?></a>
                    <a href="#" data-tab="image-gallery" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Image gallery', 'bentral') ?></a>
                    <a href="#" data-tab="services" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Service list', 'bentral') ?></a>
                    <a href="#" data-tab="list" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Properties list', 'bentral') ?></a>
                    <a href="#" data-tab="cards" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Properties cards', 'bentral') ?></a>
                    <a href="#" data-tab="map" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Maps - Single', 'bentral') ?></a>
                    <a href="#" data-tab="maps" class="list-group-item"><h4 class="glyphicon glyphicon-triangle-right"></h4><?php _e('Maps - All', 'bentral') ?></a>
                </div>
            </div>
            <div class="col-xs-10 bentral-tab" style="width: calc(100% - 250px); height: 100%">
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Reservation form', true);
                    include "widgets/reservation.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Calendar', true);
                    include "widgets/calendar.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Price', true);
                    include "widgets/price.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Reviews', true);
                    include "widgets/reviews.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Search form', true);
                    include "widgets/search-form.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Search result');
                    include "widgets/search-result.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Gallery');
                    include "widgets/gallery.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Service list');
                    include "widgets/services.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Property list');
                    include "widgets/list.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Property cards');
                    include "widgets/cards.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Map - single');
                    include "widgets/map.php";
                    echo tabFooter();
                    ?>
                </div>
                <div class="bentral-tab-content">
                    <?php
                    echo tabHeader('Map - all');
                    include "widgets/maps.php";
                    echo tabFooter();
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>