(function ($) {

    let isSearchInProgress = false;
    let searchForm = $('.bentral-book-form ');
    let option = {
        language: $(searchForm).data('lang'),
        searchTags: $(searchForm).data('search-tags'),
        initType: $('.bentral-book-form').data('init-type'),
        resultOffset: parseInt($(searchForm).data('results-offset')),
        daysBetweenDates: parseInt($(searchForm).data('days-between-dates')),
        daysFromToday: parseInt($(searchForm).data('days-from-today')),
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

    function init() {
        $('.bentral-search-form').on('submit', function () {
            ev.preventDefault();
        });

        let input_search = '.bentral-search-btn';
        let sel_date_fromToday = new Date().fp_incr(0);
        let sel_date_from = new Date().fp_incr(option.daysFromToday);
        let sel_date_to = new Date().fp_incr(option.daysBetweenDates + 1);

        function dataDateFormat(selectedDate) {
            selectedDate = new Date(selectedDate);
            return selectedDate.getFullYear() + '-' + ('0' + (selectedDate.getMonth() + 1)).slice(-2) + '-' + ('0' + selectedDate.getDate()).slice(-2);
        }

        let date_to = $(option.formInputs.dateTo).flatpickr({
            mode: 'single',
            dateFormat: bentral_lang.date_format.dropdown,
            minDate: sel_date_from,
            defaultDate: sel_date_to,
            onChange: function (selectedDates) {
                if (selectedDates.length > 0) {
                    sel_date_to = new Date(selectedDates[0]);
                    $(option.formInputs.dateTo).data('date', dataDateFormat(sel_date_to));
                }
            }
        });

        let date_from = $(option.formInputs.dateFrom).flatpickr({
            mode: 'single',
            dateFormat: bentral_lang.date_format.dropdown,
            minDate: sel_date_fromToday,
            defaultDate: sel_date_from,
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    sel_date_from = new Date(selectedDates[0]);
                    $(option.formInputs.dateFrom).data('date', dataDateFormat(sel_date_from));
                    date_to.set('minDate', dateStr);
                    if (sel_date_from >= sel_date_to) {
                        sel_date_to = new Date(sel_date_from);
                        sel_date_to = sel_date_to.fp_incr(option.daysBetweenDates);
                        $(option.formInputs.dateTo).data('date', dataDateFormat(sel_date_to));
                        date_to.setDate(sel_date_to);
                    }
                }
                if (option.autoOpen.dateTo == 1) {
                    date_to.open();
                }
            }
        });

        if (option.autoOpen.dateFrom == 1) {
            date_from.open();
        }

        function goToResults() {
            if ($('.bentral-search-results').length > 0) {
                $('html,body').animate({scrollTop: $('.bentral-search-results').offset().top + option.resultOffset}, 'slow');
            }
        }

        function booking_search(element) {
            if (isSearchInProgress)
                return;

            isSearchInProgress = true;
            $('.bentral-search-loader').show();
            $('.bentral-search-results ').html('');

            let searchForm = $(element).closest('.bentral-search-form');
            let searchDateFrom = $(searchForm).find(option.formInputs.dateFrom).data('date');
            let searchDateTo = $(searchForm).find(option.formInputs.dateTo).data('date');
            let searchGuests = $(searchForm).find(option.formInputs.guest).val();

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
        }

        $(input_search).on('click', function () {
            booking_search(this);
        });

        $('.bentral_search_form').on('submit', function (ev) {
            ev.preventDefault();
            booking_search(this);
        });
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