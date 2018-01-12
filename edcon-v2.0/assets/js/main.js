/*
 * Change Navbar color while scrolling
 */

$(window).scroll(function () {
    handleTopNavAnimation();
});

$(window).on('load', function () {
    handleTopNavAnimation();
});

function handleTopNavAnimation() {
    var top = $(window).scrollTop();

    if (top > 10) {
        $('#site-nav').addClass('navbar-solid');
    }
    else {
        $('#site-nav').removeClass('navbar-solid');
    }

    // scroll down and show social block on the right side
    var headHeight = $('header').height();
    var windowHeight = $(window).height();
    var docHeight = $(document).height();
    if (top > headHeight) {
        $('.social-block-fix').fadeIn()
    } else {
        $('.social-block-fix').fadeOut()
    }

    // need to hide the social block if u see the footer
    if ($(document).scrollTop() >= docHeight - windowHeight) {
        $('.social-block-fix').fadeOut()
    }

}

/*
 * hide the right side social block if using phone
 */

function loadCSS() {
    if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|wOSBrowser|BrowserNG|WebOS)/i))) {
        $('.social-block-fix').addClass('hide')
    }

}

loadCSS();


/*
 * SmoothScroll
 */
// index
$('.gohome').click(function () {
    $('html,body').animate({scrollTop: $('#site-header').offset().top}, 800);
});

$('.gohightlight').click(function () {
    $('html,body').animate({scrollTop: $('#highlights').offset().top}, 800);
});

$('.gospeaker').click(function () {
    $('html,body').animate({scrollTop: $('#guest').offset().top}, 800);
});

$('.goagenda').click(function () {
    $('html,body').animate({scrollTop: $('#agenda').offset().top}, 800);
});

$('.goregistration').click(function () {
    $('html,body').animate({scrollTop: $('#registration').offset().top}, 800);
});
$('.goguide').click(function () {
    $('html,body').animate({scrollTop: $('#guide').offset().top}, 800);
});
$('.gosupport').click(function () {
    $('html,body').animate({scrollTop: $('#partner').offset().top}, 800);
});

// transportation
$('.govenue').click(function () {
    $('html,body').animate({scrollTop: $('#venue').offset().top}, 800);
});
$('.gottc').click(function () {
    $('html,body').animate({scrollTop: $('#ttc').offset().top}, 800);
});
$('.govehicle').click(function () {
    $('html,body').animate({scrollTop: $('#vehicle').offset().top}, 800);
});


