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

axios.defaults.timeout = 5000;
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

    checkInList: [
        {
            id: '100',
            name: 'Joe',
            ticket_no: '9000',
            company: 'Linktime',
            position: 'web',
            email: '11@qq.com',
            phone: '123467454',
            time: '2017-12-25 19:37:47',
            ticket_used: '0'
        }
    ],

    rowtemplate: {
        name: '',
        ticket_no: '',
        country: '',
        company: '',
        position: '',
        email: '',
        phone: '',

        pass: "0",
        send: "0",
    },

    devtemplate: {
        id: "",
        ticket_no: "",
        company: "",
        country: "",
        email: "",
        name: "",
        phone: "",
        position: "",

        repo: "",

        pass: "0",
        send: "0",

    },
    studenttemplate: {
        id: "",
        ticket_no: "",
        company: "",
        country: "",
        email: "",
        name: "",
        phone: "",
        position: "",

        school: "",
        student_card: "",

        pass: "0",
        send: "0",
    },

    pagesize: 20,
    curpage: 0, //初始化页码
    totalPage: 1,

    isAdd: 0, //初始化Add

    loading: 1,//一进入页面就显示loading

    //全选
    allData: {
        parCheck: false
    },
};
//ViewModel
let vue = new Vue({
    el: '#app',
    data: data,
    mounted() {

        this.curpage = 1; //当前页码为1

    },

    methods: {

        goAdd: function (e) {
            $('.editIt').modal('show');

            this.isAdd = 1

        },

        Add: function (type) {
            var vm = this;

            // if (this.rowtemplate.id != '' && this.rowtemplate.name != '' && this.rowtemplate.country != '' && this.rowtemplate.company != '' && this.rowtemplate.position != '' && this.rowtemplate.email != '' && this.rowtemplate.phone != '') {

            var time1 = new Date().Format("yyyy-MM-dd hh:mm:ss");
            this.rowtemplate.time = time1;

            type.push(this.rowtemplate);

            $('.editIt').modal('hide');

            //还原模板
            this.rowtemplate = {
                id: "",
                ticket_no: "",
                company: "",
                country: "",
                email: "",
                name: "",
                phone: "",
                position: "",

                repo: "",

                school: "",
                student_card: "",

            }


            // }


        },

        closeEdit: function () {

            $('.editIt').modal('hide');

            //还原模板
            this.rowtemplate = {
                id: "",
                ticket_no: "",
                company: "",
                country: "",
                email: "",
                name: "",
                phone: "",
                position: "",

                repo: "",

                school: "",
                student_card: "",
            }
        },

        Save: function (event) {

            $('.editIt').modal('hide');

            //还原模板
            this.rowtemplate = {
                id: "",
                ticket_no: "",
                company: "",
                country: "",
                email: "",
                name: "",
                phone: "",
                position: "",

                repo: "",

                school: "",
                student_card: "",
            }
        },


        Delete: function (type, info, id, i) {

            type.splice(i, 1);

        },

        Edit: function (info) {

            this.isAdd = 0;

            $('.editIt').modal('show');

            //学生
            this.studenttemplate = info;

            //开发
            this.devtemplate = info;

            //早鸟，标准，免费
            this.rowtemplate = info;

        },
        Search: function (e) {


        },

        //上一页方法
        PrePage: function (type) {
            if (this.curpage !== 1) {
                this.curpage = this.curpage - 1
            }
        },

        //下一页方法
        NextPage: function (type) {

            if (this.curpage !== this.totalPage) {

                this.curpage = this.curpage + 1

            }


        },
        //点击页码的方法
        NumPage: function (num, event) {

            this.curpage = num;

        },

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

        //通过审核
        Pass: function (type, info, id) {
            // console.log(info)

            axios.post('pass', {
                id: id,
            })
                .then((response) => {

                    info.pass = 0;

                })
                .catch(function (error) {
                    console.log(error);
                });


        },
        //不通过审核
        Reject: function (type, info, id) {
            // console.log(info)

            axios.post('reject', {
                id: id,
            })
                .then((response) => {

                    info.pass = 2;

                })
                .catch(function (error) {
                    console.log(error);
                });


        },

        changePage: function () {

            let page = this.curpage - 1,
                type,
                api,
                baseUrl = '',
                dataStr;
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

            /*
             *  //结束
             */


        }

    },

    watch: {
        curpage: 'changePage',
    }
});





