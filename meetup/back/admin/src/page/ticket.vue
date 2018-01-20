<template>
  <div>
    <myHeader></myHeader>
    <!-- Page content -->
    <div id="content" class="col-md-12">
      <!-- page header -->
      <div class="pageheader">
        <h2><i class="fa fa-ticket" style="line-height: 48px;padding-left: 0;"></i> 票 </h2>
      </div>
      <!-- /page header -->
      <!-- content main container -->
      <div class="main">
        <!-- row -->
        <div class="row">
          <!-- col 12 -->
          <div class="col-md-12">
            <!-- tile -->
            <section class="tile transparent">
              <!-- tile header -->
              <div class="tile-header transparent">
                <h1><strong>普通票</strong> </h1>
                <div class="navbar tile color transparent pull-right">
                  <div class="search" id="main-search">
                    <input type="" placeholder="Search..." v-model="keyword">
                    <a type="button" @click="Search"><i class="fa fa-search"></i></a>
                  </div>
                </div>
              </div>
              <!-- /tile header -->
              <!-- tile body -->
              <div class="tile-body color transparent-white rounded-corners">
                <div class="table-responsive">
                  <table class="table table-datatable table-custom" id="inlineEditDataTable">
                    <thead>
                      <tr>
                        <th width="1%">No.</th>
                        <th width="1%">票号</th>
                        <th>姓名</th>
                        <th>国家</th>
                        <th>公司</th>
                        <th>职位</th>
                        <th>邮箱</th>
                        <th>电话</th>
                        <th>邮件状态</th>
                        <th>编辑</th>
                      </tr>
                    </thead>
                    <tbody>
                      <template v-for="(row, index) in tickets">
                        <tr class="odd grade">
                          <td>{{row.id}}</td>
                          <td>{{row.ticket_no}}</td>
                          <td>{{row.name}}</td>
                          <td>{{row.country}}</td>
                          <td>{{row.company}}</td>
                          <td>{{row.position}}</td>
                          <td class="emailTextRow">{{row.email}}</td>
                          <td>{{row.phone}}</td>
                          <td v-if="row.send == '0'">待发</td>
                          <td v-if="row.send == '1'">已发</td>
                          <td v-if="row.send == '2'">失败</td>
                          <td>
                            <a class="btn btn-primary btn-xs" @click="Edit(row)"><i class="fa fa-pencil"></i> Edit
                                                    </a>
                          </td>
                        </tr>
                      </template>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-4 sm-center">
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-right sm-center">
                      <div class="dataTables_paginate paging_bootstrap paging_custombootstrap">
                        <ul class="pagination pagination-xs pagination-custom">
                          <template v-for="page in totalPage">
                            <li class="prev" v-on:click="$utils.PrePage(tickets)" id="prepage" v-if="page==1" :class="{ 'disabled': curpage == 1 }">
                              <a>上一页</a>
                            </li>
                            <li v-if="page==1" v-on:click="$utils.NumPage(page, $event)" :class="{ 'active': page == curpage }"><a>{{page}}</a></li>
                            <li v-else v-on:click="$utils.NumPage(page, $event)" :class="{ 'active': page == curpage }"><a>{{page}}</a></li>
                            <li class="next" id="nextpage" v-on:click="$utils.NextPage(tickets)" v-if="page==totalPage" :class="{ 'disabled': curpage == Math.ceil(tickets.length / pagesize) }"><a>下一页</a></li>
                          </template>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /tile body -->
            </section>
            <!-- /tile -->
          </div>
          <!-- /col 12 -->
        </div>
        <!-- /row -->
      </div>
      <!-- /content container -->
    </div>
    <!-- Page content end -->
    <div class="modal fade editIt tile color transparent-black" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="myModalLabel">编辑</h2>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="country">国家</label>
                <input type="text" class="form-control" id="country" placeholder="" v-model="rowtemplate.country">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="company">公司</label>
                <input type="text" class="form-control" id="company" placeholder="" v-model="rowtemplate.company">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="position">职位</label>
                <input type="text" class="form-control" id="position" placeholder="" v-model="rowtemplate.position">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="email">邮箱</label>
                <input type="email" class="form-control" id="email" placeholder="" v-model="rowtemplate.email">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="phone">手机</label>
                <input type="text" class="form-control" id="phone" placeholder="" v-model="rowtemplate.phone">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="$utils.closeEdit()">关闭</button>
            <button type="button" class="btn btn-primary" @click="Save(tickets)">保存
            </button>
          </div>
        </div>
      </div>
    </div>
    <myFooter></myFooter>
  </div>
</template>
<script>
import myHeader from '../components/header.vue'
import myFooter from '../components/footer.vue'
let saveInfo, email, name, country, position, phone, company, note

export default {
  components: { myHeader, myFooter },
  data() {
    return {

      loading: 1, //一进入页面就显示loading

      //搜索
      keyword: '',
      isSearch: 0,
      searchPage: 1,

      rowtemplate: {
        id: '',
        ticket_no: '',
        company: "",
        country: "",
        email: "",
        name: "",
        phone: "",
        position: "",

        send: "0",
      },

      pagesize: 20,
      curpage: 0, //初始化页码
      totalPage: 1,

      tickets: [{
          id: '1',
          ticket_no: '8888',
          company: "link",
          country: "china",
          email: "1234567@qq.com",
          name: "JJJJJune",
          phone: "123457",
          position: "web",
          send: "0"
        },
        {
          id: '1',
          ticket_no: '8888',
          company: "link",
          country: "china",
          email: "1234567@qq.com",
          name: "JJJJJune",
          phone: "123457",
          position: "web",
          send: "0"
        },
        {
          id: '1',
          ticket_no: '8888',
          company: "link",
          country: "china",
          email: "1234567@qq.com",
          name: "JJJJJune",
          phone: "123457",
          position: "web",
          send: "0"
        }
      ]
    }
  },
  created() {
    this.getData()
    this.curpage = 1
  },
  methods: {
    getData() {
      let page = this.curpage -1
      this.$http.post('earlyTickeyList', {

                            page: page,
        // cp:cp,
        // ps:20
      })
      .then((response) =>{

        // this.tickets = r.data
        console.log('response', response)

      })

    

    },


    Edit: function(info) {

      $('.editIt').modal('show');

      saveInfo = info;

      //显示要编辑的信息
      this.rowtemplate = info;

    },


    Save: function(type) {
      this.loading = 1;

      $('.editIt').modal('hide');

      email = this.rowtemplate.email;
      name = this.rowtemplate.name;
      country = this.rowtemplate.country;
      position = this.rowtemplate.position;
      phone = this.rowtemplate.phone;
      company = this.rowtemplate.company;
      note = this.rowtemplate.note;

      //保存编辑的信息
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

            send: "0",
          }

        })
        .catch(function(error) {
          console.log(error);
        });

    },

    Search: function(e) {

      var keyword = this.keyword,
        page = this.curpage - 1;

      if (window.location.pathname == '/preview/admin/production/checkin.html') {
        axios.post('searchCheckTicket', {
            select: keyword,
            page: page
          })
          .then((response) => {
            var dataStr = response.data.data;
            this.loading = 0;
            this.checkInList = dataStr.ticket_list;
            this.totalPage = dataStr.total_page;
          })
          .catch(function(error) {
            console.log(error);
          });
      }

    },


  }
}

</script>
