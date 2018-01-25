/*
    Dimension by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function ($) {

    skel.breakpoints({
        xlarge: '(max-width: 1680px)',
        large: '(max-width: 1280px)',
        medium: '(max-width: 980px)',
        small: '(max-width: 736px)',
        xsmall: '(max-width: 480px)',
        xxsmall: '(max-width: 360px)'
    });

    $(function () {

        //判断网站语言
        var lang;
        // console.log(window.location.pathname);
        if (window.location.pathname == '/' || window.location.pathname == '/index.html') {
            lang = 'cn';
        } else if (window.location.pathname == '/index-en.html') {
            lang = 'en';

        }

        // if (window.location.pathname == '/preview/index.html') {
        //     lang = 'cn';
        // } else if (window.location.pathname == '/preview/index-en.html') {
        //     lang = 'en';
        //
        // }

        /*
         * 支付相关
         */

        /*
         * 卖完票后不出现填信息的表单
         */
        var getTicketInfo = new XMLHttpRequest();
        getTicketInfo.open('get', 'https://api.baoming.in/omise/ticket/findNumber');
        getTicketInfo.send();
        getTicketInfo.onload = function () {
            var json = JSON.parse(this.response);
            var ticketNum = json.ticketNumber;
            if (ticketNum == 0) {
                $("#checkout-form,.payInfo").remove();
                $('.payAllInfo').css('display', 'block')
            }

        };

        /*
         * 提交买票者信息
         */

        $('.gopay').click(function (event) {

            event.preventDefault();

            var purchaserName = $('#name').val();
            var purchaserCountry = $('#country').val();
            var purchaserCompany = $('#company').val();
            var purchaserPosition = $('#position').val();
            var purchaserPhone = $('#telephone').val();
            var purchaserEmail = $('#email').val();
            var purchaserNote = $('#note').val();

            if (purchaserName == '' || purchaserCountry == '' || purchaserCompany == '' || purchaserPosition == '' || purchaserPhone == '' || purchaserEmail == '') {
                if (lang == 'cn') {
                    alert('请完成信息填写后再进行支付')

                } else {
                    alert('Please complete your information and try again later, all of the information are necessary!')

                }
            } else {

                $.ajax({
                    type: "post",
                    url: "https://api.baoming.in/omise/charges/accountInfo",
                    data: {
                        name: purchaserName,
                        country: purchaserCountry,
                        company: purchaserCompany,
                        position: purchaserPosition,
                        telephone: purchaserPhone,
                        email: purchaserEmail,
                        note: purchaserNote,
                        lang: lang

                    },
                    timeout: 5000, //超时时间
                    dataType: 'json', //返回的数据格式：json/xml/html/script/jsonp/text
                    success: function (data) {

                        $("#name").val("");
                        $("#country").val("");
                        $("#company").val("");
                        $("#position").val("");
                        $("#mobile").val("");
                        $("#email").val("");
                        $("#note").val("");
                        var para = data.para;
                        lang = data.lang;
                        // console.log(lang)

                        if (lang == 'cn') {
                            top.location = 'buy-cn.html?para=' + para + '&lang=' + lang;

                        } else {
                            top.location = 'buy.html?para=' + para + '&lang=' + lang;

                        }

                    },
                    error: function (xhr, textStatus) {
                        // console.log(xhr)
                        // console.log(textStatus)

                        if (lang == 'cn') {
                            alert('信息提交失败，请检查您的网络。')

                        } else {
                            alert("Failed! Please check your internet and try again later!");

                        }
                    }
                })

            }


        });


        //打开网站2sloading
        function hideLoading() {
            var t = setTimeout("$('.loading,.loading-mask').fadeOut();", 2000)
        }

        hideLoading();


        var $window = $(window),
            $body = $('body'),
            $wrapper = $('#wrapper'),
            $header = $('#header'),
            $footer = $('#footer'),
            $main = $('#main'),
            $main_articles = $main.children('article');

        /*
         * 页面加载完成前一直loading
         */

        function browserSupportsCSSProperty(propertyName) {
            var elm = document.createElement('div');
            propertyName = propertyName.toLowerCase();

            if (elm.style[propertyName] != undefined)
                return true;

            var propertyNameCapital = propertyName.charAt(0).toUpperCase() + propertyName.substr(1),
                domPrefixes = 'Webkit Moz ms O'.split(' ');

            for (var i = 0; i < domPrefixes.length; i++) {
                if (elm.style[domPrefixes[i] + propertyNameCapital] != undefined)
                    return true;
            }

            return false;
        }

        if (!browserSupportsCSSProperty('animation')) {
            // fallback…
            $('.loading,.loading-mask').fadeOut();
        }


        //页面加载完成
        // $(window).on('load',function(){
        //     $('.loading,.loading-mask').fadeOut();
        //
        // });

        // Fix: Placeholder polyfill.
        // $('form').placeholder();

        // Fix: Flexbox min-height bug on IE.
        if (skel.vars.IEVersion < 12) {

            var flexboxFixTimeoutId;

            $window.on('resize.flexbox-fix', function () {

                clearTimeout(flexboxFixTimeoutId);

                flexboxFixTimeoutId = setTimeout(function () {

                    if ($wrapper.prop('scrollHeight') > $window.height())
                        $wrapper.css('height', 'auto');
                    else
                        $wrapper.css('height', '100vh');

                }, 250);

            }).triggerHandler('resize.flexbox-fix');

        }

        // Nav.
        var $nav = $header.children('nav'),
            $nav_li = $nav.find('li');

        // Add "middle" alignment classes if we're dealing with an even number of items.
        if ($nav_li.length % 2 == 0) {

            $nav.addClass('use-middle');
            $nav_li.eq(($nav_li.length / 2)).addClass('is-middle');

        }

        // Main.
        var delay = 325,
            locked = false;

        // Methods.
        $main._show = function (id, initial) {

            var $article = $main_articles.filter('#' + id);

            // No such article? Bail.
            if ($article.length == 0)
                return;

            // Handle lock.

            // Already locked? Speed through "show" steps w/o delays.
            if (locked || (typeof initial != 'undefined' && initial === true)) {

                // Mark as switching.
                $body.addClass('is-switching');

                // Mark as visible.
                $body.addClass('is-article-visible');

                // Deactivate all articles (just in case one's already active).
                $main_articles.removeClass('active');

                // Hide header, footer.
                $header.hide();
                $footer.hide();

                // Show main, article.
                $main.show();
                $article.show();

                // Activate article.
                $article.addClass('active');

                // Unlock.
                locked = false;

                // Unmark as switching.
                setTimeout(function () {
                    $body.removeClass('is-switching');
                }, (initial ? 1000 : 0));

                return;

            }

            // Lock.
            locked = true;

            // Article already visible? Just swap articles.
            if ($body.hasClass('is-article-visible')) {

                // Deactivate current article.
                var $currentArticle = $main_articles.filter('.active');

                $currentArticle.removeClass('active');

                // Show article.
                setTimeout(function () {

                    // Hide current article.
                    $currentArticle.hide();

                    // Show article.
                    $article.show();

                    // Activate article.
                    setTimeout(function () {

                        $article.addClass('active');

                        // Window stuff.
                        $window
                            .scrollTop(0)
                            .triggerHandler('resize.flexbox-fix');

                        // Unlock.
                        setTimeout(function () {
                            locked = false;
                        }, delay);

                    }, 25);

                }, delay);

            }

            // Otherwise, handle as normal.
            else {

                // Mark as visible.
                $body
                    .addClass('is-article-visible');

                // Show article.
                setTimeout(function () {

                    // Hide header, footer.
                    $header.hide();
                    $footer.hide();

                    // Show main, article.
                    $main.show();
                    $article.show();

                    // Activate article.
                    setTimeout(function () {

                        $article.addClass('active');

                        // Window stuff.
                        $window
                            .scrollTop(0)
                            .triggerHandler('resize.flexbox-fix');

                        // Unlock.
                        setTimeout(function () {
                            locked = false;
                        }, delay);

                    }, 25);

                }, delay);

            }

        };

        $main._hide = function (addState) {

            var $article = $main_articles.filter('.active');

            // Article not visible? Bail.
            if (!$body.hasClass('is-article-visible'))
                return;

            // Add state?
            if (typeof addState != 'undefined' &&
                addState === true)
                history.pushState(null, null, '#');

            // Handle lock.

            // Already locked? Speed through "hide" steps w/o delays.
            if (locked) {

                // Mark as switching.
                $body.addClass('is-switching');

                // Deactivate article.
                $article.removeClass('active');

                // Hide article, main.
                $article.hide();
                $main.hide();

                // Show footer, header.
                $footer.show();
                $header.show();

                // Unmark as visible.
                $body.removeClass('is-article-visible');

                // Unlock.
                locked = false;

                // Unmark as switching.
                $body.removeClass('is-switching');

                // Window stuff.
                $window
                    .scrollTop(0)
                    .triggerHandler('resize.flexbox-fix');

                return;

            }

            // Lock.
            locked = true;

            // Deactivate article.
            $article.removeClass('active');

            // Hide article.
            setTimeout(function () {

                // Hide article, main.
                $article.hide();
                $main.hide();

                // Show footer, header.
                $footer.show();
                $header.show();

                // Unmark as visible.
                setTimeout(function () {

                    $body.removeClass('is-article-visible');

                    // Window stuff.
                    $window
                        .scrollTop(0)
                        .triggerHandler('resize.flexbox-fix');

                    // Unlock.
                    setTimeout(function () {
                        locked = false;
                    }, delay);

                }, 25);

            }, delay);


        };

        // Articles.
        $main_articles.each(function () {

            var $this = $(this);

            // Close.
            $('<div class="close">Close</div>')
                .appendTo($this)
                .on('click', function () {
                    location.hash = '';
                });

            // Prevent clicks from inside article from bubbling.
            $this.on('click', function (event) {
                event.stopPropagation();
            });

        });

        // Events.
        $body.on('click', function (event) {

            // Article visible? Hide.
            if ($body.hasClass('is-article-visible'))
                $main._hide(true);

        });

        $window.on('keyup', function (event) {

            switch (event.keyCode) {

                case 27:

                    // Article visible? Hide.
                    if ($body.hasClass('is-article-visible'))
                        $main._hide(true);

                    break;

                default:
                    break;

            }

        });

        $window.on('hashchange', function (event) {

            // Empty hash?
            if (location.hash == '' ||
                location.hash == '#') {

                // Prevent default.
                event.preventDefault();
                event.stopPropagation();

                // Hide.
                $main._hide();

            }

            // Otherwise, check for a matching article.
            else if ($main_articles.filter(location.hash).length > 0) {

                // Prevent default.
                event.preventDefault();
                event.stopPropagation();

                // Show article.
                $main._show(location.hash.substr(1));

            }

        });

        // Scroll restoration.
        // This prevents the page from scrolling back to the top on a hashchange.
        if ('scrollRestoration' in history)
            history.scrollRestoration = 'manual';
        else {

            var oldScrollPos = 0,
                scrollPos = 0,
                $htmlbody = $('html,body');

            $window
                .on('scroll', function () {

                    oldScrollPos = scrollPos;
                    scrollPos = $htmlbody.scrollTop();

                })
                .on('hashchange', function () {
                    $window.scrollTop(oldScrollPos);
                });

        }

        // Initialize.

        // Hide main, articles.
        $main.hide();
        $main_articles.hide();

        // Initial article.
        if (location.hash != '' &&
            location.hash != '#')
            $window.on('load', function () {
                $main._show(location.hash.substr(1), true);
            });

    });

})(jQuery);