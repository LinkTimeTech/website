/*
 * Change Navbar color while scrolling
 */

$(window).scroll(function () {
    handleTopNavAnimation();
});

$(window).load(function () {
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
}

/*
 * Registration Form
 */

$('#registration-form').submit(function (e) {
    e.preventDefault();

    var postForm = { //Fetch form data
        'fname': $('#registration-form #fname').val(),
        'lname': $('#registration-form #lname').val(),
        'email': $('#registration-form #email').val(),
        'cell': $('#registration-form #cell').val(),
        'address': $('#registration-form #address').val(),
        'zip': $('#registration-form #zip').val(),
        'city': $('#registration-form #city').val(),
        'program': $('#registration-form #program').val()
    };

    $.ajax({
        type: 'POST',
        url: './assets/php/contact.php',
        data: postForm,
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                $('#registration-msg .alert').html("Registration Successful");
                $('#registration-msg .alert').removeClass("alert-danger");
                $('#registration-msg .alert').addClass("alert-success");
                $('#registration-msg').show();
            }
            else {
                $('#registration-msg .alert').html("Registration Failed");
                $('#registration-msg .alert').removeClass("alert-success");
                $('#registration-msg .alert').addClass("alert-danger");
                $('#registration-msg').show();
            }
        }
    });
});

/*
 * SmoothScroll
 */

var scroll = new SmoothScroll('a[href*="#"]')

/*
 * SmoothScroll
 */

var showweixin = function () {
    $('.weixinlink').click(function () {

        if ($('.weixincode').hasClass('hide')) {
            $('.weixincode').removeClass('hide').addClass('show')
        } else {
            $('.weixincode').removeClass('show').addClass('hide')

        }

    })
}

var agenda = function () {
    $('.nav-tabs a[href="#fday"]').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('.nav-tabs a[href="#sday"]').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('.nav-tabs a[href="#tday"]').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('.nav-tabs a[href="#zday"]').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })


}


showweixin()
agenda()