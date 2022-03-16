<table class="form-table" role="presentation">
    <tbody>
    <tr>
        <th scope="row">
            <label><?php _e('Service display style', 'bentral'); ?></label>
        </th>
        <td>
            <select id="bentral_service_style" name="bentral_service_style" class="form-control">
                <?php $service_style = get_option('bentral_service_style') ?: 'card'; ?>
                <option value="card" <?php if ($service_style === 'card') {
                    echo 'selected';
                } ?>>Card
                </option>
                <option value="table" <?php if ($service_style === 'table') {
                    echo 'selected';
                } ?>>Table
                </option>
            </select>
        </td>
    </tr>
    </tbody>
</table>
<?php if (false) {?>
<div class="row template-service">
    <div class="col-md-8 content" style="width: 100%">

        <textarea id="bentral_service_template" name="bentral_service_template"><?=wp_unslash(get_option('bentral_card_template') ?: trim(Bentral_Admin_Templates::defaultCardTemplate())) ?></textarea>
    </div>
    <div class="col-md-4 info" style="display: none;">
        <?php if (!empty($tokens = \Bentral\Wordpress\Token::availableServiceTokensCard())) { ?>
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

<?php } ?>