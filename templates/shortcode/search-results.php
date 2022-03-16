<style><?php echo wp_unslash(get_option('bentral_result_style')); ?></style>
<div class="bentral-search-loader" style="display: none;">
    <div class="bentral-animation">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<?php
echo wp_unslash(get_option('bentral_search_root_result_template') ?: trim(Bentral_Admin_Templates::defaultResultsRootTemplate()));
