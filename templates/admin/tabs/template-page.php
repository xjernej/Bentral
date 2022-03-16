<div class="row template-page">
    <div class="col-md-8 content" style="width: 100%">
        <textarea id="bentral_page_template" name="bentral_page_template"><?php echo
            wp_unslash(get_option('bentral_page_template') ?: trim(Bentral_Admin_Templates::defaultPageTemplate())) ?></textarea>
    </div>
    <div class="col-md-4 info" style="display: none;">
        <?php if (!empty($tokens = \Bentral\Wordpress\Token::availablePageTokens())) { ?>
            <span class="description">
                <ul>
                    <?php foreach ($tokens as $token => $description): ?>
                        <li class="xLi"><span class="xVar"><?php echo $token; ?></span> - <?php echo $description ?></li>
                    <?php endforeach; ?>
                </ul>
            </span>
        <?php } ?>
    </div>
</div>