<div class="row">
    <div class="col-md-6" style="min-height: 700px; padding: 10px 10px 10px 40px;">
        <?php

        echo bentral_setting_number('Number of months', 'bentral_widget_calendar_month_number', 1, 6);
        echo bentral_setting_number('Number of columns', 'bentral_widget_calendar_month_columns', 1, 6);
        echo bentral_setting_checkbox('Allow month change', 'bentral_widget_calendar_month_change');
        echo bentral_setting_checkbox('Show legend', 'bentral_widget_calendar_legend');

        echo bentral_setting_checkbox('Enable custom style', 'bentral_widget_calendar_enable');
        ?>
        <div class="bentral_widget_calendar_enable <?= (intval(get_option('bentral_widget_calendar_enable') ? : '0')) ? '' : 'hidden'; ?>">
            <?= bentral_setting_section('Head 1'); ?>
            <?= bentral_setting_color('Backgound', 'bentral_widget_calendar_head_1_bg'); ?>
            <?= bentral_setting_color('Font color', 'bentral_widget_calendar_head_1_font'); ?>

            <?= bentral_setting_section('Head 2'); ?>
            <?= bentral_setting_color('Backgound', 'bentral_widget_calendar_head_2_bg'); ?>
            <?= bentral_setting_color('Font color', 'bentral_widget_calendar_head_2_font'); ?>

            <?= bentral_setting_section('Table'); ?>
            <?= bentral_setting_color('Backgound', 'bentral_widget_calendar_table_bg'); ?>
            <?= bentral_setting_color('Font color', 'bentral_widget_calendar_table_font'); ?>

            <?= bentral_setting_section('Border'); ?>
            <?= bentral_setting_checkbox('Show border', 'bentral_widget_calendar_border_enable'); ?>
            <?= bentral_setting_color('Border color', 'bentral_widget_calendar_border_color'); ?>
        </div>
    </div>
    <div class="col-md-6" style="min-height: 700px;padding: 10px; border-left: 1px solid #ddd;">
        <?= bentral_shortcode('calendar'); ?>
    </div>
</div>



