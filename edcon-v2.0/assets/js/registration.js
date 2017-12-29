$(function () {

    /*
     * 验证邮箱格式
     */
    var fChkMail = function (szMail) {
        var szReg = /^[A-Za-zd]+([-_.][A-Za-zd]+)*@([A-Za-zd]+[-.])+[A-Za-zd]{2,5}$/;
        var bChk = szReg.test(szMail);
        return bChk;
    };
    if (!fChkMail($(' input[ placeholder="Email" ] ').val())) {

    }

    /*
     * 电话号码只能输数字
     */
    // $(' input[ placeholder="Phone" ] ').keyup(function () {
    //     $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    // }).bind("paste", function () {  //CTR+V事件处理
    //     $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    // }).css("ime-mode", "disabled"); //CSS设置输入法不可用

    /*
    * 提交speaker的信息
    */

    $('#speaker-form').submit(function (event) {
        event.preventDefault(); //阻止表单提交浏览器跳转逻辑

        var speakername = $(".speakername").val(),
            speakercountry = $(".speakercountry").val(),
            speakercompany = $(".speakercompany").val(),
            speakerposition = $(".speakerposition").val(),
            speakeremail = $(".speakeremail").val(),
            speakerphone = $(".speakerphone").val(),
            speakernote = $(".speakernote").val();

        if (speakername == "" || speakercountry == "" || speakercompany == "" || speakerposition == "" || speakeremail == "" || speakerphone == "" || speakernote == "") {
            $('#again').modal('show');
        } else {
            $('.loading,.loading-mask').fadeIn(100);


            /*
             *  提交speaker的信息
             */
            var speakerInfo = new FormData($("#speaker-form").get(0));

            var sendspeakerInfo = new XMLHttpRequest();
            sendspeakerInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/speaker');
            sendspeakerInfo.send(speakerInfo);

            sendspeakerInfo.onload = function () {

                var json = JSON.parse(this.response);
                // console.log(json);
                // console.log(json.status);
                var status = json.status;
                if (status == 0) {
                    $('.loading,.loading-mask').fadeOut();

                    $('#success').modal('show').on('hidden.bs.modal', function (e) {
                        // location.replace(location.href)
                        document.getElementById("speaker-form").reset()

                    });
                } else {
                    $('.loading,.loading-mask').fadeOut();

                    $('#failed').modal('show');
                }

            };

        }

    });


    /*
     * 提交Sponsor的信息
     */


    $('#sponsor-form').submit(function (event) {
        event.preventDefault(); //阻止表单提交浏览器跳转逻辑

        var sponsorname = $(".sponsorname").val(),
            sponsorcountry = $(".sponsorcountry").val(),
            sponsorcompany = $(".sponsorcompany").val(),
            sponsoremail = $(".sponsoremail").val(),
            sponsorphone = $(".sponsorphone").val(),
            sponsornote = $(".sponsornote").val();

        if (sponsorname == "" || sponsorcountry == "" || sponsorcompany == "" || sponsoremail == "" || sponsorphone == "" || sponsornote == "") {
            $('#again').modal('show');
        } else {
            $('.loading,.loading-mask').fadeIn(100);

            /*
             *  提交Sponsor的信息
             */
            var sponsorInfo = new FormData($("#sponsor-form").get(0));

            var sendsponsorInfo = new XMLHttpRequest();
            sendsponsorInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/sponsor');
            sendsponsorInfo.send(sponsorInfo);

            sendsponsorInfo.onload = function () {

                var json = JSON.parse(this.response);
                // console.log(json);
                // console.log(json.status);
                var status = json.status;
                if (status == 0) {
                    $('.loading,.loading-mask').fadeOut();

                    $('#success').modal('show').on('hidden.bs.modal', function (e) {
                        document.getElementById("sponsor-form").reset()
                        // location.replace(location.href)

                    });
                } else {
                    $('.loading,.loading-mask').fadeOut();

                    $('#failed').modal('show');
                }

            };

        }


    });


    /*
     * 提交superdemo的信息
     */

    $('#superdemo-form').submit(function (event) {
        event.preventDefault(); //阻止表单提交浏览器跳转逻辑

        var Superdemoname = $(".Superdemoname").val(),
            Superdemocountry = $(".Superdemocountry").val(),
            Superdemocompany = $(".Superdemocompany").val(),
            Superdemoemail = $(".Superdemoemail").val(),
            Superdemophone = $(".Superdemophone").val(),
            Superdemonote = $(".Superdemonote").val();

        if (Superdemoname == "" || Superdemocountry == "" || Superdemocompany == "" || Superdemoemail == "" || Superdemophone == "" || Superdemonote == "") {
            $('#again').modal('show');

        } else {
            $('.loading,.loading-mask').fadeIn(100);

            /*
             *  提交superdemo的信息
             */
            var superdemoInfo = new FormData($("#superdemo-form").get(0));

            var sendsuperdemoInfo = new XMLHttpRequest();
            sendsuperdemoInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/superdemo');
            sendsuperdemoInfo.send(superdemoInfo);

            sendsuperdemoInfo.onload = function () {

                var json = JSON.parse(this.response);
                // console.log(json);
                // console.log(json.status);
                var status = json.status;
                if (status == 0) {
                    $('.loading,.loading-mask').fadeOut();

                    $('#success').modal('show').on('hidden.bs.modal', function (e) {
                        document.getElementById("superdemo-form").reset()
                        // location.replace(location.href)

                    });
                } else {
                    $('.loading,.loading-mask').fadeOut();

                    $('#failed').modal('show');
                }

            };

        }
    });


    /*
     * 提交media的信息
     */

    $('#media-form').submit(function (event) {

        event.preventDefault(); //阻止表单提交浏览器跳转逻辑

        var Medianame = $(".Medianame").val(),
            Mediacountry = $(".Mediacountry").val(),
            Mediacompany = $(".Mediacompany").val(),
            Mediaepress = $(".Mediaepress").val(),
            Mediaemail = $(".Mediaemail").val(),
            Mediaphone = $(".Mediaphone").val(),
            Medianote = $(".Medianote").val();

        if (Medianame == "" || Mediacountry == "" || Mediacompany == "" || Mediaepress == "" || Mediaemail == "" || Mediaphone == "" || Medianote == "") {
            $('#again').modal('show');

        } else {
            $('.loading,.loading-mask').fadeIn(100);

            /*
             *  提交media的信息
             */
            var mediaInfo = new FormData($("#media-form").get(0));

            var sendMediaInfo = new XMLHttpRequest();
            sendMediaInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/media');
            sendMediaInfo.send(mediaInfo);

            sendMediaInfo.onload = function () {

                var json = JSON.parse(this.response);
                // console.log(json);
                // console.log(json.status);
                var status = json.status;
                if (status == 0) {
                    $('.loading,.loading-mask').fadeOut();

                    $('#success').modal('show').on('hidden.bs.modal', function (e) {
                        document.getElementById("media-form").reset()
                        // location.replace(location.href)

                    });
                } else {
                    $('.loading,.loading-mask').fadeOut();

                    $('#failed').modal('show');
                }

            };

        }
    });


    /*
     * 提交community的信息
     */

    $('#community-form').submit(function (event) {

        event.preventDefault(); //阻止表单提交浏览器跳转逻辑

        var communityname = $(".communityname").val(),
            communitycountry = $(".communitycountry").val(),
            communitycompany = $(".communitycompany").val(),
            communitysize = $(".communitysize").val(),
            communityemail = $(".communityemail").val(),
            communityphone = $(".communityphone").val(),
            communitynote = $(".communitynote").val();

        if (communityname == "" || communitycountry == "" || communitycompany == "" || communitysize == "" || communityemail == "" || communityphone == "" || communitynote == "") {
            $('#again').modal('show');

        } else {
            $('.loading,.loading-mask').fadeIn(100);

            /*
             *  提交community的信息
             */
            var communityInfo = new FormData($("#community-form").get(0));

            var sendcommunityInfo = new XMLHttpRequest();
            sendcommunityInfo.open('post', 'https://edcon.io/tp/public/index.php/index/index/community');
            sendcommunityInfo.send(communityInfo);

            sendcommunityInfo.onload = function () {

                var json = JSON.parse(this.response);
                // console.log(json);
                // console.log(json.status);
                var status = json.status;
                if (status == 0) {
                    $('.loading,.loading-mask').fadeOut();

                    $('#success').modal('show').on('hidden.bs.modal', function (e) {
                        document.getElementById("community-form").reset()
                        // location.replace(location.href)

                    });
                } else {
                    $('.loading,.loading-mask').fadeOut();

                    $('#failed').modal('show');
                }

            };

        }
    })


});