var verifyId = function () {

    $("input[name=tickets]").each(function () {
        $(this).click(function () {
            var price = $(this).val();
            if (price == "210") {
                $('.checkstudent').addClass('show');
            } else {
                $('.checkstudent').removeClass('show');

            }
            if (price == "350") {
                $('.checkdev').addClass('show');
            } else {
                $('.checkdev').removeClass('show');

            }
        });
    });


};


function bindAvatar() {
    if (window.URL.createObjectURL) {
        // bindAvatar3();
    } else if (window.FileReader) {
        bindAvatar2();
    } else {
        bindAvatar1();
    }
}

/*Ajax上传至后台并返回图片的url*/
function bindAvatar1() {
    $("#avatarSlect").change(function () {
        var csrf = $("input[name='csrfmiddlewaretoken']").val();
        var formData = new FormData();
        formData.append("csrfmiddlewaretoken", csrf);
        formData.append('avatar', $("#avatarSlect")[0].files[0]);
        /*获取上传的图片对象*/
        $.ajax({
            url: '/upload_avatar/',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (args) {
                console.log(args);
                /*服务器端的图片地址*/
                $("#avatarPreview").attr('src', '/' + args);
                /*预览图片*/
                $("#avatar").val('/' + args);
                /*将服务端的图片url赋值给form表单的隐藏input标签*/
            }
        })
    })
}

/*window.FileReader本地预览*/
function bindAvatar2() {
    console.log(2);
    $("#avatarSlect").change(function () {
        var obj = $("#avatarSlect")[0].files[0];
        var fr = new FileReader();
        fr.onload = function () {
            $("#avatarPreview").attr('src', this.result);
            console.log(this.result);
            $("#avatar").val(this.result);
        };
        fr.readAsDataURL(obj);
    })
}

/*window.URL.createObjectURL本地预览*/
// function bindAvatar3() {
//     console.log(3);
//     $("#avatarSlect").change(function() {
//         var obj = $("#avatarSlect")[0].files[0];
//         var wuc = window.URL.createObjectURL(obj);
//         $("#avatarPreview").attr('src', wuc);
//         $("#avatar").val(wuc); {#
//             $("#avatarPreview").load(function() {#} /*当图片加载后释放内存空间，但在jQuery3.2.1中会报错。浏览器关闭后也会自动释放*/ {# window.URL.revokeObjectURL(wuc);# } {#})#
//         }
//     })
// }


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

function sendParticipant(name, country, company, position, email, phone, note) {

    if (name == "" || country == "" || company == "" || position == "" || email == "" || phone == "" || note == "") {
        $('#again').modal('show');
    }
    else {
        $.ajax({
            type: "post",
            url: "../public/?service=App.Participant.Insert",
            data: {
                name: name,
                country: country,
                company: company,
                position: position,
                email: email,
                phone: phone,
                note: note
            },
            timeout: 5000,    //超时时间
            dataType: 'json',    //返回的数据格式：json/xml/html/script/jsonp/text
            success: function (data) {
                if (data.ret == 200) {
                    $("#name").val("");
                    $("#country").val("");
                    $("#company").val("");
                    $("#position").val("");
                    $("#email").val("");
                    $("#phone").val("");
                    $("#note").val("");
                    alert("信息提交成功，我们会尽快与你取得联系。");
                } else {
                    alert("信息提交失败，请核对所填的信息或稍后再试。");
                }
            },
            error: function (xhr, textStatus) {
                console.log('错误');
                console.log(xhr);
                console.log(textStatus);
                alert("信息提交失败，请检查你的网络。");
            }
        })

    }
}

// omise

// Set default config.默认设置
OmiseCard.configure({
    publicKey: 'pkey_test_5aaqj86dqmypbrccuyy',
    currency: 'usd',
    image: '../images/linktime_logo.svg',
    frameLabel: 'Linktime',
    frameDescription: 'Merchant description',
    submitLabel: 'Pay',
    buttonLabel: 'Pay with Omise',
    submitFormTarget: null,
});

// 自定义设置
OmiseCard.configureButton('#checkout-button', {
    amount: 99500,
});

// Attach configuration to all target buttons
// OmiseCard.attach();


$(function () {
    verifyId();
    bindAvatar();

});