<div class="row template-result">
    <div class="col-md-8 content" style="width: 100%">
        <textarea style="width: 100%;" name="bentral_search_result_template" id="bentral_result_template" rows="30"><?php
            echo wp_unslash(get_option('bentral_search_result_template') ?: trim(Bentral_Admin_Templates::defaultResultsTemplate())) ?></textarea>
        <div class="root_result_template hidden">
            <?php _e('Root result template [only for advance users]', 'bentral'); ?>
            <textarea style="width: 100%;" name="bentral_search_root_result_template" id="bentral_search_root_result_template"><?php
                echo wp_unslash(get_option('bentral_search_root_result_template') ?: trim(Bentral_Admin_Templates::defaultResultsRootTemplate())) ?></textarea>
        </div>
    </div>
    <div class="col-md-4 info" style="display: none;">
        <?php if (!empty($tokens = \Bentral\Wordpress\Token::availableResultTokens())): ?>
        <span class="description">
            <ul>
                <?php foreach ($tokens as $token => $description): ?>
                    <li class="xLi"><span class="xVar"><?php echo $token; ?></span> - <?php echo $description ?></li>
                <?php endforeach; ?>
            </ul>
        </span>
        <?php endif; ?>
    </div>
</div>