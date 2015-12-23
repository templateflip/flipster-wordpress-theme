(function($) {

$(document).ready(function() {

	/* Apply owl carousel to 1-column gallery */
	$('.gallery-columns-1').owlCarousel({
        loop: true,
        nav: true,
        autoWidth: false,
        center: false,
        fluidSpeed: 100,
        margin: 0,
        items: 1,
        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
    });

     $(".meta-media").fitVids();

    /* Responsive navigation */
    $('.smr-hamburger').click(function(event){
        event.stopPropagation();
        $('#wrap').addClass('behind');
        $('.mobile-nav').addClass('active');
    });
    $('.mobile-nav a.close-btn').click(function(event){
        $('#wrap').removeClass('behind');
        $('.mobile-nav').removeClass('active');
        event.preventDefault();
    });
    /* Add span element to responsive navigation parent elements */
    $('.smr-res-nav > li').each(function() {
        if ($(this).hasClass('menu-item-has-children')) {
            $(this).append('<span class="smr-menu-parent fa fa-angle-down"></span>')
        }
    });
    $('.smr-res-nav li').each(function() {
        if ($(this).hasClass('page_item_has_children')) {
            $(this).append('<span class="smr-menu-parent fa fa-angle-down"></span>')
        }
    });

    var allPanels = $('.smr-res-nav .menu-item-has-children > .sub-menu').hide();
    var allPanels = $('.smr-res-nav .page_item_has_children > .children').hide();

    $('.smr-menu-parent').on('click', function(e) {
        $(this).toggleClass('fa-angle-up fa-angle-down');
        $(this).parent().find('.sub-menu, .children').slideToggle();
        $(this).parent().toggleClass('smr-menu-parent-activate');
    });


	/* Open image format in pop-up */
    $('.smr-image-format').magnificPopup({
                type: 'image'
    });

    /* Open galleries in pop-up */
    $('.gallery').each(function() {
            $(this).find('.gallery-icon a.smr-popup').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },

                image: {
                    titleSrc: function(item) {
                        var $caption = item.el.closest('.gallery-item').find('.gallery-caption');
                        if ($caption != 'undefined') {
                            return $caption.text();
                        }
                        return '';
                    }
                }
            });
        });



});

})(jQuery);