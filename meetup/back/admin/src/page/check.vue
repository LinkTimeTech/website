<template>
  <div>
    <myHeader></myHeader>
    <!-- Page content -->
    <div id="content" class="col-md-12">
      <!-- page header -->
      <div class="pageheader">
        <!-- <h2><i class="fa fa-ticket" style="line-height: 48px;padding-left: 0;"></i> 票 </h2> -->
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
                <h1><strong>签到</strong> </h1>
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
                总人数：{{totalTicketsNum}}
                <br> 签到数：{{totalCheckNum}}
                <div class="table-responsive">
                  <table class="table table-datatable table-custom" id="inlineEditDataTable">
                    <thead>
                      <tr>
                        <th width="1%">No.</th>
                        <th width="1%">票号</th>
                        <th>姓名</th>
                        <th>公司</th>
                        <th>邮箱</th>
                        <th>电话</th>
                        <th>时间</th>
                        <th>签到状态</th>
                      </tr>
                    </thead>
                    <tbody>
                      <template v-for="(row, index) in tickets">
                        <tr class="odd grade">
                          <td>{{row.id}}</td>
                          <td>{{row.ticket_no}}</td>
                          <td>{{row.name}}</td>
                          <td>{{row.company}}</td>
                          <td class="emailTextRow">{{row.email}}</td>
                          <td>{{row.phone}}</td>
                          <td>{{row.time}}</td>
                          <td v-if="row.checkin == '0'">成功</td>
                          <td v-if="row.checkin == '1'">失败</td>
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

      totalTicketsNum: 100,
      totalCheckNum: 10,

      loading: 1, //一进入页面就显示loading

      //搜索
      keyword: '',
      isSearch: 0,
      searchPage: 1,

      pagesize: 2,
      curpage: 0, //初始化页码
      totalPage: 1,

      tickets: [{
          id: '1',
          ticket_no: '8888',
          company: "link",
          email: "1234567@qq.com",
          name: "JJune",
          phone: "123457",
          time: '2018-01-01',
          checkin: "0"
        },
        {
          id: '2',
          ticket_no: '8888',
          company: "link",
          email: "1234567@qq.com",
          name: "JJne",
          phone: "123457",
          time: '2018-01-01',

          checkin: "0"
        },
        {
          id: '3',
          ticket_no: '8888',
          company: "link",
          email: "1234567@qq.com",
          name: "JJnnne",
          phone: "123457",
          time: '2018-01-01',

          checkin: "0"
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


    },

    Search: function(e) {
      this.isSearch = 1;
      this.searchPage = 1;

      var keyword = this.keyword,
        page = this.searchPage - 1;

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
          .catch(function(error) {
            console.log(error);
          });
      }

    },


  }
}

</script>
