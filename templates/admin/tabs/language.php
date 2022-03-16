<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="bentral_form_language"><?php _e('Default language', 'bentral'); ?></label>
        </th>
        <td>
            <?php
            $lang_list = json_decode(wp_unslash(get_option('bentral_lang_settings')), true);
            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    echo 'Language - Maximum stack depth exceeded';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo 'Language - Underflow or the modes mismatch';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    echo 'Language - Unexpected control character found';
                    break;
                case JSON_ERROR_SYNTAX:
                    echo 'Language - Syntax error, malformed JSON';
                    break;
                case JSON_ERROR_UTF8:
                    echo 'Language - Malformed UTF-8 characters, possibly incorrectly encoded';
                    break;
            }
            if (empty($lang_list)) {
                $lang_list = trim(Bentral_Admin_Templates::defaulLanguageData());
            }

            ?>
            <select id="bentral_form_language" name="bentral_form_language" class="form-control" style="width: 100%">
                <?php
                $defaultLang = get_option('bentral_form_language');

                if (!empty($lang_list)) {
                    foreach ($lang_list as $key => $lang) {
                        $lang_name = $key;
                        if (isset($lang['name'])) {
                            if (!empty($lang['name'])) {
                                $lang_name = $lang['name'];
                            }
                        }
                        if ($defaultLang === $key) {
                            echo '<option value="' . $key . '" selected>' . $lang_name . '</option>';
                        } else {
                            echo '<option value="' . $key . '" >' . $lang_name . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr class="detect-lang">
        <th scope="row">
            <label for="bentral_form_detect_lang"><?php _e('Detect lang (multilang)', 'bentral'); ?></label>
            <span style="color: #6858bd;font-weight: normal"><?php _e('domain.com/<b>en</b>/home', 'bentral') ?></span>
        </th>
        <td>
            <?php $detectLang = intval(get_option('bentral_form_detect_lang')); ?>
            <select id="bentral_form_detect_lang" name="bentral_form_detect_lang" class="form-control" style="width: 100%">
                <option value="0"<?php if ($detectLang == 0): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($detectLang == 1): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <?php
    $language_plugin_visible = 'hidden';
    if (intval($detectLang) == 1) {
        $language_plugin_visible = '';
    }
    ?>
    <tr class="language-plugin <?= $language_plugin_visible; ?>">
        <th scope="row">
            <label for="bentral_language_plugin"><?php _e('Language plugin', 'bentral'); ?></label>
        </th>
        <td>
            <?php $language_plugin = get_option('bentral_language_plugin') ?: 'auto'; ?>
            <select id="bentral_language_plugin" name="bentral_language_plugin" class="form-control" style="width: 100%">
                <option value="auto"<?php if ($language_plugin === 'auto'): ?> selected<?php endif; ?>><?php _e('Auto', 'bentral'); ?></option>
                <option value="wpml"<?php if ($language_plugin === 'wpml'): ?> selected<?php endif; ?>><?php _e('WPML', 'bentral'); ?></option>
                <option value="polylang"<?php if ($language_plugin === 'polylang'): ?> selected<?php endif; ?>><?php _e('Polylang', 'bentral'); ?></option>
                <option value="loco"<?php if ($language_plugin === 'loco'): ?> selected<?php endif; ?>><?php _e('Loco Translate', 'bentral'); ?></option>
                <option value="translatepress"<?php if ($language_plugin === 'translatepress'): ?> selected<?php endif; ?>><?php _e('TranslatePress', 'bentral'); ?></option>
                <option value="weglot"<?php if ($language_plugin === 'weglot'): ?> selected<?php endif; ?>><?php _e('Weglot', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr class="detect-lang">
        <th scope="row">
            <label for="bentral_form_detect_lang"><?php _e('Manual result site URL', 'bentral'); ?></label>
        </th>
        <td>
            <?php $manual_result_site_url = intval(get_option('bentral_custom_result_site_url')); ?>
            <select id="bentral_custom_result_site_url" name="bentral_custom_result_site_url" class="form-control" style="width: 100%">
                <option value="0"<?php if ($manual_result_site_url == 0): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($manual_result_site_url == 1): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    </tbody>
</table>