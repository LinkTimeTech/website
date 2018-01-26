$(function () {

    /*
     * 卖完票后不能选
     */
    var getTicketInfo = new XMLHttpRequest();
    getTicketInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/getSoltInfo');
    getTicketInfo.send();
    getTicketInfo.onload = function () {
        var json = JSON.parse(this.response);
        // console.log(json);

        var hvEarlyTicket = json.early_solt_out;
        var hvstandardAndDeveloperTicket = json.standardAndDeveloper_solt_out;
        var hvStudentTicket = json.student_solt_out;

        if (hvEarlyTicket === 1) {
            $('#bird').removeAttr('checked').attr("disabled", "disabled").addClass('radiodisable');
            $('#Standard').attr('checked', 'checked');
            $('.noearlyticket').css('display', 'inline-block')
        }

        if (hvstandardAndDeveloperTicket === 1) {
            $('#Standard').removeAttr('checked').attr("disabled", "disabled").addClass('radiodisable');
            $('#developers').removeAttr('checked').attr("disabled", "disabled").addClass('radiodisable');
            $('.noallticket').css('display', 'inline-block');
            $('.gopay').attr("disabled", "disabled").val('Sold Out')
        }

        if (hvStudentTicket === 1) {
            $('#student').removeAttr('checked').attr("disabled", "disabled").addClass('radiodisable');
            $('.nostudentticket').css('display', 'inline-block')
        }

    };


    /*
     * 不同的票出现不同的选项
     */
    var verifyId = function () {

        $("input[name=type]").each(function () {
            $(this).click(function () {

                var type = $(this).val();

                // 学生
                if (type == "3") {
                    $('.ticketprice').text('140');

                    $('.checkstudent').fadeIn(500);
                    $('.school').attr('required', '');
                    $('.paysuccBody').text('Congratulations! You have successfully paid for EDCON, we will review and send you E-ticket in one week, please check your email then.');

                    $(".repo").val('')

                } else {
                    $('.checkstudent').fadeOut(50);
                    $('.school').removeAttr('required', '')

                }

                // 开发者
                if (type == "2") {
                    $('.ticketprice').text('350');

                    $('.checkdev').fadeIn(500);
                    $('.checkdevtext').attr('required', '');
                    $('.paysuccBody').text('Congratulations! You have successfully paid for EDCON, we will review and send you E-ticket in one week, please check your email then.');

                    $(".school").val('')

                } else {
                    $('.checkdev').fadeOut(200);
                    $('.checkdevtext').removeAttr('required', '');
                }

                // 早鸟
                if (type == "0") {
                    $('.ticketprice').text('560');
                }

                // 标准
                if (type == "1") {
                    $('.ticketprice').text('700');
                }

                // 早鸟或标准
                if (type == "1" || type == "0") {
                    $(".repo").val('');
                    $(".school").val('');
                    $('.paysuccBody').text('Congratulations! You have successfully paid for EDCON, please check your email for E-ticket.');

                    $('.checkstudent').fadeOut(50);
                    $('.checkdev').fadeOut(200);
                }

            });
        });
        //
        // var partname = $(".partname").val(),
        //     partcountry = $(".partcountry").val(),
        //     partcompany = $(".partcompany").val(),
        //     parttitle = $(".parttitle").val(),
        //     partemail = $(".partemail").val(),
        //     partphone = $(".partphone").val(),
        //     partrepo = $(".repo").val(),
        //     partschool = $(".school").val();

        // if (partname == "" || partcountry == "" || partcompany == "" || parttitle == "" || partemail == "" || partphone == "") {
        //     // $('#again').modal('show');
        //
        // }

        var form = document.getElementById('checkout-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault(); //阻止表单提交浏览器跳转逻辑

            $('#chargecard').modal('show')

        })
    };
    verifyId();

    /*
     *  上传学生证与预览
     */
    $('#avatarSlect').change(function () {

        // console.log('%O', this);

        var fileType = $('#avatarSlect')[0].files[0].type,
            fileSize = $('#avatarSlect')[0].files[0].size;

        if (fileType == 'image/jpg' || fileType == 'image/jpeg' || fileType == 'image/png') {
            if (fileSize > 5000000) {
                $('#imagetolarge').modal('show')
            } else {

                if (!this.value) {
                    return;
                }

                /*
                 图片上传
                 */
                var fm = new FormData();
                fm.append('image', this.files[0]);
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    var json = JSON.parse(this.response);
                    // console.log(json);
                    $('#avatarSrc').val(json.data.src);
                };
                xhr.open('post', 'https://edcon.io/tp/public/index.php/index/index/uploadfile');
                xhr.send(fm);

                /*
                 *   图片预览
                 */
                var fr = new FileReader();
                fr.onload = function () {
                    $('.stucardcue').css('display', 'none');
                    $('#avatarPreview').css('display', 'block').attr('src', this.result);
                    $('.stucard-info').css('margin-top', '10px')
                };
                fr.readAsDataURL(this.files[0]);
            }

        } else {
            $('#imagenotright').modal('show')

        }

    });


    /*
     * omise
     */

// 安全码旁边问号点击出现弹窗
    $(".sqinfo").popover({
        trigger: 'click',
        placement: 'right',
        html: true,//开启html 为true的话，data-content里就能放html代码了
        title: '3-digit number on the back of your credit card',
        template: '<div class="popover role="tooltip""><div class="arrow"></div><div class="sc-gqjmRU dwxBLy">3-digit number on the back of your credit card</div>\n' +
        '                                <div class="sc-VigVT qacib"><img src="data:image/png;base64,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" alt=""></div></div>'
    });

// Set default config.默认设置
//     OmiseCard.configure({
//         publicKey: 'pkey_test_5aaqj86dqmypbrccuyy',
//         currency: 'usd',
//         submitFormTarget: null,
//
//     });
//
// // 自定义设置
//     OmiseCard.configureButton('.creatToken', {
//         publicKey: 'pkey_test_5aaqj86dqmypbrccuyy',
//         currency: 'usd',
//         location: 'no',
//     });
//
// // Attach configuration to all target buttons
//     OmiseCard.attach();


// Submit handler for checkout form.
//     Omise.setPublicKey("pkey_test_5abmx0y59wgx8ynuis5");
//     Omise.setPublicKey("pkey_test_56bod6t9yl5li6whpfa"); //linktime
    Omise.setPublicKey("pkey_5af2oawcv1t31tqg8xg"); //linktime

    $('.creatToken').click(function (event) {
        event.preventDefault();

        $('#chargecard').modal('hide');

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

        Omise.createToken('card', cardInformation, function (statusCode, response) {
            if (statusCode === 200) {
                // Success: send back the TOKEN_ID to your server. The TOKEN_ID can be
                // found in `response.id`.

                // console.log(response);

                /*
                 提交买票者信息
                 */
                var purchaser = new FormData($("#checkout-form").get(0));
                purchaser.append('token', response.id);

                var sendPurchaserInfo = new XMLHttpRequest();
                sendPurchaserInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/registration');
                sendPurchaserInfo.send(purchaser);

                sendPurchaserInfo.onload = function () {
                    var json = JSON.parse(this.response);
                    // console.log(json);
                    // console.log(json.status);

                    var isPay = json.status;

                    // 支付成功
                    if (isPay === 0) {
                        $('.loading,.loading-mask').fadeOut();
                        $('.checkstudent').fadeOut(50);
                        $('.school').removeAttr('required', '');
                        $('.checkdev').fadeOut(200);
                        $('.checkdevtext').removeAttr('required', '');

                        $('#paysucc').modal('show');
                        document.getElementById("checkout-form").reset()
                    }

                    // 支付失败
                    else if (isPay === 1) {
                        $('.loading,.loading-mask').fadeOut();
                        $('.checkstudent').fadeOut(50);
                        $('.school').removeAttr('required', '');
                        $('.checkdev').fadeOut(200);
                        $('.checkdevtext').removeAttr('required', '');

                        // console.log(json.message)

                        if (json.message == 'insufficient funds in the account or the card has reached the credit limit') {
                            $('.payfailText').text('Payment failed. You have insufficient funds in your account.');
                        } else if (json.message == 'the security code is invalid') {
                            $('.payfailText').text('Payment failed. Please make sure to enter the correct security code, if failed, please confirm the security code with your card issuing company.');
                        } else {
                            $('.payfailText').text('Payment failed. Please check your email for detailed cause and solution.');
                        }

                        $('#payfail').modal('show');

                        document.getElementById("checkout-form").reset()
                    }
                    //失败
                    else {
                        $('.loading,.loading-mask').fadeOut();
                        $('.checkstudent').fadeOut(50);
                        $('.school').removeAttr('required', '');
                        $('.checkdev').fadeOut(200);
                        $('.checkdevtext').removeAttr('required', '');

                        $('#failed').modal('show');

                    }
                };

            }
            else {
                // Error: display an error message. Note that `response.message` contains
                // a preformatted error message. Also note that `response.code` will be
                // "invalid_card" in case of validation error on the card.
                $('.loading,.loading-mask').fadeOut();
                $('.checkstudent').fadeOut(50);
                $('.school').removeAttr('required', '');
                $('.checkdev').fadeOut(200);
                $('.checkdevtext').removeAttr('required', '');

                $('#payfail').modal('show');
            }
        });
    })


});