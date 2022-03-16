<?php

wp_enqueue_editor();

if (!function_exists('tabHeader')) {
    function tabHeader($section, $showButton = false, $tabID = '', $custom = '')
    {
        $btn = '<input type="submit" name="submit" id="submit" class="button button-primary" style="width: 150px!important;" value="Save changes">';
        $btn .= ($showButton) ? '<button class="button button-default bentral-show-hide-property-btn" data-tab="' . $tabID . '" type="button">Show / Hide info</button>' : '';

        return '<div class="tab-topbar">
    <div class="subheader-options-group topbar-title">
        <h3><span class="page-title">Bentral options</span> <span class="sep">»</span> <span class="subpage-title">' . $section . '</span></h3>
        <span class="action-toolbar">' . $btn . $custom . '</span>
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

$pageTemplate = (get_option('bentral_type') != 'bentral_full') ? 'hidden' : '';
$bentral_result_template_selected = get_option('bentral_result_template_selected');

$templateOptions = [];
foreach (Bentral_Admin_Templates::templateList() as $item) {
    $selected = '';
    if ($item['value'] == $bentral_result_template_selected){
        $selected = 'selected';
    }
    $templateOptions[] = '<option value="' . $item['value'] . '" '.$selected.'>' . $item['name'] . '</option>';
}

$templateList = '
<div class="form-group row" style="width: 250px!important;float: right;">
    <label for="bentral_result_template_selected" class="col-sm-2 col-form-label" style="padding: 5px 0;">Templates:</label>
    <div class="col-sm-10">
        <select id="bentral_result_template_selected" name="bentral_result_template_selected" class="form-control" style="width: 150px!important;">
            <optgroup label="Manual">
                <option value="simple">User defined</option>
            </optgroup>
            <optgroup label="Templates">
                ' . implode('', $templateOptions) . '
            </optgroup>
        </select>
    </div>
  </div>
';

?>

<form method="post" novalidate="novalidate">
    <?php wp_nonce_field('wp_bentral_submit_nonce') ?>
    <?php wp_nonce_field('wp_submit_bentral_settings', 'wp_bentral_submit_nonce') ?>
    <div class="row bentral-admin">
        <div class="col-xs-12 bentral-tab-container">
            <div class="col-xs-2 bentral-tab-menu" style="width: 250px; height: 100%">
                <div class="menu-head" style="text-align: center; display: block;">
                    <img src="<?= Bentral::get_plugin_url() . 'assets/bentral-logo.png'; ?>">
                    <h3>Bentral Options<span class="version"><?= Bentral::version() ?></span></h3>
                </div>
                <div class="list-group">
                    <a href="#" data-tab="general" class="list-group-item"><i class="glyphicon glyphicon-home"></i><?php _e('General', 'bentral') ?></a>
                    <a href="#" data-tab="language" class="list-group-item"><i class="glyphicon glyphicon-flag"></i><?php _e('Language', 'bentral') ?></a>
                    <a href="#" data-tab="template-page" class="list-group-item <?= $pageTemplate; ?>"> <i class="glyphicon glyphicon-file"></i><?php _e('Page template', 'bentral') ?></a>
                    <a href="#" data-tab="search" class="list-group-item"><i class="glyphicon glyphicon-search"></i><?php _e('Search', 'bentral') ?></a>
                    <a href="#" data-tab="search-css" class="list-group-item"><i class="glyphicon glyphicon-eye-open"></i><?php _e('Search style', 'bentral') ?></a>
                    <a href="#" data-tab="results" class="list-group-item"><i class="glyphicon glyphicon-th-large"></i><?php _e('Results', 'bentral') ?></a>
                    <a href="#" data-tab="results-template" class="list-group-item"><i class="glyphicon glyphicon-file"></i><?php _e('Results template', 'bentral') ?></a>
                    <a href="#" data-tab="results-css" class="list-group-item"><i class="glyphicon glyphicon-eye-open"></i><?php _e('Results style', 'bentral') ?></a>
                    <a href="#" data-tab="gallery" class="list-group-item"><i class="glyphicon glyphicon-camera"></i><?php _e('Gallery', 'bentral') ?></a>
                    <a href="#" data-tab="gallery-css" class="list-group-item"><i class="glyphicon glyphicon-eye-open"></i><?php _e('Gallery style', 'bentral') ?></a>
                    <a href="#" data-tab="card-template" class="list-group-item"><i class="glyphicon glyphicon-file"></i><?php _e('Card template', 'bentral') ?></a>
                    <a href="#" data-tab="card-css" class="list-group-item"><i class="glyphicon glyphicon-eye-open"></i><?php _e('Card style', 'bentral') ?></a>
                    <a href="#" data-tab="service-template" class="list-group-item"><i class="glyphicon glyphicon-file"></i><?php _e('Service template', 'bentral') ?></a>
                    <a href="#" data-tab="service-css" class="list-group-item"><i class="glyphicon glyphicon-eye-open"></i><?php _e('Service style', 'bentral') ?></a>
                    <a href="#" data-tab="map" class="list-group-item"><i class="glyphicon glyphicon-map-marker"></i><?php _e('Map ', 'bentral') ?></a>
                    <a href="#" data-tab="translations" class="list-group-item"><i class="glyphicon glyphicon-globe"></i><?php _e('Translations', 'bentral') ?></a>
                    <a href="#" data-tab="shortcode" class="list-group-item"><i class="glyphicon glyphicon-book"></i><?php _e('Shortcodes', 'bentral') ?></a>
                </div>
            </div>
            <div class="col-xs-10 bentral-tab" style="width: calc(100% - 250px); height: 100%">
                <div data-tab="general" class="bentral-tab-content">
                    <?php
                    echo tabHeader('General');
                    include "tabs/general.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="language" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Language');
                    include "tabs/language.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="template-page" class="bentral-tab-content <?= $pageTemplate; ?>">
                    <?php
                    echo tabHeader('Page template', true, 'template-page');
                    include "tabs/template-page.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="search" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Search');
                    include "tabs/search.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="search-css" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Search style');
                    include "tabs/style-search.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="results" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Results');
                    include "tabs/results.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="results-template" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Results template', true, 'template-result', $templateList);
                    include "tabs/template-results.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="results-css" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Results style');
                    include "tabs/style-result.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="gallery" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Gallery');
                    include "tabs/gallery.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="gallery-css" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Gallery style');
                    include "tabs/style-gallery.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="card-template" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Card template', true, 'template-card');
                    include "tabs/template-card.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="card-css" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Card style');
                    include "tabs/style-card.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="service-template" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Service template', true, 'template-service');
                    include "tabs/template-service.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="service-css" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Service style');
                    include "tabs/style-service.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="map" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Map');
                    include "tabs/map.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="translations" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Translations');
                    include "tabs/translation.php";
                    echo tabFooter();
                    ?>
                </div>
                <div data-tab="shortcode" class="bentral-tab-content">
                    <?php
                    echo tabHeader('Shortcodes');
                    include "tabs/shortcode.php";
                    echo tabFooter();
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>