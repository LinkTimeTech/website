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
    $(' input[ placeholder="Phone" ] ').keyup(function () {
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    }).bind("paste", function () {  //CTR+V事件处理
        $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    }).css("ime-mode", "disabled"); //CSS设置输入法不可用

    /*
    * 提交speaker的信息
    */
    $('.addSpeaker').click(function sendSpeaker() {

        var speakername = $(" input[ name='speakername' ] ").val(),
            speakercountry = $(" input[ name='speakercountry' ] ").val(),
            speakercompany = $(" input[ name='speakercompany' ] ").val(),
            speakerposition = $(" input[ name='speakerposition' ] ").val(),
            speakeremail = $(" input[ name='speakeremail' ] ").val(),
            speakerphone = $(" input[ name='speakerphone' ] ").val(),
            speakernote = $(" textarea[ name='speakernote' ] ").val();

        if (speakername == "" || speakercountry == "" || speakercompany == "" || speakerposition == "" || speakeremail == "" || speakerphone == "" || speakernote == "") {
            $('#again').modal('show');
        }
        else {
            $.ajax({
                type: "post",
                url: "https://edcon.io/phedcon/public/?service=App.Speaker.Insert",
                data: {
                    name: speakername,
                    country: speakercountry,
                    company: speakercompany,
                    position: speakerposition,
                    email: speakeremail,
                    phone: speakerphone,
                    note: speakernote
                },
                timeout: 5000,    //超时时间
                dataType: 'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                success: function (data) {
                    if (data.ret == 200) {
                        $('#success').modal('show').on('hidden.bs.modal', function (e) {
                            $(".goadd").val('');

                        });
                    } else {
                        $('#failed').modal('show');
                    }
                },
                error: function (xhr, textStatus) {
                    $('#failed').modal('show');
                }
            })
        }
    });


    /*
     * 提交Sponsor的信息
     */
    $('.addSponsor').click(function sendSponsor() {

        var sponsorname = $(" input[ name='sponsorname' ] ").val(),
            sponsorcountry = $(" input[ name='sponsorcountry' ] ").val(),
            sponsorcompany = $(" input[ name='sponsorcompany' ] ").val(),
            sponsoremail = $(" input[ name='sponsoremail' ] ").val(),
            sponsorphone = $(" input[ name='sponsorphone' ] ").val(),
            sponsornote = $(" textarea[ name='sponsornote' ] ").val();

        if (sponsorname == "" || sponsorcountry == "" || sponsorcompany == "" || sponsoremail == "" || sponsorphone == "" || sponsornote == "") {
            $('#again').modal('show');
        }
        else {
            $.ajax({
                type: "post",
                url: "https://edcon.io/phedcon/public/?service=App.Sponsor.Insert",
                data: {
                    name: sponsorname,
                    country: sponsorcountry,
                    company: sponsorcompany,
                    email: sponsoremail,
                    phone: sponsorphone,
                    note: sponsornote
                },
                timeout: 5000,    //超时时间
                dataType: 'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                success: function (data) {
                    if (data.ret == 200) {
                        $('#success').modal('show').on('hidden.bs.modal', function (e) {
                            $(".goadd").val('');
                        });
                    } else {
                        $('#failed').modal('show')
                    }
                },
                error: function (xhr, textStatus) {
                    console.log('错误');
                    console.log(xhr);
                    console.log(textStatus);
                    $('#failed').modal('show');
                }
            })

        }
    });


    /*
     * 提交superdemo的信息
     */
    $('.addHackathon').click(function sendHackathon() {

        var hackathonname = $(" input[ name='hackathonname' ] ").val(),
            hackathoncountry = $(" input[ name='hackathoncountry' ] ").val(),
            hackathoncompany = $(" input[ name='hackathoncompany' ] ").val(),
            hackathonemail = $(" input[ name='hackathonemail' ] ").val(),
            hackathonphone = $(" input[ name='hackathonphone' ] ").val(),
            hackathonnote = $(" textarea[ name='hackathonnote' ] ").val();

        if (hackathonname == "" || hackathoncountry == "" || hackathoncompany == "" || hackathonemail == "" || hackathonphone == "" || hackathonnote == "") {
            $('#again').modal('show');

        }
        else {
            $.ajax({
                type: "post",
                url: "https://edcon.io/phedcon/public/?service=App.Hackathon.Insert",
                data: {
                    name: hackathonname,
                    country: hackathoncountry,
                    company: hackathoncompany,
                    email: hackathonemail,
                    phone: hackathonphone,
                    note: hackathonnote
                },
                timeout: 5000,    //超时时间
                dataType: 'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                success: function (data) {
                    if (data.ret == 200) {
                        $('#success').modal('show').on('hidden.bs.modal', function (e) {
                            $(".goadd").val('');
                        });
                    } else {
                        $('#failed').modal('show');
                    }
                },
                error: function (xhr, textStatus) {
                    console.log('错误');
                    console.log(xhr);
                    console.log(textStatus);
                    $('#failed').modal('show');
                }
            })

        }
    });

});