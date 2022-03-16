(function ($) {

    $("div.bentral-tab-menu>div.list-group>a").click(function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        let index = $(this).index();
        $("div.bentral-tab>div.bentral-tab-content").removeClass("active");
        $("div.bentral-tab>div.bentral-tab-content").eq(index).addClass("active");
        window.location.hash = $(this).data('tab');
    });

    $('[name="bentral_widget_search_enable"]').on('change', function (e) {
        (parseInt(this.value) == 1)
            ? $('.bentral_widget_search_enable').removeClass('hidden')
            : $('.bentral_widget_search_enable').addClass('hidden')
    });

    $('[name="bentral_widget_calendar_enable"]').on('change', function (e) {
        (parseInt(this.value) == 1)
            ? $('.bentral_widget_calendar_enable').removeClass('hidden')
            : $('.bentral_widget_calendar_enable').addClass('hidden')
    });

    $('[name="bentral_widget_price_enable"]').on('change', function (e) {
        (parseInt(this.value) == 1)
            ? $('.bentral_widget_price_enable').removeClass('hidden')
            : $('.bentral_widget_price_enable').addClass('hidden')
    });

    $('[name="bentral_widget_reviews_enable"]').on('change', function (e) {
        (parseInt(this.value) == 1)
            ? $('.bentral_widget_reviews_enable').removeClass('hidden')
            : $('.bentral_widget_reviews_enable').addClass('hidden')
    });

    $(function () {
        let activeTab = (window.location.hash != '') ? window.location.hash : 'reservation';
        activeTab     = activeTab.replace('#', '');

        $('a[data-tab="' + activeTab + '"]').click();
        $(".bentral-color").spectrum({
            type: 'component',
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
        });
    });

})(jQuery);

