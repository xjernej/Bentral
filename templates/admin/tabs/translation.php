<?php

if (!function_exists('transInput')) {
    function transInputs($field, $value)
    {
        $title = str_replace('_', ' ', $field);
        $title = ucfirst($title);
        return '
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="bentral-label col-form-label">' . $title . '</label>
            </div>
            <div class="col-sm-8">
                <input class="form-control lang-input" name="' .$field . '" value="' . esc_attr($value) . '"/>
            </div>
        </div>
        ';
    }
}
if (!function_exists('transSubInputs')) {
    function transSubInputs($field, $array)
    {
        $title = str_replace('_', ' ', $field);
        $title = ucfirst($title);
        $subFields = '';

        foreach ($array as $key => $v) {
            if (!is_array($v)) {
                $subFields .= transInputs($field.'.'.$key, $v);
            }
        }

        return '
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label">' . $title . '</label>
            </div>
            <div class="col-sm-8">'.$subFields.'</div>
        </div>
        ';
    }
}

$op_lng = get_option('bentral_lang_settings');
if (empty($op_lng)) {
    $op_lng = trim(Bentral_Admin_Templates::defaulLanguageData());
    update_option('bentral_lang_settings', $op_lng);
}
$langList = json_decode($op_lng, true);
$defaultLang = get_option('bentral_translation_language_selected');
?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-6 col-form-label langSerialization">Selected language</label>
            <div class="col-sm-6">
                <select id="bentral_translation_language_selected" name="bentral_translation_language_selected" class="form-control">
                    <?php
                    if (!empty($langList)) {
                        foreach ($langList as $key => $lang) {
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
            </div>
        </div>
    </div>
    <div class="col-sm-6">
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <hr>
        <?php
        foreach (array_keys($langList) as $lang) {
            $fields = $langList[$lang];
            $hidden = ($lang == $defaultLang) ? '' :'hidden';
            echo '<div class="section-language ' . $hidden . '" data-lang="' . $lang . '">';
            foreach ($fields as $key => $value) {
                if (!is_array($value)) {
                    echo transInputs($key, $value);
                }
            }
            echo '</div>';
        }
        ?>
    </div>
    <div class="col-sm-6">
        <hr>
        <?php
        foreach (array_keys($langList) as $lang) {
            $fields = $langList[$lang];
            $hidden = ($lang == $defaultLang) ? '' :'hidden';
            echo '<div class="section-language ' . $hidden . '" data-lang="' . $lang . '">';
            foreach ($fields as $key => $value) {
                if (is_array($value)) {
                    echo transSubInputs($key, $value);
                }
            }
            echo '</div>';
        }
        ?>
    </div>
</div>
<div class="manual-lang-editor hidden">
<textarea id="bentral_lang_settings" name="bentral_lang_settings" rows="30" style="width: calc(100% - 50px)"><?php
    $op_lng = get_option('bentral_lang_settings');
    if (empty($op_lng)) {
        $op_lng = trim(Bentral_Admin_Templates::defaulLanguageData());
        update_option('bentral_lang_settings', $op_lng);
    }
    echo wp_unslash($op_lng);
    ?></textarea>
</div>