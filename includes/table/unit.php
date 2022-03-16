<?php

include Bentral::get_plugin_path() . 'templates/shortcode/bentral_helpers.php';
include Bentral::get_plugin_path() . 'includes/table/helper.php';

$parameterId               = $_POST['no'] ?? '';
$id                        = $id ?? $parameterId;
$selectedLang              = $selectedLang ?? $_POST['lang'];
$property                  = $property ?? [];
$propertyUnit              = $propertyUnit ?? [];
$customIntro               = $customIntro ?? [];
$custom_description        = $custom_description ?? [];
$isCreatePageAndSearchType = get_option('bentral_type') == 'bentral_full';
$tmpTitle                  = onlyUnitTitle($property, $propertyUnit);
$propertyHTML              = $isCreatePageAndSearchType
    ? propertyListCreateTable($id, $propertyId, $propertyUnitId, $propertyData, $selectedLang, $tmpTitle, $customIntro, $custom_description)
    : propertyListSearchTable($id, $propertyId, $propertyUnitId, $propertyData, $selectedLang, $tmpTitle, $customIntro, $custom_description, $propertyListPosts);