<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="bentral_date_picker"><?php _e('Form date type', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_date_picker" name="bentral_date_picker" class="form-control" style="width: 100%">
                <?php $selectedModalDate = get_option('bentral_date_picker') ?: 'input'; ?>
                <option value="html" <?php if ($selectedModalDate === 'html') {
                    echo 'selected';
                } ?>><?php _e('HTML', 'bentral'); ?></option>
                <option value="input" <?php if ($selectedModalDate === 'input') {
                    echo 'selected';
                } ?>><?php _e('Input', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_form_init_option"><?php _e('Form init type', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_form_init_option" name="bentral_form_init_option" class="form-control" style="width: 100%">
                <?php $initOption = get_option('bentral_form_init_option') ?: 'onDocumentReady'; ?>
                <option value="onDocumentReady"<?php if ($initOption === 'onDocumentReady'): ?> selected<?php endif; ?>><?php _e('Document ready', 'bentral'); ?></option>
                <option value="onPageLoad"<?php if ($initOption === 'onPageLoad'): ?> selected<?php endif; ?>><?php _e('Page Load', 'bentral'); ?></option>
                <option value="manual"<?php if ($initOption === 'manual'): ?> selected<?php endif; ?>><?php _e('Manual (not recommended)', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="tr_bentral_form_days_from_today">
        <th scope="row">
            <label for="bentral_form_days_from_today"><?php _e('Start day (from today)', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_form_days_from_today" name="bentral_form_days_from_today" class="form-control" style="width: 100%">
                <?php
                $fromToday = intval(get_option('bentral_form_days_from_today'));
                for ($x = 0; $x <= 10; $x++) {
                    $selected = '';
                    if ($fromToday == $x) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $x . '">' . $x . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr class="tr_bentral_form_days_between_dates">
        <th scope="row">
            <label for="bentral_form_days_between_dates"><?php _e('Days between dates', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_form_days_between_dates" name="bentral_form_days_between_dates" class="form-control" style="width: 100%">
                <?php
                $max_count = get_option('bentral_form_days_between_dates');
                for ($x = 1; $x <= 60; $x++) {
                    $selected = '';
                    if (intval($max_count) == $x) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $x . '">' . $x . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_form_default_guests"><?php _e('Default guests number', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_form_default_guests" name="bentral_form_default_guests" class="form-control" style="width: 100%">
                <?php
                $max_count = get_option('bentral_form_default_guests');
                $selected  = '';
                if ($max_count == 'auto') {
                    $selected = 'selected';
                }
                for ($x = 1; $x <= 10; $x++) {
                    $selected = '';
                    if (intval($max_count) == $x) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $x . '">' . $x . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_form_max_guests_count"><?php _e('Max guests limit', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_form_max_guests_count" name="bentral_form_max_guests_count" class="form-control" style="width: 100%">
                <?php
                $max_count = get_option('bentral_form_max_guests_count');
                $selected  = '';
                if ($max_count == 'auto') {
                    $selected = 'selected';
                }
                echo '<option value="auto" ' . $selected . '>Auto - (' . get_option('bentral_max_capacity') . ')</option>';
                for ($x = 1; $x <= 30; $x++) {
                    $selected = '';
                    if (intval($max_count) == $x) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $x . '">' . $x . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_disable_tailwind"><?php _e('Disable Tailwind css', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_disable_tailwind" name="bentral_disable_tailwind" class="form-control" style="width: 100%">
                <?php $disableTailwind = get_option('bentral_disable_tailwind') ?: 'input'; ?>
                <option value="0" <?php if ($disableTailwind == '0') {
                    echo 'selected';
                } ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1" <?php if ($disableTailwind == '1') {
                    echo 'selected';
                } ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_api_key"><?php _e('Custom search URL', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="bentral_root_url" type="text" name="bentral_root_url" value="<?php echo esc_attr(get_option('bentral_root_url')); ?>"/>
        </td>
    </tr>
    <tr class="auto-open-date">
        <th scope="row">
            <label for="bentral_auto_open_from_date"><?php _e('Auto open date input', 'bentral'); ?></label>
        </th>
    </tr>
    <tr class="auto-open-date">
        <th scope="row">
            <label for="bentral_auto_open_from_date"><?php _e('FROM', 'bentral'); ?></label>
        </th>
        <td>
            <?php $detectLang = intval(get_option('bentral_auto_open_from_date')); ?>
            <select id="bentral_auto_open_from_date" name="bentral_auto_open_from_date" class="form-control" style="width: 100%">
                <option value="0"<?php if ($detectLang == 0): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($detectLang == 1): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="auto-open-date">
        <th scope="row">
            <label for="bentral_auto_open_to_date"><?php _e('TO', 'bentral'); ?></label>
        </th>
        <td>
            <?php $detectLang = intval(get_option('bentral_auto_open_to_date')); ?>
            <select id="bentral_auto_open_to_date" name="bentral_auto_open_to_date" class="form-control" style="width: 100%">
                <option value="0"<?php if ($detectLang == 0): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($detectLang == 1): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    </tbody>
</table>