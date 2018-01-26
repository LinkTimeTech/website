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
                总人数：{{totalNum}}
                <br> 签到数：{{totalCheckNum}}
                <div class="table-responsive">
                  <table class="table table-datatable table-custom" id="inlineEditDataTable">
                    <thead>
                      <tr>
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
                      <template v-for="(row, index) in list">
                        <tr class="odd grade">
                          <td>{{row.chargesId}}</td>
                          <td>{{row.name}}</td>
                          <td>{{row.company}}</td>
                          <td class="emailTextRow">{{row.email}}</td>
                          <td>{{row.telephone}}</td>
                          <td>{{row.signTime}}</td>
                          <td v-if="row.chargesState == '1'">成功</td>
                          <td v-if="row.chargesState == '2'">失败</td>
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
                            <li class="prev" v-on:click="PrePage(list)" id="prepage" v-if="page==1" :class="{ 'disabled': curpage == 1 }">
                              <a>上一页</a>
                            </li>
                            <li v-if="page==1" v-on:click="NumPage(page, $event)" :class="{ 'active': page == curpage }"><a>{{page}}</a></li>
                            <li v-else v-on:click="NumPage(page, $event)" :class="{ 'active': page == curpage }"><a>{{page}}</a></li>
                            <li class="next" id="nextpage" v-on:click="NextPage(list)" v-if="page==totalPage" :class="{ 'disabled': curpage == totalPage }"><a>下一页</a></li>
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

let saveInfo, email, name, country, position, telephone, company, note
var Qs = require('qs');

export default {
  components: { myHeader, myFooter },
  data() {
    return {

      loading: 1, //一进入页面就显示loading

      //搜索
      keyword: '',
      isSearch: 0,
      searchPage: 0,

      pagesize: 20,

      //签到列表数据
      curpage: 0, //初始化页码
      totalPage: 1,
      list: [],
      totalNum: 0,
      totalCheckNum: 0,

    }
  },
  created() {
    this.curpage = 1;
    this.getNum();

  },
  methods: {

    getNum() {

      this.$http.get('manager/accountQD')
        .then((response) => {
          this.totalNum = response.data.allCount
          this.totalCheckNum = response.data.countQD
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    /*
     * 表格
     */
    //上一页方法
    PrePage: function(type) {

      if (this.isSearch == 1) {

        this.searchPage !== 1 ? this.searchPage = this.searchPage - 1 : ''

      } else {

        this.curpage !== 1 ? this.curpage = this.curpage - 1 : ''

      }

    },


    //下一页方法
    NextPage: function(type) {

      if (this.isSearch == 1) {

        this.searchPage !== this.totalPage ? this.searchPage = this.searchPage + 1 : ''

      } else {

        this.curpage !== this.totalPage ? this.curpage = this.curpage + 1 : ''

      }

    },


    //点击页码的方法
    NumPage: function(num, event) {

      if (this.isSearch == 1) {
        this.searchPage = num

      } else {
        this.curpage = num

      }

    },

    //搜索
    Search: function(e) {
      this.isSearch = 1

      var keyword = this.keyword,
        page = this.searchPage,
        ps = this.pagesize;

      this.$http.post('manager/pageSpiltQD', Qs.stringify({
          select: keyword,
          cp: page,
          ps: ps

        }))
        .then((response) => {
          console.log('SearchResponse', response)
          this.loading = 0;
          this.list = response.data.list
          this.totalPage = response.data.allPage
        })
        .catch(function(error) {
          console.log(error);
        });

    },

    /*
     * 表格end
     */


    changePage: function() {
      let page = this.curpage - 1,
        ps = this.pagesize
      this.$http.post('manager/pageSpiltQD', Qs.stringify({
          cp: page,
          ps: ps
        }))
        .then((response) => {
          this.loading = 0;
          this.list = response.data.list
          this.totalPage = response.data.allPage

        })

    },


  },
  watch: {
    curpage: 'changePage', //监测付费票表页码的变化, 换页
    searchPage: 'Search', //监测搜索的页码的变化, 换页

    // loading: 'getRemind',//监测loading的变化
  }
}

</script>
