<textarea name="bentral_gallery_style" id="bentral_gallery_style" rows="30"><?php
    echo wp_unslash(get_option('bentral_gallery_style') ?: trim(Bentral_Admin_Templates::defaultGalleryStyle()))
    ?></textarea>
