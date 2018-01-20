export default {

    /*
     * 表格
     */
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

    /*
     * 表格end
     */


    /*
     * 修改
     */


    closeEdit: function () {

        $('.editIt').modal('hide');

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

            send: "0",
        }

    },

    /*
     * 修改end
     */

    /*
     * 删除
     */
    Delete: function (type, info, id, i) {
        this.loading = 1;

        var DeleteUrl;

        //可以删除所有票种，但是现在前端显示只能删除免费票
        if (window.location.pathname == '/preview/admin/production/free_ticket.html') {

            DeleteUrl = 'DeleteTicket'
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


}
