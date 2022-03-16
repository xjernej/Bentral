<?php
    $arrowImg = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjkgMTI5IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjkgMTI5IiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgogIDxnPgogICAgPHBhdGggZD0ibTEyMS4zLDM0LjZjLTEuNi0xLjYtNC4yLTEuNi01LjgsMGwtNTEsNTEuMS01MS4xLTUxLjFjLTEuNi0xLjYtNC4yLTEuNi01LjgsMC0xLjYsMS42LTEuNiw0LjIgMCw1LjhsNTMuOSw1My45YzAuOCwwLjggMS44LDEuMiAyLjksMS4yIDEsMCAyLjEtMC40IDIuOS0xLjJsNTMuOS01My45YzEuNy0xLjYgMS43LTQuMiAwLjEtNS44eiIgZmlsbD0iIzg3ODc4NyIvPgogIDwvZz4KPC9zdmc+Cg==';
?>
<div class="bentral-book-form html" <?=implode(' ',$formDataAttr)?>>
    <form class="bentral-search-form" method="get">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                <div class="bentral-input-box bentral-from justify-center p-8">
                    <h6 class="bentral-date-title w-full mb-4"><?= V($lang, 'check_in'); ?></h6>
                    <div class="bentral-date box-border w-full inline-flex cursor-pointer">
                        <div class="m-auto inline-flex">
                            <div class="text-right box-sizing border-box ">
                                <div class="bentral-big-number day from"><?= V($date, 'day_from'); ?></div>
                            </div>
                            <div class="text-center float-right ml-2 section-from">
                                <h6 class="bentral-date-month from mt-2"><?= V($date, 'month_from'); ?></h6>
                                <div class=""></div>
                                <img class="m-auto" width="12" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjkgMTI5IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjkgMTI5IiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgogIDxnPgogICAgPHBhdGggZD0ibTEyMS4zLDM0LjZjLTEuNi0xLjYtNC4yLTEuNi01LjgsMGwtNTEsNTEuMS01MS4xLTUxLjFjLTEuNi0xLjYtNC4yLTEuNi01LjgsMC0xLjYsMS42LTEuNiw0LjIgMCw1LjhsNTMuOSw1My45YzAuOCwwLjggMS44LDEuMiAyLjksMS4yIDEsMCAyLjEtMC40IDIuOS0xLjJsNTMuOS01My45YzEuNy0xLjYgMS43LTQuMiAwLjEtNS44eiIgZmlsbD0iIzg3ODc4NyIvPgogIDwvZz4KPC9zdmc+Cg==">
                            </div>
                        </div>
                    </div>
                    <div style="width: 0; height: 0; overflow: hidden;">
                        <input type="text" name="bentral_date_from" value="<?= V($date, 'date_from'); ?>" data-date="<?= V($date, 'date_from'); ?>">
                    </div>
                </div>
                <div class="bentral-input-box bentral-to justify-center p-8">
                    <h6 class="bentral-date-title w-full mb-4"><?= V($lang, 'check_out'); ?></h6>
                    <div class="bentral-date box-border w-full inline-flex  cursor-pointer">
                        <div class="m-auto inline-flex">
                            <div class="text-right box-sizing border-box ">
                                <div class="bentral-big-number day to"><?= V($date, 'day_to'); ?></div>
                            </div>
                            <div class="text-center float-right ml-2 section-to">
                                <h6 class="bentral-date-month to mt-2"><?= V($date, 'month_to'); ?></h6>
                                <div class=""></div>
                                <img class="m-auto" width="12" src="<?=$arrowImg;?>">
                            </div>
                        </div>
                    </div>
                    <div style="width: 0; height: 0; overflow: hidden;">
                        <input type="text" name="bentral_date_to" value="<?= V($date, 'date_to'); ?>" data-date="<?= V($date, 'date_to'); ?>">
                    </div>
                </div>
                <div class="bentral-input-box bentral-people justify-center p-8">
                    <h6 class="bentral-guests-title w-full mb-4"><?= V($lang, 'guests', 'Guests'); ?></h6>
                    <div class="bentral-date box-border w-full inline-flex">
                        <div class="m-auto inline-flex">
                            <div class="text-right box-sizing border-box ">
                                <div class="bentral-big-number bentral-guests-number" data-value="<?= $selected_guest_count; ?>" data-max="<?= ($max_guests_count); ?>">
                                    <?= $selected_guest_count; ?>
                                </div>
                            </div>
                            <div class="text-center float-right ml-2">
                                <div class="block h-1"></div>
                                <div class="block h-3">
                                    <img class="bentral-guest-up float-right cursor-pointer" style="transform: rotate(180deg);" alt="" width="12" src="<?=$arrowImg?>">
                                </div>
                                <div class="block h-3"></div>
                                <div class="block h-3">
                                    <img class="bentral-guest-down float-right cursor-pointer" alt="" width="12" src="<?=$arrowImg;?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 0; height: 0; overflow: hidden;">
                        <input type="text" name="bentral_persons" value="<?= $selected_guest_count; ?>">
                    </div>
                </div>
                <div class="bentral-input-box bentral-search block p-6 p-4 transition-colors"><?= V($lang, 'search'); ?></div>
            </div>
        </div>
    </form>
</div>