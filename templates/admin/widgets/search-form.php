<div class="row">
    <?php if (true){ ?>
    <div class="col-md-6" style="min-height: 700px; padding: 10px 10px 10px 40px;">
        <?php
        echo bentral_setting_input('Search tags filter', 'bentral_widget_search_tags');

        ?>
    </div>
    <?php } ?>
    <div class="col-md-6" style="min-height: 700px; padding: 10px 10px 10px 40px;">
        <?php
        $allowedTagsHtml = null;
        $allowedTags = get_option('bentral_widget_search_tags');
        if (!empty($allowedTags)){
            $allowedTagsHtml = ' allowed-tags="'.$allowedTags.'"';
        }
        echo bentral_shortcode('search-form', 'widget', null, '100%', $allowedTagsHtml, 'padding:200px 0');
        ?>
    </div>
</div>

