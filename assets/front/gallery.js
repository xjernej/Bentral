(function ($) {
    $(function () {
        let galleryType         = $('.bentral-gallery').data('gallery-type');
        let optionWidth         = $('.bentral-gallery').data('slider-width');
        let optionHeight        = $('.bentral-gallery').data('slider-height');
        let sliderType          = $('.bentral-gallery').data('slider-type');
        let sliderAutoPlay      = $('.bentral-gallery').data('slider-auto-play');
        let sliderDelay         = $('.bentral-gallery').data('slider-delay');
        let sliderFullscreen    = $('.bentral-gallery').data('slider-fullscreen');

        switch (galleryType) {
            case 'slider':
                let options = {
                    template: 'default',
                    image_generation: {
                        lazyLoading: 1,
                        imageWidth: '',
                        imageHeight: '',
                        thumbImageWidth: 96,
                        thumbImageHeight: 72
                    },
                    thumbs: {paddingBottom: 4, thumbWidth: 96, thumbHeight: 72, appendSpan: 1},
                    autoPlay: {enabled: sliderAutoPlay, delay: sliderDelay},
                    fullscreen: {enabled: sliderFullscreen, nativeFS: 1},
                    video: {autoHideBlocks: !0},
                    width: optionWidth,
                    height: optionHeight,
                    autoScaleSliderWidth: 960,
                    autoScaleSliderHeight: 850,
                    imageScaleMode: 'fill',
                    arrowsNavHideOnTouch: 1,
                    globalCaptionInside: 1,
                    keyboardNavEnabled: 1,
                    fadeinLoadedSlide: 1
                }
                if (sliderType == 'gallery') {
                    options.controlNavigation = 'thumbnails';
                }
                if (sliderType == 'gallery_vertical') {
                    options.controlNavigation = 'thumbnails';
                    options.thumbs.orientation = 'vertical';
                }
                if (sliderType == 'visible_nearby') {
                    options.image_generation = {
                        imageWidth: '',
                        imageHeight: '',
                        thumbImageWidth: '',
                        thumbImageHeight: ''
                    };
                    options.thumbs = {thumbWidth: 96, thumbHeight: 72};
                    options.visibleNearby = {
                        enabled: 1,
                        centerArea: 0.7,
                        breakpoint: 400,
                        breakpointCenterArea: 0.9,
                        navigateByCenterClick: 1
                    };
                }
                $('.bentral-gallery').royalSlider(options);

                break;
            default:
                let gallery = new SimpleLightbox('.bentral-gallery .bentral-img', {
                    overlay: true,
                    loop: true,
                    sourceAttr: 'data-full-img'
                });

                $('.bentral-gallery .bentral-img').on('click', function () {
                    var url = $(this).attr('data-full-img');
                    gallery.open($(this));
                });

                let galleryWidth = $('.bentral-gallery').innerWidth();
                let galleryColumns = $('.bentral-gallery').data('columns');
                let columnWidth = (galleryWidth / galleryColumns) - 10;
                let columnHeight = columnWidth * 0.75
                $('.bentral-gallery .bentral-img').css("height", columnHeight + "px");
                break;
        }
    });
})(jQuery);

