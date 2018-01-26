<template>
  <div>
    <!-- Preloader -->
    <div class="mask" v-if="loading==1">
      <div id="loader"></div>
    </div>
    <!--/Preloader -->
    <myHeader></myHeader>
    <!-- Page content -->
    <div id="content" class="col-md-12">
      <!-- page header -->
      <div class="pageheader">
        <h2><i class="fa fa-ticket" style="line-height: 48px;padding-left: 0;"></i> 门票 </h2>
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
              <!-- tile widget -->
              <div class="tile-widget nopadding color transparent-black rounded-top-corners">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#paylist" aria-controls="paylist" role="tab" data-toggle="tab" @click="goPayList()">普通票</a></li>
                  <li role="presentation"><a href="#freelist" aria-controls="freelist" role="tab" data-toggle="tab" @click="goFreeList()">赠票</a></li>
                </ul>
                <!-- / Nav tabs -->
              </div>
              <!-- /tile widget -->
              <div class="tab-content">
                <!-- tile body -->
                <div class="tile-body color transparent-white rounded-corners tab-pane active" role="tabpanel" id="paylist">
                  <div class="table-responsive">
                    <button type="button" class="btn btn-primary" @click="goAdd()">添加</button>
                    <div class="search" id="main-search">
                      <input type="" placeholder="Search..." v-model="keyword">
                      <a type="button" @click="Search"><i class="fa fa-search"></i></a>
                    </div>
                    <table class="table table-datatable table-custom" id="inlineEditDataTable">
                      <thead>
                        <tr>
                          <th width="1%">票号</th>
                          <th>姓名</th>
                          <th>国家</th>
                          <th>公司</th>
                          <th>职位</th>
                          <th>邮箱</th>
                          <th>电话</th>
                          <th>备注</th>
                          <th>邮件状态</th>
                          <th>邮件</th>
                          <th>编辑</th>
                        </tr>
                      </thead>
                      <tbody>
                        <template v-for="(row, index) in list">
                          <tr class="odd grade">
                            <td>{{row.chargesId}}</td>
                            <td>{{row.name}}</td>
                            <td>{{row.country}}</td>
                            <td>{{row.company}}</td>
                            <td>{{row.position}}</td>
                            <td class="emailTextRow">{{row.email}}</td>
                            <td>{{row.telephone}}</td>
                            <td>{{row.note}}</td>
                            <td v-if="row.issendmail == '0'">待发</td>
                            <td v-if="row.issendmail == '1'">已发</td>
                            <td v-if="row.issendmail == '2'">失败</td>
                            <td>
                              <button type="button" class="btn btn-info btn-xs" @click="Pass(list,row,row.chargesId)" v-if="row.issendmail == '0'">发送
                              </button>
                              <button type="button" class="btn btn-success btn-xs" v-if="row.issendmail == '1' ">已发送
                              </button>
                            </td>
                            <td>
                              <a class="btn btn-primary btn-xs" @click="Edit(row)"><i class="fa fa-pencil"></i> 编辑
                                                    </a>
                              <a class="btn btn-danger btn-xs" v-if="row.issendmail != 1" @click="Delete(list,row,row.chargesId,index)">
                                <i class="fa fa-trash-o" ></i> 删除 </a>
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
                <!-- tile body -->
                <div class="tile-body color transparent-white rounded-corners tab-pane" role="tabpanel" id="freelist">
                  <div class="table-responsive">
                    <button type="button" class="btn btn-primary" @click="goAddFree()">添加赠票</button>
                    <div class="search" id="main-search">
                      <input type="" placeholder="Search..." v-model="keyword">
                      <a type="button" @click="SearchFreeTicket"><i class="fa fa-search"></i></a>
                    </div>
                    <table class="table table-datatable table-custom" id="inlineEditDataTable">
                      <thead>
                        <tr>
                          <th width="1%">票号</th>
                          <th>姓名</th>
                          <th>国家</th>
                          <th>公司</th>
                          <th>职位</th>
                          <th>邮箱</th>
                          <th>电话</th>
                          <th>备注</th>
                          <th>邮件状态</th>
                          <th>邮件</th>
                          <th>编辑</th>
                        </tr>
                      </thead>
                      <tbody>
                        <template v-for="(row, index) in freelist">
                          <tr class="odd grade">
                            <td>{{row.chargesId}}</td>
                            <td>{{row.name}}</td>
                            <td>{{row.country}}</td>
                            <td>{{row.company}}</td>
                            <td>{{row.position}}</td>
                            <td class="emailTextRow">{{row.email}}</td>
                            <td>{{row.telephone}}</td>
                            <td>{{row.note}}</td>
                            <td v-if="row.issendmail == '0'">待发</td>
                            <td v-if="row.issendmail == '1'">已发</td>
                            <td v-if="row.issendmail == '2'">失败</td>
                            <td>
                              <button type="button" class="btn btn-info btn-xs" @click="Pass(freelist,row,row.chargesId)" v-if="row.issendmail == '0'">发送
                              </button>
                              <button type="button" class="btn btn-success btn-xs" v-if="row.issendmail == '1' ">已发送
                              </button>
                            </td>
                            <td>
                              <a class="btn btn-primary btn-xs" @click="Edit(row)"><i class="fa fa-pencil"></i> 编辑
                                                    </a>
                              <a class="btn btn-danger btn-xs" v-if="row.issendmail != 1" @click="Delete(freelist,row,row.chargesId,index)"><i
                                                            class="fa fa-trash-o"></i>
                                                        删除 </a>
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
                            <template v-for="page in totalFreePage">
                              <li class="prev" v-on:click="PrePage(freelist)" id="prepage" v-if="page==1" :class="{ 'disabled': curFreePage == 1 }">
                                <a>上一页</a>
                              </li>
                              <li v-if="page==1" v-on:click="NumPage(page, $event)" :class="{ 'active': page == curFreePage }"><a>{{page}}</a></li>
                              <li v-else v-on:click="NumPage(page, $event)" :class="{ 'active': page == curFreePage }"><a>{{page}}</a></li>
                              <li class="next" id="nextpage" v-on:click="NextPage(freelist)" v-if="page==totalFreePage" :class="{ 'disabled': curFreePage == totalFreePage }"><a>下一页</a></li>
                            </template>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /tile body -->
              </div>
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
            <div class="row" v-if="isAdd==1">
              <div class="col-md-12">
                <label>邮件语言</label>
              </div>
              <div class="col-md-12">
                <span class="col-sm-6">
                  <label>
                      <input type="radio" class="" checked="checked" name="lang" value="cn"
                             v-model="rowtemplate.lang"> 中文
                  </label>
                  </span>
                <span class="col-sm-6">
                    <label>
                        <input type="radio" class="" name="lang" value="en" v-model="rowtemplate.lang"> 英语
                    </label>
                </span>
              </div>
            </div>
            <div class="row" v-if="isAdd==1">
              <div class="form-group col-sm-12">
                <label for="name">姓名</label>
                <input type="text" class="form-control" id="name" placeholder="" v-model="rowtemplate.name">
              </div>
            </div>
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
                <label for="telephone">手机</label>
                <input type="text" class="form-control" id="telephone" placeholder="" v-model="rowtemplate.telephone">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="note">备注</label>
                <textarea class="form-control" rows="5" placeholder='' id="note" v-model="rowtemplate.note"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="closeEdit()">关闭</button>
            <button type="button" class="btn btn-primary" @click="Add(list)" v-if="isAdd==1&& addFree ==0">添加
            </button>
            <button type="button" class="btn btn-primary" @click="Add(freelist)" v-if="isAdd==1 && addFree ==1">添加赠票
            </button>
            <button type="button" class="btn btn-primary" @click="Save(list)" v-if="isAdd==0">保存
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

let saveInfo, email, name, country, position, telephone, company, note, lang, price
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

      //当前显示的是付费表
      isPaylist: 1,
      isFreeList: 0,

      //付费票数据
      curpage: 0, //初始化页码
      totalPage: 1,
      list: [],

      //免费票数据
      curFreePage: 0, //初始化页码
      totalFreePage: 1,
      freelist: [],

      isAdd: 0, //判断是否添加
      addFree: 0, //判断是否添加免费票

      rowtemplate: {
        chargesId: "",
        company: "",
        country: "",
        email: "",
        name: "",
        telephone: "",
        position: "",
        note: "",
        lang: "",

        issendmail: "0",
      },

    }
  },
  created() {
    this.curpage = 1
    this.curFreePage = 1

  },
  methods: {

    goPayList: function() {
      this.isPaylist = 1
      this.isFreeList = 0

    },


    goFreeList: function() {
      this.isPaylist = 0
      this.isFreeList = 1
    },


    goAdd: function(e) {
      $('.editIt').modal('show');
      this.isAdd = 1
      this.addFree = 0

    },


    goAddFree: function(e) {
      $('.editIt').modal('show');
      this.isAdd = 1
      this.addFree = 1
    },


    Add: function(type) {
      var vm = this;
      this.loading = 1;

      $('.editIt').modal('hide');

      this.addFree == 0 ? price = 3500 : price = 0

      email = this.rowtemplate.email;
      name = this.rowtemplate.name;
      country = this.rowtemplate.country;
      position = this.rowtemplate.position;
      telephone = this.rowtemplate.telephone;
      company = this.rowtemplate.company;
      note = this.rowtemplate.note;
      lang = this.rowtemplate.lang;

      if (email == '' || name == '' || lang == '' || telephone == '') {
        this.loading = 0;

        alert('请选择邮件语言，填写好基本信息后再进行添加')

      } else {
        this.$http.post('/manager/giveTicket',
            Qs.stringify({
              email: email,
              name: name,
              country: country,
              company: company,
              position: position,
              telephone: telephone,
              lang: lang,
              chargesRental: price
            }))
          .then((response) => {
            console.log(response)
            this.loading = 0;
            this.rowtemplate.chargesId = response.data.chargesid;

            type.push(this.rowtemplate);
            // 还原模板
            this.rowtemplate = {
              chargesId: "",
              company: "",
              country: "",
              email: "",
              name: "",
              telephone: "",
              position: "",
              note: "",
              lang: "",

              issendmail: "0",
            }

          })
          .catch(function(error) {
            this.loading = 0;
            alert('出错了，请联系管理员解决')
            console.log(error);
          });
      }

    },

    /*
     * 表格
     */
    //上一页方法
    PrePage: function(type) {

      if (this.isSearch == 1) {

        this.searchPage !== 1 ? this.searchPage = this.searchPage - 1 : ''

      } else {

        this.isPaylist == 1 && this.curpage !== 1 ? this.curpage = this.curpage - 1 : ''
        this.isFreeList == 1 && this.curFreePage !== 1 ? this.curFreePage = this.curFreePage - 1 : ''

      }

    },


    //下一页方法
    NextPage: function(type) {

      console.log('isSearch', this.isSearch)
      console.log('searchPage', this.searchPage)
      console.log('totalPage', this.totalPage)
      console.log('totalFreePage', this.totalFreePage)
      console.log('isPaylist', this.isPaylist)
      console.log('isFreeList', this.isFreeList)
      console.log('curpage', this.curpage)
      console.log('curFreePage', this.curFreePage)

      this.isPaylist == 1 && this.curpage !== this.totalPage ? this.curpage = this.curpage + 1 : ''
      this.isFreeList == 1 && this.curFreePage !== this.totalFreePage ? this.curFreePage = this.curFreePage + 1 : ''

      // if (this.isSearch == 1) {

      //   this.searchPage !== this.totalPage ? this.searchPage = this.searchPage + 1 : ''
      //   this.searchPage !== this.totalFreePage ? this.searchPage = this.searchPage + 1 : ''

      // } else {

      //   this.isPaylist == 1 && this.curpage !== this.totalPage ? this.curpage = this.curpage + 1 : ''
      //   this.isFreeList == 1 && this.curFreePage !== this.totalFreePage ? this.curFreePage = this.curFreePage + 1 : ''

      // }

    },


    //点击页码的方法
    NumPage: function(num, event) {

      if (this.isSearch == 1) {

        this.isPaylist == 1 ? this.searchPage = num : ''
        this.isFreeList == 1 ? this.searchPage = num : ''

      } else {

        this.isPaylist == 1 ? this.curpage = num : ''
        this.isFreeList == 1 ? this.curFreePage = num : ''

      }

    },


    //编辑
    Edit: function(info) {
      this.isAdd = 0

      $('.editIt').modal('show');

      saveInfo = info;

      //显示要编辑的信息
      this.rowtemplate = info;

    },

    Delete: function(type, info, id, i) {
      this.loading = 1;

      this.$http.post('charges/deleteCharge', Qs.stringify({

          chargesId: id,

        }))
        .then((response) => {
          this.loading = 0;
          response.data.state == 0 ? type.splice(i, 1) : ''

        })
        .catch(function(error) {
          console.log(error);
        });
    },

    //保存修改的信息
    Save: function(type) {
      this.loading = 1;

      email = this.rowtemplate.email;
      name = this.rowtemplate.name;
      country = this.rowtemplate.country;
      position = this.rowtemplate.position;
      telephone = this.rowtemplate.telephone;
      company = this.rowtemplate.company;
      note = this.rowtemplate.note;

      //保存编辑的信息
      this.$http.post('manager/updateInfo', Qs.stringify({
          chargesId: saveInfo.chargesId,
          email: email,
          country: country,
          position: position,
          telephone: telephone,
          company: company,
          note: note
        }))
        .then((response) => {
          this.loading = 0;

          $('.editIt').modal('hide');
          this.isAdd = 0

          //还原模板
          this.rowtemplate = {
            chargesId: "",
            company: "",
            country: "",
            email: "",
            name: "",
            telephone: "",
            position: "",
            note: "",
            lang: "",

            issendmail: "0",
          }

        })
        .catch(function(error) {
          this.loading = 0;

          console.log(error);
        });

    },

    //关闭修改信息的窗口
    closeEdit: function() {

      $('.editIt').modal('hide');

      // 还原模板
      this.rowtemplate = {
        chargesId: "",
        company: "",
        country: "",
        email: "",
        name: "",
        telephone: "",
        position: "",
        note: "",
        lang: "",

        issendmail: "0",
      }

    },

    Pass: function(type, info, id) {
      info.issendmail = 1;

      this.$http.post('charges/sendMailZP', Qs.stringify({
          lang: info.lang,
          chargesId: id
        }))
        .then((response) => {
          // console.log(response.data.state);

        })
        .catch(function(error) {
          alert('邮件发送失败，请联系管理员')
          console.log(error);
        });

    },


    //搜索普通票
    Search: function(e) {
      this.isSearch = 1

      var keyword = this.keyword,
        page = this.searchPage,
        ps = this.pagesize;

      this.$http.post('charges/pageSpilt1', Qs.stringify({
          select: keyword,
          cp: page,
          ps: 5

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

    //搜索赠票
    SearchFreeTicket: function(e) {
      this.isSearch = 1

      var keyword = this.keyword,
        page = this.searchPage,
        ps = this.pagesize;

      this.$http.post('charges/pageSpiltZP', Qs.stringify({
          select: keyword,
          cp: page,
          ps: ps

        }))
        .then((response) => {
          console.log('SearchResponse', response)
          this.loading = 0;
          this.freelist = response.data.list
          this.totalFreePage = response.data.allPage
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
      this.$http.post('charges/pageSpilt1', Qs.stringify({
          cp: page,
          ps: ps
        }))
        .then((response) => {
          this.loading = 0;
          this.list = response.data.list
          this.totalPage = response.data.allPage

        })

    },
    changeFreePage: function() {
      let page = this.curFreePage - 1,
        ps = this.pagesize
      this.$http.post('charges/pageSpiltZP', Qs.stringify({
          cp: page,
          ps: ps
        }))
        .then((response) => {
          this.loading = 0;
          this.freelist = response.data.list
          this.totalFreePage = response.data.allPage

        })

    },

  },
  watch: {
    curpage: 'changePage', //监测付费票表页码的变化, 换页
    curFreePage: 'changeFreePage', //监测免费票表页码的变化, 换页
    searchPage: 'Search', //监测搜索的页码的变化, 换页

    // loading: 'getRemind',//监测loading的变化
    // isCheckList: 'checkList'//
  }
}

</script>
