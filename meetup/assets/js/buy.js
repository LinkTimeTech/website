$(function () {

    $('.goback').click(function (event) {

        top.location = 'index.html';

    });

    /*
     * url 拿参数
     */
    function GetRequest() {

        //url例子：XXX.aspx?ID=" + ID + "&Name=" + Name；

        var url = location.search; //获取url中"?"符以及其后的字串

        var theRequest = {};

        if (url.indexOf("?") != -1) //url中存在问号，也就说有参数。

        {

            var str = url.substr(1);

            strs = str.split("&");

            for (var i = 0; i < strs.length; i++) {

                theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);

            }

        }

        return theRequest;

    }

    var Request = {}; //获取url中的参数

    Request = GetRequest();

    var para;
    para = Request['para'];

    // console.log(para)

    /*
     * omise
     */

    // 安全码旁边问号点击出现弹窗
    $(".sqinfo").popover({
        trigger: 'click',
        placement: 'right',
        html: true, //开启html 为true的话，data-content里就能放html代码了
        title: '3-digit number on the back of your credit card',
        template: '<div class="popover role="tooltip""><div class="arrow"></div><div class="sc-gqjmRU dwxBLy">3-digit number on the back of your credit card</div>\n' +
        '                                <div class="sc-VigVT qacib"><img src="data:image/png;base64,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" alt=""></div></div>'
    });


    $('.creatToken').click(function (event) {
        event.preventDefault();

        $('.loading,.loading-mask').fadeIn(100);

        /*
        NOTE: Using `data-name` to prevent sending credit card information fields to the backend server via HTTP Post
        (according to the security best practice https://www.omise.co/security-best-practices#never-send-card-data-through-your-servers).
        */
        var cardInformation = {
            name: $(" input[ name='nameOnCard' ] ").val(),
            number: $(" input[ name='cardNumber' ] ").val(),
            expiration_month: $(" input[ name='expiryMonth' ] ").val(),
            expiration_year: $(" input[ name='expiryYear' ] ").val(),
            security_code: $(" input[ name='securityCode' ] ").val()
        };


        $.ajax({
            type: "post",
            url: "https://api.baoming.in/omise/charges/pay",
            data: {
                para: para,
                nameOnCard: cardInformation.name,
                cardNumber: cardInformation.number,
                expiryMonth: cardInformation.expiration_month,
                expiryYear: cardInformation.expiration_year,
                securityCode: cardInformation.security_code

            },
            timeout: 5000, //超时时间
            dataType: 'json', //返回的数据格式：json/xml/html/script/jsonp/text
            success: function (data) {

                console.log(data);
                console.log(data.state);
                var isPay = data.state;

                // 支付成功
                if (isPay === 0) {
                    $('.loading,.loading-mask').fadeOut();
                    alert('Congratulations! You have successfully paid for EDCON, please check your email for E-ticket.')

                    // top.location = 'index.html';

                }

                // 支付失败
                else if (isPay === 1) {
                    $('.loading,.loading-mask').fadeOut();

                    // console.log(json.message)

                    if (data.failMessage == 'failed fraud check') {
                        alert('Payment failed because of too frequent use of the card. To complete the payment, please use another card.');

                    } else if (data.failMessage == 'the security code is invalid') {
                        alert('Payment failed. Please make sure to enter the correct security code, if failed, please confirm the security code with your card issuing company.');

                    } else if (data.failMessage == 'payment rejected') {
                        alert('Payment failed. Please contact your card issuing company and describe the problem (when and where and what did you buy). The card issuer will solve this problem according to your description, and please try again several days later.');
                    }

                    // top.location = 'index.html';


                }
                //失败
                else {
                    $('.loading,.loading-mask').fadeOut();

                    alert('Failed! Please check your internet and try again later!');

                    // top.location = 'index.html';

                }

            },
            error: function (xhr, textStatus) {
                // console.log(xhr)
                // console.log(textStatus)

                $('.loading,.loading-mask').fadeOut();

                alert('Failed! Please check your internet and try again later!');
                // top.location = 'index.html';

            }
        })


    })


});