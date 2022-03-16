<?php

$selectedLang              = $_POST['lang'];
$bentral_type              = get_option('bentral_type');
$bentral_sync_list         = get_option('bentral_sync_list');
$bentral_sync_properties   = get_option('bentral_sync_properties');
$bentral_properties        = get_option('bentral_all_properties');
$bentral_properties_delete = get_option('bentral_delete_properties');
$isCreatePageAndSearchType = ($bentral_type == 'bentral_full') ? true : false;

update_option('bentral_property_list_lang', $selectedLang);

if (!function_exists('postList')) {
    function postList()
    {
        $post_type = get_option('bentral_import_type') ?: 'page';
        if ($post_type === 'custom') {
            $post_type = get_option('bentral_custom_import_type');
        }
        $query = new WP_Query(array(
            'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC'
        ));
        return $query->posts;
    }
}

if (!function_exists('propertyListCreate')) {
    function propertyListCreate()
    {
        return '<table class="wp-list-table widefat fixed striped pages bentral_properties">
    <thead>
        <tr>                                
            <th style="width: 35px">#</th>
            <th style="width: 280px">Actions</th>
            <th>Property Name</th>
            <th style="width: 150px">Updated</th>
        </th>
    </thead>
</tbody>';
    }
}

if (!function_exists('propertyListSearch')) {
    function propertyListSearch()
    {
        return '<table class="wp-list-table widefat fixed striped bentral_properties">
    <thead>
        <tr>
            <th style="width: 35px">#</th>
            <th style="width: 160px">Actions</th>
            <th>Property name</th>   
            <th style="width: 150px">Updated</th>
            <th style="width: 550px">Page ID</th>                                
        </th>
    </thead>
 </tbody>';
    }
}

if (!function_exists('propertyListCreateButtons')) {
    function propertyListCreateButtons($i, $property, $descEntered)
    {
        $btn        = '';
        $btn_add    = '';
        $btn_update = 'hidden';
        if (!empty($property['post_id'])) {
            $btn_add    = 'hidden';
            $btn_update = '';
        }
        $btn .= '<button title="Create page for unit" class="button property-import ' . $btn_add . '" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '" data-no="' . $i . '">Import</button>';
        $btn .= '<button title="Update only page content" class="button property-update ' . $btn_update . '" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '" data-no="' . $i . '">Update</button>';
        $btn .= '<button title="Update page and download images for unit" class="button property-import-force  ' . $btn_update . '" style="margin-left: 10px;"  data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '" data-no="' . $i . '">Update + Picture</button>';
        $btn .= '<div title="Show unit pictures" class="property-picture" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '"></div>';
        $btn .= '<div title="Edit custom description" class="property-description ' . $descEntered . '" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '"></div>';
        $btn .= '</div>';
        return $btn;
    }
}

if (!function_exists('propertyListSearchButtons')) {
    function propertyListSearchButtons($i, $property, $descEntered)
    {
        $btn = '';
        $btn .= '<button title="Sync data from Bentral" class="button button-primary property-sync" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '" data-no="' . $i . '">Update</button>';
        $btn .= '<div title="Show unit pictures" class="property-picture" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '"></div>';
        $btn .= '<div title="Edit custom description" class="property-description ' . $descEntered . '" data-property-id="' . $property['property']['id'] . '" data-unit-id="' . $property['unit']['id'] . '"></div>';
        return $btn;
    }
}

if (!function_exists('propertyUnitImageList')) {
    function propertyUnitImageList($propertyData)
    {
        $img_list = [];
        $images   = $propertyData['unit']['images'];
        if (!empty($images)) {
            foreach ($images as $image) {
                $img_list[] = '<a title="Open page" target="_blank" href="' . $image['url'] . '"><img class="img-preview" style="height:100px; margin: 0 4px 4px 0;" data-src="' . $image['url'] . '" /></a>';
            }
        }
        return $img_list;
    }
}


if (!function_exists('propertyListCreateTable')) {
    function propertyListDescriptionAndImages($propertyId, $propertyUnitId, $propertyTags, $lang, $rowUnitName, $rowImgList, $propertyIntro, $propertyDescription)
    {
        return '
            <tr class="tr-picture picture-' . $propertyUnitId . ' hidden">
                <td colspan="5">' . implode('', $rowImgList) . '</td>
            </tr>
            <tr class="tr-text text-' . $propertyUnitId . ' hidden">
                <td colspan="5">
                    <h3>' . $rowUnitName . '</h3>
                    <div class="form-group">
                        <label>Intro text</label>
                        <input class="form-control" id="' . $lang . '_intro_' . $propertyUnitId . '" value="' . $propertyIntro . '" style="max-width: 100%!important;">
                    </div>
                    <textarea id="' . $lang . '_desc_' . $propertyUnitId . '" style="width: 100%; min-height: 300px;" class="bentral_editor">' . $propertyDescription . '</textarea>
                    <div class="form-group">
                        <label>Tags</label>
                        <input class="form-control" id="' . $lang . '_tags_' . $propertyUnitId . '" value="' . $propertyTags . '" style="max-width: 100%!important;">
                    </div>
                    <hr>
                    <a class="button property-desc-cancal" data-property-id="' . $propertyId . '" data-unit-id="' . $propertyUnitId . '">Cancel</a>
                    <a class="button button-primary property-desc-update" data-property-id="' . $propertyId . '" data-unit-id="' . $propertyUnitId . '">Update description</a>
                </td>
            </tr>
            ';
    }
}
if (!function_exists('propertyListCreateTable')) {
    function propertyListCreateTable($i, $propertyId, $propertyUnitId, $propertyData, $lang, $emptyTitle, $customIntro, $customDescription)
    {
        $descEntered         = '';
        $propertyIntro       = '';
        $propertyDescription = '';
        $bentral_unit        = 'bentral_' . $propertyId . '_' . $propertyUnitId;
        if (isset($customIntro[$bentral_unit])) {
            $intro = $customIntro[$bentral_unit];
            if (isset($intro[$lang])) {
                $propertyIntro = htmlspecialchars_decode($intro[$lang]);
            }
        }
        if (isset($customDescription[$bentral_unit])) {
            $descriptions = $customDescription[$bentral_unit];
            if (isset($descriptions[$lang])) {
                $propertyDescription = htmlspecialchars_decode($descriptions[$lang]);
                if (!empty($propertyDescription)) {
                    $descEntered = 'data';
                }
            }
        }
        $rowClass     = 'unit-' . $propertyId . '-' . $propertyUnitId;
        $rowButtons   = propertyListCreateButtons($i, $propertyData, $descEntered);
        $rowPostId    = V($propertyData, 'post_id');
        $propertyTags = V($propertyData, 'tags');
        $rowPostLink  = get_permalink($rowPostId);
        $rowUnitName  = bentral_property_title($propertyData, $rowPostId, $lang);
        if (!empty($rowPostId)) {
            $rowUnitName = '<a href="' . $rowPostLink . '"> ' . $rowUnitName . ' </a>';
        }
        $rowLastUpdated = V($propertyData, 'updated');
        $rowImgList     = propertyUnitImageList($propertyData);
        if (empty(trim($rowUnitName))) $rowUnitName = $emptyTitle;

        $propertyTagsListHtml = '';
        if (!empty($propertyTags)) {
            $propertyTagsList = explode(',',V($propertyData, 'tags'));
            foreach ($propertyTagsList AS $tags){
                $propertyTagsListHtml .= '<span class="tag">' . $tags.'</span>';
            }
            $propertyTagsListHtml = '<br>Tags: <span class="bentral-tags">' . $propertyTagsListHtml.'</span>';
        }

        return '
            <tr class="tr-data ' . $rowClass . '">
                <td class="data no">' . $i . '</td>
                <td class="data action bentral_actions">' . $rowButtons . '</td>
                <td class="data name unit-link">' . $rowUnitName . $propertyTagsListHtml. '</td>
                <td class="data updated">' . $rowLastUpdated . '</td>
            </tr>' . propertyListDescriptionAndImages($propertyId, $propertyUnitId, $propertyTags, $lang, $rowUnitName, $rowImgList, $propertyIntro, $propertyDescription);
    }
}

if (!function_exists('propertyPairSelectButton')) {
    function propertyPairSelectButton($post_id, $pages, $propertyId, $propertyUnitId, $customUrl)
    {
        $select_id   = 'post_' . $propertyId . '_' . $propertyUnitId;
        $post_select = '<select id="' . $select_id . '" name="' . $select_id . '" class="d4-select" style="width: 450px;"><option value="0"> -- Not selected --</option>';
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $selected = '';
                if ($post_id == $page->ID) {
                    $selected = 'selected';
                }
                $post_select .= '<option ' . $selected . ' value="' . $page->ID . '">' . $page->post_title . '</option>';
            }
        }
        $post_select .= '</select>';

        $html = '';
        if (!empty($pages)) {
            $html = $post_select . '<a style="margin-left: 5px;" class="button property-set-post" data-element="' . $select_id . '" data-property-id="' . $propertyId . '" data-unit-id="' . $propertyUnitId . '">Save</a>';
        } else {
            $html = $post_select . '<a style="margin-left: 5px;" class="button property-set-post" disabled>Save</a>';
        }

        $manual_result_site_url = intval(get_option('bentral_custom_result_site_url'));
        if ($manual_result_site_url == 1) {
            $html .= '<div class="form-group"><label style="margin-top: 3px;">Custom URL</label><input type="url" class="form-control manual-url" placeholder="Enter full URL" value="' . $customUrl . '"></div>';
        }
        $manual_url_input = '';

        return $html;
    }
}

if (!function_exists('propertyListSearchTable')) {
    function propertyListSearchTable($i, $propertyId, $propertyUnitId, $propertyData, $lang, $emptyTitle, $customIntro, $customDesc, $propertyListPosts)
    {
        $descEntered         = '';
        $propertyIntro       = '';
        $propertyDescription = '';
        $bentral_unit        = 'bentral_' . $propertyId . '_' . $propertyUnitId;

        if (isset($customIntro[$bentral_unit])) {
            $intro = $customIntro[$bentral_unit];
            if (isset($intro[$lang])) {
                $propertyIntro = htmlspecialchars_decode($intro[$lang]);
            }
        }

        if (isset($customDesc[$bentral_unit])) {
            $descriptions = $customDesc[$bentral_unit];
            if (isset($descriptions[$lang])) {
                $propertyDescription = htmlspecialchars_decode($descriptions[$lang]);
                if (!empty($propertyDescription)) {
                    $descEntered = 'data';
                }
            }
        }
        $rowClass   = 'unit-' . $propertyId . '-' . $propertyUnitId;
        $rowButtons = propertyListSearchButtons($i, $propertyData, $descEntered);
        $rowPostId  = '';

        if (isset($propertyData['post'])) {
            if (isset($propertyData['post'][$lang])) {
                $rowPostId = $propertyData['post'][$lang];
            }
        }

        $rowPostLink = get_permalink($rowPostId);
        $rowUnitName = bentral_property_title($propertyData, $rowPostId, $lang, true);
        if (!empty($rowPostId)) {
            $rowUnitName = '<a href="' . $rowPostLink . '"> ' . $rowUnitName . ' </a>';
        }

        $rowImgList = propertyUnitImageList($propertyData);
        if (empty(trim($rowUnitName))) $rowUnitName = $emptyTitle;

        $customUrl = '';
        if (isset($propertyData['customURL'])) {
            if (isset($propertyData['customURL'][$lang])) {
                $customUrl = $propertyData['customURL'][$lang];
            }
        }
        $rowLastUpdated   = V($propertyData, 'updated');
        $pairSelectButton = propertyPairSelectButton($rowPostId, $propertyListPosts, $propertyId, $propertyUnitId, $customUrl);
        $propertyTags     = V($propertyData, 'tags');
        $propertyTagsListHtml = '';
        if (!empty($propertyTags)) {
            $propertyTagsList = explode(',',V($propertyData, 'tags'));
            foreach ($propertyTagsList AS $tags){
                $propertyTagsListHtml .= '<span class="tag">' . $tags.'</span>';
            }
            $propertyTagsListHtml = '<br>Tags: <span class="bentral-tags">' . $propertyTagsListHtml.'</span>';
        }
        return '
            <tr class="tr-data ' . $rowClass . '">
                <td>' . $i . '</td>            
                <td class="data action bentral_actions" style="width: 200px">' . $rowButtons . '</td>
                <td class="data name unit-link">' . $rowUnitName . $propertyTagsListHtml. '</td>
                <td class="data updated">' . $rowLastUpdated . '</td>
                <td class="data page-id">' . $pairSelectButton . '</td>                
            </tr>
            ' . propertyListDescriptionAndImages($propertyId, $propertyUnitId, $propertyTags, $lang, $rowUnitName, $rowImgList, $propertyIntro, $propertyDescription);;
    }
}

if (!function_exists('propertyListEmptyTableCreate')) {
    function propertyListEmptyTableCreate($i, $propertyId, $propertyUnitId, $property, $propertyUnit)
    {
        $rowClass   = 'unit-' . $propertyId . '-' . $propertyUnitId;
        $rowButtons = '<button title="Sync data from Bentral" class="button button-primary property-sync" data-property-id="' . $propertyId . '" data-unit-id="' . $propertyUnitId . '" data-no="' . $i . '">Synchronize</button>';
        return '
            <tr class="' . $rowClass . '">
                <td class="data no">' . $i . '</td>
                <td class="data action">' . $rowButtons . '</td>
                <td class="data name">' . onlyUnitTitle($property, $propertyUnit) . '</td>
                <td class="data updated"><b style="color: red;">Sync data first!</b></td>
            </tr>';
    }
}

if (!function_exists('propertyListEmptyTable')) {
    function propertyListEmptyTable($i, $propertyId, $propertyUnitId, $property, $propertyUnit)
    {
        $rowClass   = 'unit-' . $propertyId . '-' . $propertyUnitId;
        $rowButtons = '<button title="Sync data from Bentral" class="button button-primary property-sync" data-property-id="' . $propertyId . '" data-unit-id="' . $propertyUnitId . '" data-no="' . $i . '">Synchronize</button>';
        return '
            <tr class="' . $rowClass . '">
                <td class="data no">' . $i . '</td>
                <td class="data action">' . $rowButtons . '</td>
                <td class="data name">' . onlyUnitTitle($property, $propertyUnit) . '</td>
                <td class="data updated">/</td>
                <td class="data property-id">' . $propertyId . ' - ' . $propertyUnitId . '</td>
            </tr>';
    }
}

if (!function_exists('onlyUnitTitle')) {
    function onlyUnitTitle($property, $propertyUnit)
    {
        return V($propertyUnit, 'unofficialName', V($property, 'name') . ' - ' . V($propertyUnit, 'type') . ' ' . V($propertyUnit, 'label')) . ' [ ' . V($propertyUnit, 'capacityBasic') . ' + ' . V($propertyUnit, 'capacityAdditional') . ']';
    }
}


$propertyHTML = '';

if (empty($selectedLang)) {
    $selectedLang = get_option('bentral_form_language');
}
if (empty($custom_description)) {
    $custom_description = [];
}

$pages = postList();

