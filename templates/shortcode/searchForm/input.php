<div class="bentral-book-form input" <?=implode(' ',$formDataAttr)?>>
    <form class="bentral-search-form" method="get">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 p-2 md:p-0">
                <div class="bentral-input-box bentral-from justify-center p-2 lg:p-8 lg:pb-4 lg:pr-1">
                    <h6 class="bentral-date-title box-title w-full mb-4"><?= V($lang, 'check_in'); ?></h6>
                    <div class="bentral-date box-border w-full inline-flex cursor-pointer">
                        <input class="bentral-input border border-gray-400" name="bentral_date_from" value="<?= V($date, 'date_from'); ?>" data-date="<?= V($date, 'date_from'); ?>">
                    </div>
                </div>
                <div class="bentral-input-box bentral-to justify-center p-2 lg:p-8 lg:pb-4 lg:pl-1 lg:pr-1 ">
                    <h6 class="bentral-date-title box-title w-full mb-4"><?= V($lang, 'check_out'); ?></h6>
                    <div class="bentral-date box-border w-full inline-flex  cursor-pointer">
                        <input class="bentral-input border border-gray-400" name="bentral_date_to" value="<?= V($date, 'date_to'); ?>" data-date="<?= V($date, 'date_to'); ?>">
                    </div>
                </div>
                <div class="bentral-input-box bentral-people justify-center p-2 lg:p-8 lg:pb-4 lg:pl-1 ">
                    <h6 class="bentral-guests-title box-title w-full mb-4"><?= V($lang, 'guests', 'Guests'); ?></h6>
                    <div class="bentral-guest box-border w-full inline-flex">
                        <select class="bentral-input border border-gray-400" name="bentral_persons">
                            <?php
                            for ($x = 1; $x <= $max_guests_count; $x++) {
                                if ($x == 1) {
                                    echo '<option selected value="' . $x . '">' . $x . '</option>';
                                } else {
                                    echo '<option value="' . $x . '">' . $x . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="bentral-input-box bentral-search justify-center p-2 lg:p-8 lg:pb-4 lg:pl-1 ">
                    <h6 class="bentral-search-title box-title w-full md:mb-4"><?= V($lang, 'search_title'); ?></h6>
                    <div class="bentral-search-btn text-center px-4 border"><?= V($lang, 'search'); ?></div>
                </div>
            </div>
        </div>
    </form>
</div>