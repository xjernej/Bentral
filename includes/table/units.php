<?php

include Bentral::get_plugin_path() . 'templates/shortcode/bentral_helpers.php';
include Bentral::get_plugin_path() . 'includes/table/helper.php';


$i = 1;
if (!empty($bentral_sync_properties)) {
    $propertyHTML .= $isCreatePageAndSearchType ? propertyListCreate() : propertyListSearch();

    // properties
    foreach ($bentral_sync_properties as $property) {
        $propertyId = V($property, 'id');
        $unitData   = V($bentral_sync_list, $propertyId, null);

        // check if property has units
        if (isset($unitData['units'])) {
            $propertyUnits = V($unitData, 'units');

            // property units
            foreach ($propertyUnits as $propertyUnit) {
                $propertyUnitId = V($propertyUnit, 'id');
                $propertyUuid   = 'bentral_' . $propertyId . '_' . $propertyUnitId;
                $propertyData   = V($bentral_properties, $propertyUuid, null);
                $tmpTitle       = onlyUnitTitle($property, $propertyUnit);
                if (empty($propertyData)) {
                    $propertyHTML .= $isCreatePageAndSearchType
                        ? propertyListEmptyTableCreate($i, $propertyId, $propertyUnitId, $property, $propertyUnit)
                        : propertyListEmptyTable($i, $propertyId, $propertyUnitId, $property, $propertyUnit);
                } else {
                    $propertyHTML .= $isCreatePageAndSearchType
                        ? propertyListCreateTable($i, $propertyId, $propertyUnitId, $propertyData, $selectedLang, $tmpTitle, $customIntro, $custom_description)
                        : propertyListSearchTable($i, $propertyId, $propertyUnitId, $propertyData, $selectedLang, $tmpTitle, $customIntro, $custom_description, $propertyListPosts);
                }
                $i++;
            }
        }
    }
    $propertyHTML .= '</tbody></table>';
}