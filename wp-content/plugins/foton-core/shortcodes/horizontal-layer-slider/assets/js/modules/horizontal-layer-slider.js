(function ($) {
    'use strict';

    var horizontalLayer = {};
    mkdf.modules.horizontalLayer = horizontalLayer;

    horizontalLayer.mkdfOnDocumentReady = mkdfOnDocumentReady;
    horizontalLayer.mkdfOnWindowResize = mkdfOnWindowResize;

    $(document).ready(mkdfOnDocumentReady);
    $(window).resize(mkdfOnWindowResize);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        horizontalLayerSlider();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {

    }

    /*
     **	Horizontal Layers Slider
     */
    function horizontalLayerSlider() {
        var swipers = $('.swiper-container.mkdf-horizontal-layer-slider');

        if (swipers.length) {
            swipers.each(function () {
                var swiper = $(this);

                var mouseWheelControl = swiper.data('mouse-wheel-control') == 'yes' ? true : false;
                // var allParallaxImages = swiper.find('.mkdf-slide-parallax-image img');

                horizontalLayerSliderHeight(swiper);

                var swiperSlider = horizontalLayerSliderInit(swiper, mouseWheelControl);

                 $(window).resize(function(){
                     swiper.css('height', 'auto');

                     swiperSlider.destroy(false, false);
                     horizontalLayerSliderHeight(swiper);
                     swiperSlider = horizontalLayerSliderInit(swiper, mouseWheelControl);
                 });
            });
        }
    }

    function horizontalLayerSliderHeight(slider) {
        var allParallaxImages = slider.find('.mkdf-slide-parallax-image img');
        var parallaxImageHeight = [];

        allParallaxImages.each(function () {
            var parallaxImage = $(this);

            parallaxImageHeight.push(parallaxImage.outerHeight());
        });

        var parallaxImageMinHeight = Math.min.apply(Math,parallaxImageHeight);

        console.log(parallaxImageMinHeight);
        slider.css('height', parallaxImageMinHeight);
    }

    function horizontalLayerSliderInit(slider, mouseWheelControl) {
        var swiperSlider = new Swiper(slider, {
            loop: true,
            parallax: true,
            speed: 1000,
            mousewheelControl: mouseWheelControl,
            nextButton: '.mkdf-swiper-button-next',
            prevButton: '.mkdf-swiper-button-prev'
        });
        return swiperSlider;
    }

})(jQuery);