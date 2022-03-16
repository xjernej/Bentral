<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="bentral_api_key"><?php _e('API Key', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="bentral_api_key" type="text" name="api_key" value="<?php echo esc_attr(get_option('bentral_api_key')); ?>"/>
            <button class="button button-secondary" type="button" id="bentral-verify-key" style="margin-top: 3px;">
                <img
                        src="<?php echo admin_url('images/loading.gif'); ?>"
                        alt="loading"
                        class="loading-img hidden"
                />
                <span><?php _e('Verify key', 'bentral') ?></span>
            </button>
            <p class="description hidden" id="verification-message"></p>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_embed_key"><?php _e('Embed Key', 'bentral'); ?></label>
        </th>
        <td>
            <input class="form-control" id="bentral_embed_key" type="text" name="embed_key" value="<?php echo esc_attr(get_option('bentral_embed_key')); ?>"/>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="import_type"><?php _e('Post type', 'bentral'); ?></label>
        </th>
        <td>
            <select id="import_type" name="import_type" class="form-control" class="form-control">
                <?php $bentral_import_type = get_option('bentral_import_type') ?: 'page'; ?>
                <option value="post"<?php if ($bentral_import_type === 'post'): ?> selected<?php endif; ?>><?php _e('Post', 'bentral'); ?></option>
                <option value="page"<?php if ($bentral_import_type === 'page'): ?> selected<?php endif; ?>><?php _e('Page', 'bentral'); ?></option>
                <option value="custom"<?php if ($bentral_import_type === 'custom'): ?> selected<?php endif; ?>><?php _e('Custom', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <?php
    $custom_import_display = 'hidden';
    if ($bentral_import_type == 'custom') {
        $custom_import_display = '';
    }
    ?>
    <tr class="custom_type_row <?= $custom_import_display; ?>">
        <th scope="row">
            <label for="bentral_custom_import_type"><?php _e('Custom post type', 'bentral'); ?></label>
        </th>
        <td>
            <?php
            $selectedCustomType = esc_attr(get_option('bentral_custom_import_type')) ?: 'post';
            global $wp_post_types;
            $typeList = array_keys($wp_post_types);
            ?>
            <select id="bentral_custom_import_type" name="bentral_custom_import_type" class="form-control">
                <?php
                foreach ($typeList as $item) {
                    $itemSelec = '';
                    if ($item == $selectedCustomType) {
                        $itemSelec = 'selected';
                    }
                    echo '<option value="' . $item . '" ' . $itemSelec . '>' . $item . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_type"><?php _e('Mode', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_type" name="bentral_type" class="form-control" style="width: 100%">
                <?php $bentral_type = get_option('bentral_type') ?: 'page'; ?>
                <option value="bentral_full"<?php if ($bentral_type === 'bentral_full'): ?> selected<?php endif; ?>><?php _e('Generate + Search', 'bentral'); ?></option>
                <option value="bentral_search"<?php if ($bentral_type === 'bentral_search'): ?> selected<?php endif; ?>><?php _e('Search', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <?php
    $delete_post_row = 'hidden';
    if (get_option('bentral_type') == 'bentral_full') {
        $delete_post_row = '';
    }
    ?>
    <tr>
        <th scope="row">
            <label><?php _e('Number of reviews to display', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_reviews_count" name="bentral_reviews_count" class="form-control">
                <?php $bentral_reviews_count = get_option('bentral_reviews_count') ?: 5;
                for ($x = 1; $x <= 25; $x++) {
                    $selected = '';
                    if (intval($bentral_reviews_count) === $x) {
                        $selected = 'selected';
                    }
                    echo '<option value="' . $x . '" ' . $selected . '>' . $x . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_error_search_result"><?php _e('Search debug', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_search_debug" name="bentral_search_debug" class="form-control">
                <?php $bentral_search_debug = intval(get_option('bentral_search_debug') ?: '0'); ?>
                <option value="0" <?php if ($bentral_search_debug === 0) {
                    echo 'selected';
                } ?>><?php _e('No', 'bentral'); ?>
                </option>
                <option value="1" <?php if ($bentral_search_debug === 1) {
                    echo 'selected';
                } ?>><?php _e('Yes', 'bentral'); ?>
                </option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_https_ssl_verify"><?php _e('HTTPS SSL verify', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_https_ssl_verify" name="bentral_https_ssl_verify" class="form-control">
                <?php $bentral_https_ssl_verify = intval(get_option('bentral_https_ssl_verify') ?: '0'); ?>
                <option value="0" <?php if ($bentral_https_ssl_verify === 0) { echo 'selected'; } ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1" <?php if ($bentral_https_ssl_verify === 1) { echo 'selected'; } ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Page postmeta data', 'bentral'); ?></label>
        </th>
        <td>
            <textarea name="page_postmeta" id="bentral-page-postmeta" rows="5" style="margin-right: 10px; width: 50rem;"><?php echo wp_unslash(get_option('bentral_page_postmeta') ?: trim(Bentral_Admin_Templates::defaultPagePostmeta())) ?></textarea>
        </td>
        <td style="vertical-align: top;">
            <span class="description">
                    <?php _e('Enter JSON format. Key value for table postmeta', 'bentral') ?><br/>
                    <ul>
                        <li class="xLi"><span class="xVar"><?= trim(Bentral_Admin_Templates::defaultPagePostmeta()) ?></li>
                    </ul>
                </span>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_empty_search_result"><?php _e('Search message - empty', 'bentral'); ?></label>
        </th>
        <td>
             <textarea name="bentral_empty_search_result" id="bentral_empty_search_result" rows="6" style="margin-right: 10px; width: 50rem;"><?php
                 $op2 = trim(get_option('bentral_empty_search_result'));
                 if (empty($op2)) {
                     $op2 = trim(Bentral_Admin_Templates::defaultEmptySearchResult());
                     update_option('bentral_error_search_result', $op2);
                 }
                 echo wp_unslash($op2);
                 ?></textarea>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_error_search_result"><?php _e('Search message - error', 'bentral'); ?></label>
        </th>
        <td>
             <textarea name="bentral_error_search_result" id="bentral_error_search_result" rows="6" style="margin-right: 10px; width: 50rem;"><?php
                 $op3 = trim(get_option('bentral_error_search_result'));
                 if (empty($op3)) {
                     $op3 = trim(Bentral_Admin_Templates::defaultErrorSearchResult());
                     update_option('bentral_error_search_result', $op3);
                 }
                 echo wp_unslash($op3);
                 ?></textarea>
        </td>
    </tr>
    </tbody>
</table>