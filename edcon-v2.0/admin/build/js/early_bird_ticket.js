var data = {
    rows: [
        {
            Id: 1,
            Name: 'Pesamakini Backend UI',
            Country: 'China',
            Company: 'Linktime',
            Title: 'Web',
            Email: '411097971@qq.com',
            Phone: '1234456743',
            pass: '0',
            reject: '0'
        },
        {
            Id: 2,
            Name: 'Pesamakini Backend UI',
            Country: 'China',
            Company: 'Linktime',
            Title: 'Web',
            Email: '411097971@qq.com',
            Phone: '1234456743',
            pass: '0',
            reject: '0'
        },
        {
            Id: 3,
            Name: 'Pesamakini Backend UI',
            Country: 'China',
            Company: 'Linktime',
            Title: 'Web',
            Email: '411097971@qq.com',
            Phone: '1234456743',
            pass: '0',
            reject: '0'
        },
        {
            Id: 4,
            Name: 'Pesamakini Backend UI',
            Country: 'China',
            Company: 'Linktime',
            Title: 'Web',
            Email: '411097971@qq.com',
            Phone: '1234456743',
            pass: '0',
            reject: '0'
        },

    ],
    rowtemplate: {Id: '', Name: '', Country: '', Company: '', Title: '', Email: '', Phone: '', School: '', Card: ''},
    pagesize: 20,
    curpage: 1, //当前页的页码

    isAdd: 0 //初始化Add按钮

};
//ViewModel
var vue = new Vue({
    el: '#app',
    data: data,
    methods: {
        goAdd: function (e) {
            $('.editIt').modal('show');

            this.isAdd = 1

        },

        Add: function (event) {


            if (this.rowtemplate.id != '' && this.rowtemplate.name != '' && this.rowtemplate.country != '' && this.rowtemplate.company != '' && this.rowtemplate.position != '' && this.rowtemplate.email != '' && this.rowtemplate.phone != '' && this.rowtemplate.note != '') {

                if (this.rowtemplate.id == '') {
                    //设置当前新增行的Id
                    this.rowtemplate.id = this.rows.length + 1;
                }

                this.rows.push(this.rowtemplate);

                $('.editIt').modal('hide');

                //还原模板
                this.rowtemplate = {
                    Id: '', Name: '', Country: '', Company: '', Title: '', Email: '', Phone: '', School: '', Card: ''
                }

            }


        },

        closeEdit: function () {

            $('.editIt').modal('hide');

            //还原模板
            this.rowtemplate = {
                Id: '', Name: '', Country: '', Company: '', Title: '', Email: '', Phone: '', School: '', Card: ''
            }
        },
        Save: function (event) {

            $('.editIt').modal('hide');

            //还原模板
            this.rowtemplate = {
                Id: '', Name: '', Country: '', Company: '', Title: '', Email: '', Phone: '', School: '', Card: ''
            }
        },

        Delete: function (id) {
            //实际项目中参数操作肯定会涉及到id去后台删除，这里只是展示，先这么处理。
            for (var i = 0; i < this.rows.length; i++) {
                if (this.rows[i].Id == id) {
                    this.rows.splice(i, 1);
                    break;
                }
            }
        },
        Edit: function (row) {

            this.isAdd = 0;

            $('.editIt').modal('show');
            this.rowtemplate = row;
        },
        Search: function (e) {


        },
        //上一页方法
        PrePage: function (event) {
            if (this.curpage !== 1) {
                this.curpage = this.curpage - 1
            }
        },
        //下一页方法
        NextPage: function (event) {
            if (this.curpage !== Math.ceil(this.rows.length / this.agesize)) {
                this.curpage = this.curpage + 1
            }

        },
        //点击页码的方法
        NumPage: function (num, event) {

            this.curpage = num;

        },
        //通过审核
        Pass: function (list, info, id) {
            console.log(info);
            var len = list.length;
//实际项目中参数操作肯定会涉及到id去后台删除，这里只是展示，先这么处理。
            for (var i = 0; i < len; i++) {
                if (this.rows[i].Id == id) {
                    this.rows[i].pass = 1;
                    this.rows[i].reject = 2;
                }
            }
        },
        //不通过审核
        Reject: function (list, info, id) {
            console.log(info);
            var len = list.length;
            for (var i = 0; i < len; i++) {
                if (this.rows[i].Id == id) {
                    this.rows[i].pass = 2;
                    this.rows[i].reject = 1;

                }
            }
        }
    }
});