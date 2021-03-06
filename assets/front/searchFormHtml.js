(function ($) {

    let isSearchInProgress = false;
    let searchForm = $('.bentral-book-form ');
    let option = {
        language: $(searchForm).data('lang'),
        searchTags: $(searchForm).data('search-tags'),
        initType: $('.bentral-book-form').data('init-type'),
        resultOffset: parseInt($(searchForm).data('results-offset')),
        daysBetweenDates: parseInt($(searchForm).data('days-between-dates')),
        autoOpen: {
            dateFrom: parseInt($(searchForm).data('auto-open-from-date')),
            dateTo: parseInt($(searchForm).data('auto-open-to-date'))
        },
        formInputs: {
            dateFrom: '[name="bentral_date_from"]',
            dateTo: '[name="bentral_date_to"]',
            guest: '[name="bentral_persons"]'
        }
    };

    Number.prototype.pad = function (n) {
        if (n == undefined)
            n = 2;

        return (new Array(n).join('0') + this).slice(-n);
    }

    function init() {
        $('.bentral-search-form').on('submit', function () {
            ev.preventDefault();
        });

        $('body').on('click', '.bentral-big-number.day.from, .bentral-date-month.from', function () {
            $(this).closest('.bentral-book-form').find(option.formInputs.dateFrom).datepicker("show");
        });

        $('body').on('click', '.bentral-big-number.day.to, .bentral-date-month.to', function () {
            $(this).closest('.bentral-book-form').find(option.formInputs.dateTo).datepicker("show");
        });

        $('body').on('click', '.bentral-guest-up', function () {
            let $guestElement = $(this).closest('.bentral-book-form').find('.bentral-guests-number');
            let number = parseInt($guestElement.data('value'));
            let max_number = parseInt($guestElement.data('max'));
            if ((number + 1) <= max_number) {
                number++;
                $guestElement.data('value', number).text(number);
                $(this).closest('.bentral-book-form').find(option.formInputs.guest).val(number);
            }
        });
        $('body').on('click', '.bentral-guest-down', function () {
            let $guestElement = $(this).closest('.bentral-book-form').find('.bentral-guests-number');
            let number = parseInt($guestElement.data('value'));
            if ((number - 1) > 0) {
                number--;
                $guestElement.data('value', number).text(number);
                $(this).closest('.bentral-book-form').find(option.formInputs.guest).val(number);
            }
        });
        $('body').on('click', '.bentral-book-form .bentral-search', function () {
            if (isSearchInProgress)
                return;

            isSearchInProgress = true;
            $('.bentral-search-loader').show();
            $('.bentral-search-results ').html('');

            let searchFormSelected = $(this).closest('.bentral-book-form');
            let searchDateFrom = $(searchFormSelected).find(option.formInputs.dateFrom).val();
            let searchDateTo = $(searchFormSelected).find(option.formInputs.dateTo).val();
            let searchGuests = $(searchFormSelected).find(option.formInputs.guest).val();

            $.ajax({
                url: '/wp-json/bentral/v2/search',
                type: 'POST',
                data: {
                    'lang': option.language,
                    'persons': searchGuests,
                    'from': searchDateFrom,
                    'to': searchDateTo,
                    'tags': option.searchTags
                },
                success: function (response) {
                    debugger;
                    $('.bentral-search-loader').hide();
                    $('.bentral-search-results ').html(response.result);
                },
                complete: function () {
                    $('.bentral-search-loader').hide();
                    isSearchInProgress = false;
                    goToResults();
                }
            });
        });

        $(option.formInputs.dateFrom).datepicker({
            minDate: "+0d",
            firstDay: 0,
            dateFormat: "yy-mm-dd",
            changeMonth: false,
            showAnim: "slideDown",
            onClose: function () {
                // DATE FROM
                let fromDate = $(this).datepicker("getDate");
                let day = fromDate.getDate();
                let month = fromDate.getMonth() + 1;
                $('.bentral-big-number.day.from').text(day.pad(2));
                $('.bentral-date-month.from').text(bentral_lang.month['mon' + month]);

                // DATE TO
                var newMin = new Date(fromDate.setDate(fromDate.getDate() + 1));
                let minDay = newMin.getDate();
                let minMonth = newMin.getMonth() + 1;
                $('.bentral-big-number.day.to').text(minDay.pad(2));
                $('.bentral-date-month.to').text(bentral_lang.month['mon' + minMonth]);
                $(option.formInputs.dateTo).datepicker("option", "minDate", newMin);
                $(option.formInputs.dateTo).datepicker("setDate", newMin);

                if (option.autoOpen.dateTo == 1) {
                    $(option.formInputs.dateTo).datepicker("show");
                }
            }
        });

        $(option.formInputs.dateTo).datepicker(
            {
                minDate: "+1d",
                firstDay: 0,
                dateFormat: "yy-mm-dd",
                changeMonth: false,
                showAnim: "slideDown",
                onClose: function () {
                    let toDate = $(this).datepicker("getDate");
                    let day = toDate.getDate();
                    let month = toDate.getMonth() + 1;

                    $('.bentral-big-number.day.to').text(day.pad(2));
                    $('.bentral-date-month.to').text(bentral_lang.month['mon' + month]);
                }
            }
        );

        if (option.autoOpen.dateFrom == 1) {
            $('.bentral-book-form').find('[name="bentral_date_from"]').datepicker("show");
        }
    }

    function goToResults() {
        if ($('.bentral-search-results').length > 0) {
            $('html,body').animate({scrollTop: $('.bentral-search-results').offset().top + option.resultOffset}, 'slow');
        }
    }

    if (option.initType == "onPageLoad") {
        init();
    }

    $(function () {
        if (option.initType == "onDocumentReady") {
            init();
        }
    });

})(jQuery);