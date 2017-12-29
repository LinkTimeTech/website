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
            School: 'School name',
            Card: 'images/user.png',
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
            School: 'School name',
            Card: 'images/user.png',
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
            School: 'School name',
            Card: 'images/user.png',
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
            Repo: 'RepoRepoRepoRepoRepoRepoRepoRepoRepo',
            pass: '0',
            reject: '0'
        },

    ],
    rowtemplate: {Id: '', Name: '', Country: '', Company: '', Title: '', Email: '', Phone: '', School: '', Card: ''},
    pagesize: 20,
    curpage: 1 //当前页的页码
};
//ViewModel
var vue = new Vue({
    el: '#app',
    data: data,
    methods: {
        Save: function (event) {
            if (this.rowtemplate.id == 0) {
                //设置当前新增行的Id
                this.rowtemplate.id = this.rows.length + 1;
                this.rows.push(this.rowtemplate);
            }

            //还原模板
            this.rowtemplate = {
                Id: '',
                Name: '',
                Country: '',
                Company: '',
                Title: '',
                Email: '',
                Phone: '',
                School: '',
                Card: ''
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
            this.rowtemplate = row;
        },
        Search: function (e) {
            var v = e.target.value,
                self = this;
            self.searchlist = [];
            if (v) {
                var ss = [];

                // 过滤需要的数据
                this.list.forEach(function (item) {
                    // 检测用户名
                    if (item.username.indexOf(v) > -1) {
                        if (self.searchlist.indexOf(item.username) == -1) {
                            self.searchlist.push(item.username);
                        }
                        ss.push(item);
                    } else if (item.email.indexOf(v) > -1) {
                        // 检测邮箱
                        if (self.searchlist.indexOf(item.email) == -1) {
                            self.searchlist.push(item.email);
                        }
                        ss.push(item);
                    }
                });
                this.setSlist(ss); // 将过滤后的数据给了slist
            } else {
                // 没有搜索内容，则展示全部数据
                this.setSlist(this.list);
            }
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