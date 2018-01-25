Date.prototype.Format = function (fmt) { //author: meizz
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "h+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
};

// axios.defaults.timeout = 5000;
axios.defaults.baseURL = 'https://edcon.io/tp/public/index.php/admin/edcon/';

var data = {
    bird: [],
    developer: [],
    standard: [],
    student: [],
    free: [],

    speakers: [],
    sponsors: [],
    superdemos: [],
    communityList: [],
    mediaList: [],

    checkInList: [],

    payFailList: [],

    rowtemplate: {
        id: '',
        ticket_no: '',
        company: "",
        country: "",
        email: "",
        name: "",
        phone: "",
        position: "",

        repo: "",

        school: "",
        student_card: "",

        size: "",
        media: "",
        note: "",

        pass: "0",
        send: "0",
    },

    //搜索
    keyword: '',
    isSearch: 0,
    searchPage: 1,

    pagesize: 20,
    curpage: 0, //初始化页码
    totalPage: 1,

    // 添加新信息
    isAdd: 0, //初始化Add

    loading: 1,//一进入页面就显示loading

    //全选
    allData: {
        parCheck: false
    },

    // 登录
    Username: '',
    Password: '',
    newPassword: '',
    oldPassword: '',

    // 编辑器
    needEditor: 0,
    emailSubject: '',
    emailContent: '',

    // 新消息通知
    newSpeakerNum: '',
    newSponsorNum: '',
    newMediaNum: '',
    newCommunityNum: '',
    newSuperdemoNum: '',
    newStudentNum: '',
    newDevNum: '',

    // 签到页面
    isCheckList: 0,
    totalTicketsNum: '',
    totalCheckNum: '',

    newPayFailNum: '',

    //支付失败
    payFailTotalNum: '',
    failed_fraud_check_num: '',
    payment_rejected_num: '',
    invalid_security_code_num: ''


};
var saveInfo, emailType, editor, name, phone, email, position, country, note, company, size, media, repo, school, role;

//ViewModel
var vue = new Vue({
    el: '#app',
    data: data,
    mounted() {

        //监测登录状态
        axios.post('getLoginStatus', {})
            .then((response) => {

                if (window.location.pathname != '/preview/admin/production/login.html' && response.data.status == 127) {
                    alert('用户未登录');
                    top.location = 'login.html';

                }
            })
            .catch(function (error) {
                console.log(error);
                top.location = location.href;

            });

        //后端拿列表数据
        this.curpage = 1;

        // 创建编辑器
        if (window.location.pathname == '/preview/admin/production/editemail.html') {
            this.loading = 0;

            this.needEditor = 1;
        }


        if (window.location.pathname == '/preview/admin/production/checkin.html') {
            this.loading = 0;

            this.isCheckList = 1;
        }

        if (window.location.pathname == '/preview/admin/production/index.html') {
            this.loading = 0;

        }
    },

    methods: {

        login: function () {
            var username = this.Username,
                password = this.Password;
            axios.post('login', {
                username: username,
                password: password
            })
                .then((response) => {
                    if (response.data.status == 0) {
                        top.location = 'index.html';

                    } else if (response.data.status == 1) {
                        alert('用户名或密码不正确');
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        signout: function () {

            axios.post('logout', {})
                .then((response) => {
                    top.location = 'login.html';
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        changePassword: function () {
            var newPassword = this.newPassword,
                oldPassword = this.oldPassword;
            axios.post('password', {
                oldPassword: oldPassword,
                newPassword: newPassword
            })
                .then((response) => {

                    console.log(response);

                    if (response.data.status == 0) {

                        alert('密码已修改, 请重新登录');
                        this.newPassword = '';
                        this.oldPassword = '';
                        top.location = 'login.html';

                    } else if (response.data.status == 1) {
                        alert('旧密码错误')

                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        goAdd: function (e) {
            $('.editIt').modal('show');

            this.isAdd = 1

        },


        Add: function (type, ticketType) {
            var vm = this;
            this.loading = 1;

            $('.editIt').modal('hide');

            var time1 = new Date().Format("yyyy-MM-dd hh:mm:ss");
            this.rowtemplate.time = time1;

            email = this.rowtemplate.email;
            name = this.rowtemplate.name;
            country = this.rowtemplate.country;
            position = this.rowtemplate.position;
            phone = this.rowtemplate.phone;
            company = this.rowtemplate.company;
            note = this.rowtemplate.note;
            size = this.rowtemplate.size;
            media = this.rowtemplate.media;
            role = this.rowtemplate.role;
            repo = this.rowtemplate.repo;
            school = this.rowtemplate.school;


            //添加票s
            if (window.location.pathname == '/preview/admin/production/early_bird_ticket.html' || window.location.pathname == '/preview/admin/production/student_ticket.html' || window.location.pathname == '/preview/admin/production/standard_ticket.html' || window.location.pathname == '/preview/admin/production/developer_ticket.html') {

                axios.post('addTicket', {
                    type: ticketType,
                    name: name,
                    country: country,
                    company: company,
                    position: position,
                    email: email,
                    repo: repo,
                    phone: phone,
                    school: school,
                    student_card: '/upload/image/20180110/3d404edae329741493d0fcba9e53c014.jpeg'

                })
                    .then((response) => {

                        this.rowtemplate.ticket_no = response.data.data.ticket_no;
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);
                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }


            //添加免费票
            if (window.location.pathname == '/preview/admin/production/free_ticket.html') {

                axios.post('addFreeTicket', {
                    email: email,
                    name: name,
                    country: country,
                    company: company,
                    position: position,
                    phone: phone,
                    role: role,
                })
                    .then((response) => {

                        this.rowtemplate.ticket_no = response.data.data.ticket_no;
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);
                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //添加speaker
            if (window.location.pathname == '/preview/admin/production/speaker.html') {


                axios.post('addSpeaker', {
                    email: email,
                    name: name,
                    country: country,
                    position: position,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);
                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //添加Sponsor
            if (window.location.pathname == '/preview/admin/production/sponsor.html') {


                axios.post('addSponsor', {
                    email: email,
                    name: name,
                    country: country,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);
                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //添加Superdemo
            if (window.location.pathname == '/preview/admin/production/superdemo.html') {


                axios.post('addSuperdemo', {
                    email: email,
                    name: name,
                    country: country,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);
                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //添加community
            if (window.location.pathname == '/preview/admin/production/community.html') {


                axios.post('addCommunity', {
                    email: email,
                    name: name,
                    country: country,
                    size: size,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);
                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //添加media
            if (window.location.pathname == '/preview/admin/production/media.html') {


                axios.post('addMedia', {
                    email: email,
                    name: name,
                    country: country,
                    media: media,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.rowtemplate.id = response.data.data.id;
                        this.loading = 0;

                        type.push(this.rowtemplate);

                        // 还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }


        },


        closeEdit: function () {

            $('.editIt').modal('hide');

            // 还原模板
            this.rowtemplate = {
                id: '', ticket_no: '', company: "", country: "", email: "", name: "", phone: "", position: "",
                repo: "",
                school: "", student_card: "",
                size: "", media: "", note: "",
                pass: "0", send: "0",
            }
        },


        Edit: function (info) {

            this.isAdd = 0;

            $('.editIt').modal('show');

            saveInfo = info;

            //显示要编辑的信息
            this.rowtemplate = info;

        },


        Save: function (type) {
            this.loading = 1;


            $('.editIt').modal('hide');

            email = this.rowtemplate.email;
            name = this.rowtemplate.name;
            country = this.rowtemplate.country;
            position = this.rowtemplate.position;
            phone = this.rowtemplate.phone;
            company = this.rowtemplate.company;
            note = this.rowtemplate.note;
            size = this.rowtemplate.size;
            media = this.rowtemplate.media;

            //保存编辑票种信息
            if (window.location.pathname == '/preview/admin/production/early_bird_ticket.html' || window.location.pathname == '/preview/admin/production/student_ticket.html' || window.location.pathname == '/preview/admin/production/standard_ticket.html' || window.location.pathname == '/preview/admin/production/developer_ticket.html' || window.location.pathname == '/preview/admin/production/free_ticket.html') {


                axios.post('editTicket', {
                    id: saveInfo.id,
                    email: email,
                    name: name,
                    country: country,
                    position: position,
                    phone: phone,
                    company: company
                })
                    .then((response) => {
                        this.loading = 0;

                        //还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //保存编辑speaker
            if (window.location.pathname == '/preview/admin/production/speaker.html') {


                axios.post('editSpeaker', {
                    id: saveInfo.id,
                    email: email,
                    name: name,
                    country: country,
                    position: position,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.loading = 0;

                        //还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //保存编辑Sponsor
            if (window.location.pathname == '/preview/admin/production/sponsor.html') {


                axios.post('editSponsor', {
                    id: saveInfo.id,
                    email: email,
                    name: name,
                    country: country,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.loading = 0;

                        //还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //保存编辑Superdemo
            if (window.location.pathname == '/preview/admin/production/superdemo.html') {

                axios.post('editSuperdemo', {
                    id: saveInfo.id,
                    email: email,
                    name: name,
                    country: country,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.loading = 0;

                        //还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //保存编辑community
            if (window.location.pathname == '/preview/admin/production/community.html') {


                axios.post('editCommunity', {
                    id: saveInfo.id,
                    email: email,
                    name: name,
                    country: country,
                    size: size,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.loading = 0;

                        //还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //保存编辑media
            if (window.location.pathname == '/preview/admin/production/media.html') {


                axios.post('editMedia', {
                    id: saveInfo.id,
                    email: email,
                    name: name,
                    country: country,
                    media: media,
                    phone: phone,
                    company: company,
                    note: note
                })
                    .then((response) => {
                        this.loading = 0;

                        //还原模板
                        this.rowtemplate = {
                            id: '',
                            ticket_no: '',
                            company: "",
                            country: "",
                            email: "",
                            name: "",
                            phone: "",
                            position: "",
                            repo: "",
                            school: "",
                            student_card: "",
                            size: "",
                            media: "",
                            note: "",
                            pass: "0",
                            send: "0",
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

        },


        Delete: function (type, info, id, i) {
            this.loading = 1;

            var DeleteUrl;

            //可以删除所有票种，但是现在前端显示只能删除免费票
            if (window.location.pathname == '/preview/admin/production/free_ticket.html') {

                DeleteUrl = 'DeleteTicket'
            }

            //删除speaker
            if (window.location.pathname == '/preview/admin/production/speaker.html') {

                DeleteUrl = 'DeleteSpeaker'
            }

            //删除Sponsor
            if (window.location.pathname == '/preview/admin/production/sponsor.html') {

                DeleteUrl = 'DeleteSponsor'

            }

            //删除Superdemo
            if (window.location.pathname == '/preview/admin/production/superdemo.html') {

                DeleteUrl = 'DeleteSuperdemo'

            }

            //删除community
            if (window.location.pathname == '/preview/admin/production/community.html') {

                DeleteUrl = 'DeleteCommunity'

            }

            //删除media
            if (window.location.pathname == '/preview/admin/production/media.html') {

                DeleteUrl = 'DeleteMedia'

            }


            axios.post(DeleteUrl, {
                id: id,
            })
                .then((response) => {
                    this.loading = 0;

                    type.splice(i, 1);

                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        Search: function (e) {
            this.loading = 1;
            this.isSearch = 1;
            this.searchPage = 1;

            var keyword = this.keyword,
                page = this.searchPage - 1;

            //搜索早鸟票0:早鸟 1:标准 2:开发者 3:学生 4:免费
            if (window.location.pathname == '/preview/admin/production/early_bird_ticket.html') {

                axios.post('ticketSearch', {
                    keyword: keyword,
                    page: page,
                    type: '0'
                })
                    .then((response) => {

                        var dataStr = response.data;
                        this.loading = 0;
                        this.bird = dataStr.data;
                        this.totalPage = dataStr.totalPage;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //搜索standard的票
            if (window.location.pathname == '/preview/admin/production/standard_ticket.html') {

                axios.post('ticketSearch', {
                    keyword: keyword,
                    page: page,
                    type: '1'
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.standard = dataStr.data;
                        this.totalPage = dataStr.totalPage;


                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索developer的票
            if (window.location.pathname == '/preview/admin/production/developer_ticket.html') {

                axios.post('ticketSearch', {
                    keyword: keyword,
                    page: page,
                    type: '2'
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.developer = dataStr.data;
                        this.totalPage = dataStr.totalPage;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索student的票
            if (window.location.pathname == '/preview/admin/production/student_ticket.html') {

                axios.post('ticketSearch', {
                    keyword: keyword,
                    page: page,
                    type: '3'
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.student = dataStr.data;
                        this.totalPage = dataStr.totalPage;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索free的票
            if (window.location.pathname == '/preview/admin/production/free_ticket.html') {

                axios.post('ticketSearch', {
                    keyword: keyword,
                    page: page,
                    type: '4'
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.free = dataStr.data;
                        this.totalPage = dataStr.totalPage;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索speaker
            if (window.location.pathname == '/preview/admin/production/speaker.html') {


                axios.post('speakerSearch', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {

                        var dataStr = response.data;
                        this.loading = 0;
                        this.speakers = dataStr.data;
                        this.totalPage = dataStr.totalPage;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //搜索Sponsor
            if (window.location.pathname == '/preview/admin/production/sponsor.html') {

                axios.post('sponsorSearch', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {

                        var dataStr = response.data;
                        this.loading = 0;
                        this.sponsors = dataStr.data;
                        this.totalPage = dataStr.totalPage;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索Superdemo
            if (window.location.pathname == '/preview/admin/production/superdemo.html') {

                axios.post('superdemoSearch', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {

                        var dataStr = response.data;
                        this.loading = 0;
                        this.superdemos = dataStr.data;
                        this.totalPage = dataStr.totalPage;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索community
            if (window.location.pathname == '/preview/admin/production/community.html') {


                axios.post('communitySearch', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {

                        var dataStr = response.data;
                        this.loading = 0;
                        this.communityList = dataStr.data;
                        this.totalPage = dataStr.totalPage;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索media
            if (window.location.pathname == '/preview/admin/production/media.html') {

                axios.post('mediaSearch', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {

                        var dataStr = response.data;
                        this.loading = 0;
                        this.mediaList = dataStr.data;
                        this.totalPage = dataStr.totalPage;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //搜索签到
            if (window.location.pathname == '/preview/admin/production/checkin.html') {
                axios.post('searchCheckTicket', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {
                        var dataStr = response.data.data;
                        this.loading = 0;
                        this.checkInList = dataStr.ticket_list;
                        this.totalPage = dataStr.total_page;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //搜错误信息
            if (window.location.pathname == '/preview/admin/production/payfail.html') {
                axios.post('searchPayFailList', {
                    keyword: keyword,
                    page: page
                })
                    .then((response) => {
                        var dataStr = response.data.data;
                        this.loading = 0;
                        this.payFailList = dataStr.list;
                        this.totalPage = dataStr.total_page;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }


        },


        //上一页方法
        PrePage: function (type) {

            if (this.isSearch == 1) {
                if (this.searchPage !== 1) {
                    this.searchPage = this.searchPage - 1
                }
            } else {
                if (this.curpage !== 1) {
                    this.curpage = this.curpage - 1
                }
            }

        },


        //下一页方法
        NextPage: function (type) {

            if (this.isSearch == 1) {
                if (this.searchPage !== this.totalPage) {
                    this.searchPage = this.searchPage + 1
                }
            } else {
                if (this.curpage !== this.totalPage) {
                    this.curpage = this.curpage + 1
                }
            }


        },


        //点击页码的方法
        NumPage: function (num, event) {


            if (this.isSearch == 1) {
                this.searchPage = num;
            } else {
                this.curpage = num;

            }

        },


        /*
        *清除红点
         */
        registPage: function (id) {

            axios.post('clearNew', {
                id: id
            })
                .then((response) => {

                    // console.log(response)

                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        ticketPage: function (id) {
            axios.post('clearNewTicket', {
                id: id
            })
                .then((response) => {

                    // console.log(response)

                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        payFailPage: function () {
            axios.post('clearNewFailPay', {})
                .then((response) => {

                    // console.log(response)

                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        /*
         * 清除红点end
         */

        //多选
        // allSelect: function (type) {
        //     var vm = this;
        //     type.forEach(function (row) {
        //         row.isCheck = vm.allData.parCheck
        //     })
        //
        // },

        //选1个
        // singleSelect: function (type) {
        //     var vm = this;
        //
        //     var selectData = type.filter(function (row) {
        //         return row.isCheck == true
        //     })
        //
        //     selectData.length == type.length ? vm.allData.parCheck = true : vm.allData.parCheck = false;
        //
        // },

        //发送多选选中的人的票据邮件
        // SendAllSelectedEmail: function (type) {
        //
        //     var selectData = type.filter(function (row) {
        //         if (row.noCheck != 1) {
        //             if (row.isCheck) {
        //                 // console.log('ticket_no'+row.ticket_no)
        //                 row.send = 1;
        //
        //                 row.pass = 1;
        //
        //             }
        //
        //             return row.isCheck == true
        //         }
        //
        //
        //     })
        //     //去拿被选中的选项的数据，返回给后台
        //
        //     var formData = selectData;
        //
        //     if (formData.length > 0) {
        //
        //         console.log(JSON.stringify(formData));
        //     }
        // },


        //学生和开发通过审核
        Pass: function (type, info, id) {
            // console.log(info);
            var CancelToken = axios.CancelToken;
            var source = CancelToken.source();
            info.pass = 1;
            axios.post('pass', {
                id: id,
                cancelToken: source.token
            }).catch(function (thrown) {
                if (axios.isCancel(thrown)) {
                    console.log('Request canceled', thrown.message);

                } else {
                    // 处理错误
                }
            })
                .then((response) => {
                    console.log(response);

                })
                .catch(function (error) {
                    console.log(error);
                });

            // 取消请求（message 参数是可选的）
            source.cancel('取消请求');

        },

        //媒体，社区，demo通过审核
        PassFree: function (type, info, id) {
            // console.log(info);
            var CancelToken = axios.CancelToken,
                source = CancelToken.source(),
                apiURL;

            if (window.location.pathname == '/preview/admin/production/community.html') {
                apiURL = 'communityPass';
            }

            if (window.location.pathname == '/preview/admin/production/media.html') {
                apiURL = 'mediaPass';
            }

            if (window.location.pathname == '/preview/admin/production/superdemo.html') {
                apiURL = 'superdemoPass';
            }

            axios.post(apiURL, {
                id: id,
                cancelToken: source.token
            }).catch(function (thrown) {
                if (axios.isCancel(thrown)) {
                    console.log('Request canceled', thrown.message);

                } else {
                    // 处理错误
                }
            })
                .then((response) => {
                    console.log(response);

                })
                .catch(function (error) {
                    console.log(error);
                });

            info.pass = 1;

            // 取消请求（message 参数是可选的）
            source.cancel('取消请求');

        },

        //不通过审核
        Reject: function (type, info, id) {
            // console.log(info)
            var CancelToken = axios.CancelToken;
            var source = CancelToken.source();
            info.pass = 2;

            axios.post('reject', {
                id: id,
                cancelToken: source.token
            }).catch(function (thrown) {
                if (axios.isCancel(thrown)) {
                    console.log('Request canceled', thrown.message);

                } else {
                    // 处理错误
                }
            })
                .then((response) => {
                    console.log(response);

                })
                .catch(function (error) {
                    console.log(error);
                });

            // 取消请求（message 参数是可选的）
            source.cancel('取消请求');

        },


        RejectCommunity: function (type, info, id) {
// console.log(info)
            info.pass = 2;

            axios.post('conmmunityReject', {
                id: id,
            }).then((response) => {
                console.log(response);

            })
                .catch(function (error) {
                    console.log(error);
                });

        },


        changePage: function () {

            var page = this.curpage - 1;

            /*
            *  票
            */
            //拿bird的数据
            if (window.location.pathname == '/preview/admin/production/early_bird_ticket.html') {

                axios.post('earlyTickeyList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.bird = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

            //拿standard的数据
            if (window.location.pathname == '/preview/admin/production/standard_ticket.html') {

                axios.post('standardTickeyList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.standard = dataStr.data;
                        this.totalPage = dataStr.total_page;


                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿developer的数据
            if (window.location.pathname == '/preview/admin/production/developer_ticket.html') {

                axios.post('developerTickeyList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.developer = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿student的数据
            if (window.location.pathname == '/preview/admin/production/student_ticket.html') {

                axios.post('studentTickeyList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.student = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿free的数据
            if (window.location.pathname == '/preview/admin/production/free_ticket.html') {

                axios.post('freeTickeyList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.free = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }


            /*
             *  报名
             */
            //拿speaker的数据
            if (window.location.pathname == '/preview/admin/production/speaker.html') {

                axios.post('speakerList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.speakers = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿sponsor的数据
            if (window.location.pathname == '/preview/admin/production/sponsor.html') {

                axios.post('sponsorList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.sponsors = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿superdemo的数据
            if (window.location.pathname == '/preview/admin/production/superdemo.html') {

                axios.post('superdemoList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.superdemos = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿community的数据
            if (window.location.pathname == '/preview/admin/production/community.html') {

                axios.post('communityList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.communityList = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿media的数据
            if (window.location.pathname == '/preview/admin/production/media.html') {

                axios.post('mediaList', {
                    page: page,
                })
                    .then((response) => {
                        var dataStr = response.data;
                        this.loading = 0;
                        this.mediaList = dataStr.data;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿check in的数据
            if (window.location.pathname == '/preview/admin/production/checkin.html') {

                axios.post('checkInList', {
                    page: page,
                })
                    .then((response) => {

                        console.log(response);
                        this.loading = 0;
                        var dataStr = response.data.data;
                        this.totalTicketsNum = dataStr.total;
                        this.totalCheckNum = dataStr.check_in_total;
                        this.checkInList = dataStr.ticket_list;
                        this.totalPage = dataStr.total_page;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            //拿pay fail的数据
            if (window.location.pathname == '/preview/admin/production/payfail.html') {

                axios.post('payFailList', {
                    page: page,
                })
                    .then((response) => {

                        console.log(response);
                        this.loading = 0;
                        var dataStr = response.data.data;
                        this.totalTicketsNum = dataStr.total;
                        // this.totalCheckNum = dataStr.check_in_total;
                        this.payFailList = dataStr.list;
                        this.totalPage = dataStr.total_page;
                        this.payFailTotalNum = dataStr.total;
                        this.failed_fraud_check_num = dataStr.failed_fraud_check;
                        this.payment_rejected_num = dataStr.payment_rejected;
                        this.invalid_security_code_num = dataStr.invalid_security_code;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }

            /*
             *  //结束
             */


        },


        getEamil: function (type) {
            var that = this;
            this.loading = 1;

            editor.txt.html('<p></p>');
            this.emailSubject = '';

            emailType = type;

            axios.post('getMail', {
                type: type,

            })
                .then((response) => {

                    this.emailContent = response.data.data.body;
                    this.emailSubject = response.data.data.subject;
                    this.loading = 0;

                    // console.log('emailContent', that.emailContent)
                    // console.log('decodeURIemailContent', decodeURI(that.emailContent))
                    editor.txt.html(that.emailContent);

                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        saveEamilContent: function () {
            this.loading = 1;

            var body = this.emailContent,
                subject = this.emailSubject;

            axios.post('editMail', {
                type: emailType,
                body: body,
                subject: subject,

            })
                .then((response) => {

                    editor.txt.html('<p></p>');

                    this.emailSubject = '';
                    this.loading = 0;

                    alert('保存成功');


                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        createAEditor: function () {
            var _this = this;

            var E = window.wangEditor;

            editor = new E('#editor');

            editor.customConfig.onchange = (html) => {

                _this.emailContent = html;

            };

            editor.create();
        },


        getRemind: function () {

            function getNewRegistration() {
                return axios.get('newRegistration');
            }

            function getNewTicket() {
                return axios.get('newTicket');
            }

            function getNewPayFail() {
                return axios.get('newFailPay');
            }

            axios.all([getNewRegistration(), getNewTicket(), getNewPayFail()])
                .then(axios.spread((NewRegistrationNum, NewTicketNum, NewPayFailNum) => {

                    // 两个请求现在都执行完成
                    // console.log('NewRegistrationNum: ', NewRegistrationNum)
                    var registerAlertStr = NewRegistrationNum.data.data;
                    this.newCommunityNum = registerAlertStr.new_community;
                    this.newSpeakerNum = registerAlertStr.new_speaker;
                    this.newSponsorNum = registerAlertStr.new_sponsor;
                    this.newSuperdemoNum = registerAlertStr.new_superdemo;
                    this.newMediaNum = registerAlertStr.new_media;

                    // console.log('NewTicketNum: ', NewTicketNum)

                    var ticketAlertStr = NewTicketNum.data.data;
                    this.newStudentNum = ticketAlertStr.new_student;
                    this.newDevNum = ticketAlertStr.new_developer;

                    // console.log('payFailAlertStr: ', NewPayFailNum)

                    var payFailAlertStr = NewPayFailNum.data.data;
                    this.newPayFailNum = payFailAlertStr.count;

                }));

        },


        checkList: function () {


        }

    },


    watch: {
        curpage: 'changePage',//监测当前页码的变化
        loading: 'getRemind',//监测loading的变化
        searchPage: 'Search',//监测搜索的页码的变化
        needEditor: 'createAEditor',//监测当前页面是否是editemail，是就创建editor
        isCheckList: 'checkList'//
    }
});





