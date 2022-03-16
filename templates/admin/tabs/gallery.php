<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_type"><?php _e('Gallery type', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_type" name="bentral_gallery_type" class="form-control" >
                <?php $bentral_gallery_type = get_option('bentral_gallery_type') ?: 'thumbnail'; ?>
                <option value="thumbnail"<?php if ($bentral_gallery_type === 'thumbnail'): ?> selected<?php endif; ?>><?php _e('Thumbnail', 'bentral'); ?></option>
                <option value="slider"<?php if ($bentral_gallery_type === 'slider'): ?> selected<?php endif; ?>><?php _e('Slider', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_image_source"><?php _e('Image source', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_image_source" name="bentral_gallery_image_source" class="form-control"
                    >
                <?php $thumbSource = get_option('bentral_gallery_image_source'); ?>
                <option value="wordpress"<?php if ($thumbSource === 'wordpress'): ?> selected<?php endif; ?>><?php _e('Wordpress', 'bentral'); ?></option>
                <option value="bentral"<?php if ($thumbSource === 'bentral'): ?> selected<?php endif; ?>><?php _e('Bentral', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_auto_init"><?php _e('Auto galley init', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_auto_init" name="bentral_gallery_auto_init" class="form-control" >
                <?php $selectedValue = intval(get_option('bentral_gallery_auto_init')); ?>
                <option value="1" <?php if ($selectedValue === 1) {
                    echo 'selected';
                } ?>><?php _e('Yes', 'bentral') ?>
                </option>
                <option value="0" <?php if ($selectedValue === 0) {
                    echo 'selected';
                } ?>><?php _e('No', 'bentral') ?>
                </option>
            </select>
        </td>
    </tr>
    <tr class="gallery_type_thumbnail <?= ($bentral_gallery_type == 'thumbnail') ? '' : 'hidden' ?>">
        <th scope="row">
            <label for="bentral_image_columns"><?php _e('Image columns', 'bentral'); ?></label>
        </th>
        <td>
            <?php
            $bentral_image_columns = esc_attr(get_option('bentral_image_columns'));
            ?>
            <select id="bentral_image_columns" name="bentral_image_columns" class="form-control" >
                <option value="2"<?php if ($bentral_image_columns == '2'): ?> selected<?php endif; ?>><?php _e('2', 'bentral'); ?></option>
                <option value="3"<?php if ($bentral_image_columns == '3'): ?> selected<?php endif; ?>><?php _e('3', 'bentral'); ?></option>
                <option value="4"<?php if ($bentral_image_columns == '4'): ?> selected<?php endif; ?>><?php _e('4', 'bentral'); ?></option>
                <option value="5"<?php if ($bentral_image_columns == '5'): ?> selected<?php endif; ?>><?php _e('5', 'bentral'); ?></option>
                <option value="6"<?php if ($bentral_image_columns == '6'): ?> selected<?php endif; ?>><?php _e('6', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    </tbody>
</table>

<hr>

<table class="form-table gallery_type_slider <?= ($bentral_gallery_type == 'slider') ? '' : 'hidden' ?>"
       role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_slider_type"><?php _e('Slider type', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_slider_type" name="bentral_gallery_slider_type" class="form-control"
                    >
                <?php $bentral_gallery_slider_type = get_option('bentral_gallery_slider_type') ?: 'gallery'; ?>
                <option value="default"<?php if ($bentral_gallery_slider_type === 'default'): ?> selected<?php endif; ?>><?php _e('Default', 'bentral'); ?></option>
                <option value="gallery"<?php if ($bentral_gallery_slider_type === 'gallery'): ?> selected<?php endif; ?>><?php _e('Thumbnail horizontal', 'bentral'); ?></option>
                <option value="gallery_vertical"<?php if ($bentral_gallery_slider_type === 'gallery_vertical'): ?> selected<?php endif; ?>><?php _e('Thumbnail vertical', 'bentral'); ?></option>
                <option value="visible_nearby"<?php if ($bentral_gallery_slider_type === 'visible_nearby'): ?> selected<?php endif; ?>><?php _e('Visible nearby', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_slider_fullscreen"><?php _e('Slider show fullscreen', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_slider_fullscreen" name="bentral_gallery_slider_fullscreen" class="form-control"
                    >
                <?php $bentral_gallery_slider_fullscreen = intval(get_option('bentral_gallery_slider_fullscreen')) ?>
                <option value="0"<?php if ($bentral_gallery_slider_fullscreen == 0): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($bentral_gallery_slider_fullscreen == 1): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_slider_auto_play"><?php _e('Slider auto play', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_slider_auto_play" name="bentral_gallery_slider_auto_play" class="form-control"
                    >
                <?php $bentral_gallery_slider_auto_play = intval(get_option('bentral_gallery_slider_auto_play')); ?>
                <option value="0"<?php if ($bentral_gallery_slider_auto_play == 0): ?> selected<?php endif; ?>><?php _e('No', 'bentral'); ?></option>
                <option value="1"<?php if ($bentral_gallery_slider_auto_play == 1): ?> selected<?php endif; ?>><?php _e('Yes', 'bentral'); ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_slider_delay"><?php _e('Slider auto play', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_gallery_slider_delay" name="bentral_gallery_slider_delay" class="form-control"
                    >
                <?php $bentral_gallery_slider_delay = get_option('bentral_gallery_slider_delay') ?: 3000;
                for ($x = 2; $x <= 20; $x++) {
                    $value    = $x * 500;
                    $second   = number_format($value / 1000,1);
                    $selected = ($bentral_gallery_slider_delay == $value) ? 'selected' : '';
                    echo '<option value="' . $value . '" ' . $selected . '>' . $second . ' seconds</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_slider_width"><?php _e('Slider width', 'bentral'); ?></label>
        </th>
        <td>
            <?php $bentral_gallery_slider_width = get_option('bentral_gallery_slider_width') ?: '100%';?>
            <input id="bentral_gallery_slider_width" name="bentral_gallery_slider_width" class="form-control" value="<?=$bentral_gallery_slider_width?>" >
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="bentral_gallery_slider_height"><?php _e('Slider height', 'bentral'); ?></label>
        </th>
        <td>
            <?php $bentral_gallery_slider_height = get_option('bentral_gallery_slider_height') ?: '500px';?>
            <input id="bentral_gallery_slider_height" name="bentral_gallery_slider_height" class="form-control" value="<?=$bentral_gallery_slider_height?>" >
        </td>
    </tr>
    </tbody>
</table>


<table class="form-table gallery_type_thumbnail <?= ($bentral_gallery_type == 'thumbnail') ? '' : 'hidden' ?>"
       role="presentation">
    <tbody>
    <tr>
    <tr>
        <td>
            <h2><?php _e('Gallery image template', 'bentral') ?></h2>
        </td>
    </tr>
    <td style="padding: 0 10px; vertical-align: top;">
        <textarea name="image_template" id="bentral-image-template" cols="80" rows="10"
                  style="margin-right: 10px; "><?php echo wp_unslash(get_option('bentral_image_template') ?: trim(Bentral_Admin_Templates::defaultGalleryTemplate())) ?></textarea>
    </td>
    <td width="420" style="vertical-align: top;">
        <?php if (!empty($tokens = \Bentral\Wordpress\Token::availableImageTokens())): ?>
            <span class="description">
                                <ul>
                                    <?php foreach ($tokens as $token => $description): ?>
                                        <li class="xLi"><span
                                                    class="xVar"><?php echo $token; ?></span> - <?php echo $description ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </span>
        <?php endif; ?>
    </td>
    </tr>
    </tbody>
</table>