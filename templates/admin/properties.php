<?php
wp_enqueue_editor();

global $wpdb;

$bentral_type      = get_option('bentral_type');
$properties_update = get_option('bentral_all_properties_update');
$detect_lang_code  = intval(get_option('bentral_form_detect_lang'));
$lang_list         = json_decode(wp_unslash(get_option('bentral_lang_settings')), true);

if ($detect_lang_code == 1) {
    $defaultLang = get_option('bentral_property_list_lang') ?: get_option('bentral_form_language');
} else {
    $defaultLang = get_option('bentral_form_language');
}
$properties        = get_option('bentral_all_properties');
$customIntro       = get_option('bentral_custom_intro');
$customDescription = get_option('bentral_custom_description');
$tdStyle           = 'border-bottom: 1px solid rgba(255,255,255,0.5); vertical-align: top; padding: 5px;';
$debugTableStyle   = 'style="width: 100%; background: #0d2b3e; color: #fffca8; border-spacing: 0;"';

if (!function_exists('tabHeader')) {
    function tabHeader($section, $showButton = false)
    {
        $btn = ($showButton) ? '<button class="button button-default bentral-show-hide-property-btn" data-tab="template-card" type="button">Show / Hide info</button>' : '';
        return '<div class="tab-topbar">
    <div class="subheader-options-group topbar-title">
        <h3><span class="page-title">Bentral Properties</span> <span class="sep">»</span> <span class="subpage-title">' . $section . '</span></h3>
        ' . $btn . '
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
<div class="empty-loader hidden">
    <div class="empty-table">
        <img src="<?= Bentral::get_plugin_url() . 'assets/empty.gif'; ?>">
        <h2>Loading data</h2>
    </div>
</div>

<form method="post" novalidate="novalidate">
    <?php wp_nonce_field('wp_bentral_submit_nonce') ?>
    <?php wp_nonce_field('wp_submit_bentral_settings', 'wp_bentral_submit_nonce') ?>
    <div class="row bentral-admin">
        <div class="col-xs-12 bentral-tab-container">
            <div class="col-xs-2 bentral-tab-menu" style="width: 250px; height: 100%; float: left;">
                <div class="menu-head" style="text-align: center; display: block;">
                    <img src="<?= Bentral::get_plugin_url() . 'assets/bentral-logo.png'; ?>">
                    <h3>Bentral Properties<span class="version"><?= Bentral::version() ?></span></h3>
                </div>
                <div class="list-group">
                    <?php
                    $i              = 1;
                    $selLangDisplay = '';
                    foreach ($lang_list as $key => $lang) {
                        $lang_name = $key;
                        if (isset($lang['name'])) {
                            if (!empty($lang['name'])) {
                                $lang_name = $lang['name'];
                            }
                        }
                        $active = '';
                        if ($defaultLang === $key) {
                            $selLangDisplay = $lang_name;
                            $active         = 'active';
                        }

                        echo '<a href="#" data-tab="lang-' . $key . '" data-lang="' . $key . '" data-lang-display="' . $lang_name . '" class="list-group-item lang-menu ' . $active . '"><i class="glyphicon glyphicon-flag"></i>' . $lang_name . '</a>';
                        $i++;
                    }
                    ?>
                </div>
                <span id="admin-menu" style="width: 100%; display: none; margin-top: 20px">
                    <h4 style="color: #fff;">Admin actions</h4>
                    <select id="property-actions" name="property_action" class="form-control" style="width: 170px!important; float: left;">
                        <option selected="selected" value="table_data"><?php _e('Table data', 'bentral') ?></option>
                        <optgroup label="<?php _e('Debug', 'bentral') ?>">
                            <option selected="selected" value="property_list"><?php _e('Property data', 'bentral') ?></option>
                            <option value="property_data"><?php _e('Units data', 'bentral') ?></option>
                            <option value="property_intro"><?php _e('Property intro', 'bentral') ?></option>
                            <option value="property_desc"><?php _e('Property description', 'bentral') ?></option>
                            <option value="bentral_post_list"><?php _e('Posts with Bentral ID', 'bentral') ?></option>
                        </optgroup>
                        <optgroup label="<?php _e('Data', 'bentral') ?>">
                            <option value="delete_all"><?php _e('Delete all data', 'bentral') ?></option>
                        </optgroup>
                    </select>
                    <button id="property-action" class="button button-primary" type="button" style="margin-left: 5px; padding: 2px 10px; float: left;"><span><?php _e('GO', 'bentral') ?></span></button>
                </span>
            </div>
            <input id="bentral_form_language" type="hidden" name="bentral_form_language" class="form-control" value="<?= $defaultLang ?>">
            <div class="col-xs-10 bentral-tab" style="width: calc(100% - 250px); height: 100%; float: left;">
                <span class="action-toolbar">
                    <a class="button button-primary" type="button" id="bentral-refresh-list"><span><?= _e('Update from Bentral', 'bentral') ?></span></a>
                    <?php
                    if ($bentral_type == 'bentral_full') {
                        if (!empty($properties)) {
                            ?>
                            <a class="button button-secondary" type="button" id="bentral-import-force"><span><?php _e('Update all with picture', 'bentral') ?></span></a>
                            <a class="button button-secondary" type="button" id="bentral-import"><span><?php _e('Update all', 'bentral') ?></span></a>
                            <?php
                        }
                    } ?>
                </span>
                <div class="bentral-tab-content active">
                    <?php
                    echo tabHeader($selLangDisplay);
                    echo '<div id="table_data" class="properties-list tabData">
                        <div class="empty-table">
                            <img src="' . Bentral::get_plugin_url() . 'assets/empty.gif' . '">
                            <h2>Loading data</h2>
                        </div>
                    </div>';
                    include "propertiesDebug.php";
                    echo tabFooter();
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>