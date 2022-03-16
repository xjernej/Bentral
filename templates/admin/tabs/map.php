<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="google-api-key"><?php _e('API Key', 'bentral'); ?></label>
            <br><a href="https://developers.google.com/maps/documentation/javascript/get-api-key"><?php _e('How to get API', 'bentral') ?></a>
        </th>
        <td>
            <input class="form-control" id="google-api-key" type="text" name="bentral_google_api_key" value="<?php echo esc_attr(get_option('bentral_google_api_key')); ?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="google-center-lat"><?php _e('Map center (LAT)', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="google-center-lat" type="text" name="bentral_google_center_lat" value="<?php echo esc_attr(get_option('bentral_google_center_lat')); ?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="google-center-lng"><?php _e('Map center (LNG)', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="google-center-lng" type="text" name="bentral_google_center_lng" value="<?php echo esc_attr(get_option('bentral_google_center_lng')); ?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Map type', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_google_type" name="bentral_google_type" class="form-control" >
                <?php $selectedValue = get_option('bentral_google_type') ?: 'page'; ?>
                <option value="roadmap" <?php if ($selectedValue === 'roadmap'): ?> selected<?php endif; ?>><?php _e('ROADMAP', 'bentral') ?></option>
                <option value="satellite" <?php if ($selectedValue === 'satellite'): ?> selected<?php endif; ?>><?php _e('SATELLITE', 'bentral') ?></option>
                <option value="hybrid" <?php if ($selectedValue === 'hybrid'): ?> selected<?php endif; ?>><?php _e('HYBRID', 'bentral') ?></option>
                <option value="terrain" <?php if ($selectedValue === 'terrain'): ?> selected<?php endif; ?>><?php _e('TERRAIN', 'bentral') ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Map zoom - multiple pins', 'bentral'); ?></label>
        </th>
        <td>
            <select name="bentral_google_zoom" class="form-control" >
                <?php
                $selectedValue = get_option('bentral_google_zoom') ?: '4';
                for ($i = 0; $i < 20; $i++) {
                    $selected = (intval($selectedValue) === $i) ? 'selected' : '';
                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Map zoom - single pin', 'bentral'); ?></label>
        </th>
        <td>
            <select name="bentral_google_zoom_single" class="form-control" >
                <?php
                $selectedValue = get_option('bentral_google_zoom_single') ?: '15';
                for ($i = 0; $i < 20; $i++) {
                    $selected = (intval($selectedValue) === $i) ? 'selected' : '';
                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    </tbody>
</table>