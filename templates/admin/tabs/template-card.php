<div class="row template-card">
    <div class="col-md-8 content" style="width: 100%">
        <textarea id="bentral_card_template" name="bentral_card_template"><?php
            echo wp_unslash(get_option('bentral_card_template') ?: trim(Bentral_Admin_Templates::defaultCardTemplate())) ?></textarea>
    </div>
    <div class="col-md-4 info" style="display: none;">
        <?php if (!empty($tokens = \Bentral\Wordpress\Token::availableResultTokensCard())) { ?>
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