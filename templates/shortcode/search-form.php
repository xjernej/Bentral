<?php

include 'bentral_helpers.php';

$allowedTags          = isset($allowedTags) ? $allowedTags : '';
$date_style           = get_option('bentral_form_style') ?: '';
$initType             = get_option('bentral_form_init_option') ?: 'onDocumentReady';
$dateType             = get_option('bentral_date_picker') ?: 'modal';
$lang_data            = wp_unslash(get_option('bentral_lang_settings'));
$custom_lang          = json_decode($lang_data, true);
$page_lang            = page_language();
$date                 = bentral_page_date_format($page_lang, $custom_lang);
$lang                 = V($custom_lang, $page_lang, V($custom_lang, 'en'));
$date_date_format     = $date['format'];
$selected_guest_count = intval(get_option('bentral_form_default_guests'));
$max_guests_count     = get_option('bentral_form_max_guests_count');
if ($max_guests_count == 'auto') {
    $max_guests_count = intval(get_option('bentral_max_capacity'));
}

$dataAttr                        = [];
$dataAttr['init-type']           = $initType;
$dataAttr['lang']                = $page_lang;
$dataAttr['lang-plugin']         = get_option('bentral_language_plugin') ?: 'auto';
$dataAttr['date-type']           = $dateType;
$dataAttr['detect-lang']         = get_option('bentral_form_detect_lang') ?: '1';
$dataAttr['auto-open-from-date'] = get_option('bentral_auto_open_from_date');
$dataAttr['auto-open-to-date']   = get_option('bentral_auto_open_to_date');
$dataAttr['days-between-dates']  = intval(get_option('bentral_form_days_between_dates'));
$dataAttr['days-from-today']     = intval(get_option('bentral_form_days_from_today'));;
$dataAttr['results-offset']      = get_option('bentral_results_offset');
$dataAttr['search-tags']         = (!empty($allowedTags)) ? $allowedTags : '*';
$formDataAttr = [];
foreach ($dataAttr AS $key => $value){
    $formDataAttr[] = 'data-'.$key.'="'.$value.'"';
}
?>
<style><?php echo wp_unslash(get_option('bentral_search_style') ?: trim(Bentral_Admin_Templates::defaultSearchStyle())) ?></style>
<script>let bentral_lang = <?=json_encode($lang);?>;</script>
<?php
include_once 'searchForm/' . $dateType . '.php';