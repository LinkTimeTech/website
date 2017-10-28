(function () {

    'use strict';

    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };


    var mobileMenuOutsideClick = function () {

        $(document).click(function (e) {
            var container = $("#gtco-offcanvas, .js-gtco-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {

                if ($('body').hasClass('offcanvas')) {

                    $('body').removeClass('offcanvas');
                    $('.js-gtco-nav-toggle').removeClass('active');

                }


            }
        });

    };


    /* var scrollNavBar = function () {

        $(window).scroll(function () {
            if ($(window).scrollTop() > 50) {//下拉

                $('body').addClass('scrolled');
                $('.gtco-nav-toggle').removeClass('gtco-nav-white');

                if ($('.logoimg-article').length > 0) {
                    $('.logoimg-article')[0].src = 'images/logo_black.svg';

                } else {
                    $('.logoimg')[0].src = 'images/logo_black.svg';
                    $('.search-nav-icon')[1].src = 'images/search.svg';
                }

                $('.u-share').length > 0 ? $('.u-share').addClass('show') : '';


            } else {//到顶部

                $('body').removeClass('scrolled');

                if ($('.logoimg-article').length > 0) {
                    $('.logoimg-article')[0].src = 'images/logo_black.svg';
                    $('.gtco-nav-toggle').removeClass('gtco-nav-white');

                } else {
                    $('.logoimg')[0].src = 'images/logo_white.svg';
                    $('.gtco-nav-toggle').addClass('gtco-nav-white');
                    $('.search-nav-icon')[1].src = 'images/search_white.svg';

                }

                $('.u-share').length > 0 ? $('.u-share').removeClass('show') : '';

            }
        });


    }; */


    var scrollNavBar = function () {
        if ($('title')[0].innerText == 'UNITIMES' || $('title')[0].innerText == 'ABOUT' || $('title')[0].innerText == '关于') {
            $(window).scroll(function () {
                if ($(window).scrollTop() > 50) {
                    $('.logoimg')[0].src = 'images/icon/logo_black.svg'

                    $('.metabar')
                    // .removeClass('bluenav')
                        .addClass('u-textColorDarker u-backgroundTransparentWhiteDarkest u-boxShadowBottomThinLighter')

                    // $('.metabar-navItem').addClass('u-textColorNormal').removeClass('u-textColorWhite')
                    $('.metabar-navItem').addClass('u-textColorNormal').removeClass('u-textColorBlue')

                    $('.is-inSiteNavBar, .navlistborder').addClass('button--dark button--primary').removeClass('u-textColorBlue u-borderBlue')

                    // $('.navlist').addClass('metabar-block--below').removeClass('u-boxShadowWh')

                } else {//到顶部
                    $('.logoimg')[0].src = 'images/icon/logo_color.svg'

                    $('.metabar')
                    // .addClass('bluenav')
                        .removeClass('u-textColorDarker u-backgroundTransparentWhiteDarkest u-boxShadowBottomThinLighter')

                    // $('.metabar-navItem, .navlistborder').removeClass('u-textColorNormal').addClass('u-textColorWhite')
                    $('.metabar-navItem, .navlistborder').removeClass('u-textColorNormal').addClass('u-textColorBlue')

                    $('.is-inSiteNavBar').removeClass('button--dark button--primary').addClass('u-textColorBlue u-borderBlue')

                    // $('.navlist').removeClass('metabar-block--below').addClass('u-boxShadowWh')

                }
            })

        }
    };

    var showSearch = function () {
        $('.search-btn').click(function () {
            if ($('.s').hasClass('show')) {

                $('.s').removeClass('show');

                $('.index-nav').length > 0 ? $('.index-nav')[0].style = 'height: 80px' : '';
                $('.intro-nav').length > 0 ? $('.intro-nav')[0].style = 'height: 130px' : '';
                $('.article-nav').length > 0 ? $('.article-nav')[0].style = 'height: 80px' : '';

            } else {
                $('.s').addClass('show');//显示搜索框

                $('.index-nav').length > 0 ? $('.index-nav')[0].style = 'height: 130px' : '';
                $('.intro-nav').length > 0 ? $('.intro-nav')[0].style = 'height: 170px' : '';
                $('.article-nav').length > 0 ? $('.article-nav')[0].style = 'height: 130px' : '';

            }
        })
    };


    var offcanvasMenu = function () {

        $('#page').prepend('<div id="gtco-offcanvas" />');
        $('#page').prepend('<a href="#" class="js-gtco-nav-toggle gtco-nav-toggle gtco-nav-white"><i></i></a>');
        var clone1 = $('.menu-1 > ul').clone();
        $('#gtco-offcanvas').append(clone1);
        var clone2 = $('.menu-2 > ul').clone();
        $('#gtco-offcanvas').append(clone2);

        $('#gtco-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
        $('#gtco-offcanvas')
            .find('li')
            .removeClass('has-dropdown');

        // Hover dropdown menu on mobile
        $('.offcanvas-has-dropdown').mouseenter(function () {
            var $this = $(this);

            $this
                .addClass('active')
                .find('ul')
                .slideDown(500, 'easeOutExpo');
        }).mouseleave(function () {

            var $this = $(this);
            $this
                .removeClass('active')
                .find('ul')
                .slideUp(500, 'easeOutExpo');
        });


        $(window).resize(function () {

            if ($('body').hasClass('offcanvas')) {

                $('body').removeClass('offcanvas');
                $('.js-gtco-nav-toggle').removeClass('active');

            }
        });
    };


    var burgerMenu = function () {

        $('body').on('click', '.js-gtco-nav-toggle', function (event) {
            var $this = $(this);


            if ($('body').hasClass('overflow offcanvas')) {
                $('body').removeClass('overflow offcanvas');
            } else {
                $('body').addClass('overflow offcanvas');
            }
            $this.toggleClass('active');
            event.preventDefault();

        });
    };


    var contentWayPoint = function () {
        var i = 0;
        $('.animate-box').waypoint(function (direction) {

            if (direction === 'down' && !$(this.element).hasClass('animated-fast')) {

                i++;

                $(this.element).addClass('item-animate');
                setTimeout(function () {

                    $('body .animate-box.item-animate').each(function (k) {
                        var el = $(this);
                        setTimeout(function () {
                            var effect = el.data('animate-effect');
                            if (effect === 'fadeIn') {
                                el.addClass('fadeIn animated-fast');
                            } else if (effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft animated-fast');
                            } else if (effect === 'fadeInRight') {
                                el.addClass('fadeInRight animated-fast');
                            } else {
                                el.addClass('fadeInUp animated-fast');
                            }

                            el.removeClass('item-animate');
                        }, k * 50, 'easeInOutExpo');
                    });

                }, 100);

            }

        }, {offset: '85%'});
    };


    var dropdown = function () {

        $('.has-dropdown').mouseenter(function () {

            var $this = $(this);
            $this
                .find('.dropdown')
                .css('display', 'block')
                .addClass('animated-fast fadeInUpMenu');

        }).mouseleave(function () {
            var $this = $(this);

            $this
                .find('.dropdown')
                .css('display', 'none')
                .removeClass('animated-fast fadeInUpMenu');
        });

    };


    var goToTop = function () {

        $('.js-gotop').on('click', function (event) {

            event.preventDefault();

            $('html, body').animate({
                scrollTop: $('html').offset().top
            }, 500, 'easeInOutExpo');

            return false;
        });

        $(window).scroll(function () {

            var $win = $(window);
            if ($win.scrollTop() > 200) {
                $('.js-top').addClass('active');
            } else {
                $('.js-top').removeClass('active');
            }

        });

    };


    // Loading page
    var loaderPage = function () {
        $(".gtco-loader").fadeOut("slow");
    };

    $(window).load(function () {
        $('.gtco-loader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    var counter = function () {
        $('.js-counter').countTo({
            formatter: function (value, options) {
                return value.toFixed(options.decimals);
            },
        });
    };

    var counterWayPoint = function () {
        if ($('#gtco-counter').length > 0) {
            $('#gtco-counter').waypoint(function (direction) {

                if (direction === 'down' && !$(this.element).hasClass('animated')) {
                    setTimeout(counter, 400);
                    $(this.element).addClass('animated');
                }
            }, {offset: '90%'});
        }
    };

    var parallax = function () {
        if (!isMobile.any()) {
            $(window).stellar();
        }
    };


    $(function () {
        mobileMenuOutsideClick();
        scrollNavBar();
        // offcanvasMenu();
        burgerMenu();
        contentWayPoint();
        dropdown();
        goToTop();
        // loaderPage();
        counterWayPoint();
        parallax();
        // showSearch();
    });


}());