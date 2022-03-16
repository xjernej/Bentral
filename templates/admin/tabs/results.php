<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="page_title_type"><?php _e('Property title', 'bentral'); ?></label>
        </th>
        <td>
            <select id="page_title_type" name="page_title_type" class="form-control" style="width: 100%">
                <?php $selectedValue = get_option('bentral_page_title_type') ?: 'page'; ?>
                <option value="property"<?php if ($selectedValue === 'property'): ?> selected<?php endif; ?>><?php _e('Property name', 'bentral'); ?></option>
                <option value="unit"<?php if ($selectedValue === 'unit'): ?> selected<?php endif; ?>><?php _e('Unit name', 'bentral'); ?></option>
                <option value="type_unit"<?php if ($selectedValue === 'type_unit'): ?> selected<?php endif; ?>><?php _e('Unit type + name', 'bentral'); ?></option>
                <option value="property_unit"<?php if ($selectedValue === 'property_unit'): ?> selected<?php endif; ?>><?php _e('Property name + Unit name', 'bentral'); ?></option>
                <option value="property_type_unit"<?php if ($selectedValue === 'property_type_unit'): ?> selected<?php endif; ?>><?php _e('Property name + Unit type + Unit name', 'bentral'); ?></option>
                <option value="unofficial"<?php if ($selectedValue === 'unofficial'): ?> selected<?php endif; ?>><?php _e('Unofficial name', 'bentral'); ?></option>
                <option value="property_unofficial"<?php if ($selectedValue === 'property_unofficial'): ?> selected<?php endif; ?>><?php _e('Property name - Unofficial name', 'bentral'); ?></option>
                <option value="official"<?php if ($selectedValue === 'official'): ?> selected<?php endif; ?>><?php _e('Official name', 'bentral'); ?></option>
                <option value="property_official"<?php if ($selectedValue === 'property_official'): ?> selected<?php endif; ?>><?php _e('Property name + Official name', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_result_property_title"><?php _e('Property title source', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_result_property_title" name="bentral_result_property_title" class="form-control" style="width: 100%">
                <?php $selectedValue = get_option('bentral_result_property_title') ?: 'page'; ?>
                <option value="bentral"<?php if ($selectedValue === 'bentral'): ?> selected<?php endif; ?>><?php _e('Bentral name', 'bentral'); ?></option>
                <option value="page"<?php if ($selectedValue === 'page'): ?> selected<?php endif; ?>><?php _e('Post name', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_thumbnail_source"><?php _e('Thumbnail image source', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_thumbnail_source" name="bentral_thumbnail_source" class="form-control" style="width: 100%">
                <?php $thumbSource = get_option('bentral_thumbnail_source'); ?>
                <option value="bentral"<?php if ($thumbSource === 'bentral'): ?> selected<?php endif; ?>><?php _e('Bentral', 'bentral'); ?></option>
                <option value="wordpress"<?php if ($thumbSource === 'wordpress'): ?> selected<?php endif; ?>><?php _e('Wordpress', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <?php
    $thumbSizeClass = 'hidden';
    if (get_option('bentral_thumbnail_source') === 'wordpress') {
        $thumbSizeClass = '';
    }
    ?>
    <tr class="thumbnail-size <?= $thumbSizeClass; ?>">
        <th scope="row">
            <label for="bentral_thumbnail_size"><?php _e('Thumbnail size', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_thumbnail_size" name="bentral_thumbnail_size" class="form-control" style="width: 100%">
                <?php $thumbSize = get_option('bentral_thumbnail_size') ?: 'medium'; ?>
                <option value="thumbnail"<?php if ($thumbSize === 'thumbnail'): ?> selected<?php endif; ?>><?php _e('Thumbnail', 'bentral'); ?></option>
                <option value="medium"<?php if ($thumbSize === 'medium'): ?> selected<?php endif; ?>><?php _e('Medium', 'bentral'); ?></option>
                <option value="large"<?php if ($thumbSize === 'large'): ?> selected<?php endif; ?>><?php _e('Large', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_result_property_lang_url"><?php _e('Add language to url', 'bentral'); ?></label>
            <span style="color: #6858bd;font-weight: normal">domain.com/<b>en</b>/home</home</span>
        </th>
        <td>
            <select id="bentral_result_property_lang_url" name="bentral_result_property_lang_url" class="form-control" style="width: 100%">
                <?php $selectedValue = get_option('bentral_result_property_lang_url') ?: '0'; ?>
                <option value="0"<?php if ($selectedValue === '0'): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($selectedValue === '1'): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_results_custom_url"><?php _e('Add custom url after lang section', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="bentral_results_custom_url" type="text" name="bentral_results_custom_url" value="<?php echo esc_attr(get_option('bentral_results_custom_url')); ?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_results_offset"><?php _e('Search focus offset (number ob pixels)', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="bentral_results_offset" type="text" name="bentral_results_offset" value="<?php echo esc_attr(get_option('bentral_results_offset')); ?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_custom_image_path"><?php _e('Custom image path', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="bentral_custom_image_path" type="text" name="bentral_custom_image_path" value="<?php echo esc_attr(get_option('bentral_custom_image_path')); ?>"/>
        </td>
    </tr>
    </tbody>
</table>