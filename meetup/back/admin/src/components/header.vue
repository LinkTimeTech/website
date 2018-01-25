<template>
  <div>
    <header class="header">
      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">
        <!-- Branding -->
        <div class="navbar-header col-md-2">
          <a class="navbar-brand" href="index.html">
              <strong>Meetup</strong>
            </a>
          <div class="sidebar-collapse">
            <a href="#">
                <i class="fa fa-bars"></i>
              </a>
          </div>
        </div>
        <!-- Branding end -->
        <!-- .nav-collapse -->
        <div class="navbar-collapse">
          <!-- Quick Actions -->
          <ul class="nav navbar-nav quick-actions">
            <li class="dropdown divided user" id="current-user">
              <!-- <div class="profile-photo">
                  <img src="static/image/profile-photo.jpg" alt />
                </div> -->
              <a class="dropdown-toggle options" data-toggle="dropdown">
                  管理员 <i class="fa fa-caret-down"></i>
                </a>
              <ul class="dropdown-menu arrow settings">
                <li>
                  <a data-toggle="modal" data-target="#changethepass"><i class="fa fa-user"></i> 修改密码</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a @click="signout()"><i class="fa fa-power-off"></i> 退出</a>
                </li>
              </ul>
            </li>
          </ul>
          <!-- /Quick Actions -->
          <!-- Sidebar -->
          <ul class="nav navbar-nav side-nav" id="sidebar">
            <li class="collapsed-content">
              <ul>
                <li class="search">
                  <!-- Collapsed search pasting here at 768px -->
                </li>
              </ul>
            </li>
            <li class="navigation" id="navigation">
              <a href="#" class="sidebar-toggle" data-toggle="#navigation">菜单 <i class="fa fa-angle-up"></i></a>
              <ul class="menu">
                <li>
                  <a href="index.html">
                      <i class="fa fa-home"></i> 首页
                      <!-- <span class="badge badge-red">1</span> -->
                    </a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-tag"></i> 门票 <b class="fa fa-plus dropdown-plus"></b>
                    </a>
                  <ul class="dropdown-menu">
                    <li>
                      <router-link :to="'ticket'"><i class="fa fa-caret-right"></i> 门票</router-link>
                    </li>
                    <!--  <li>
                      <router-link :to="'delivery'"><i class="fa fa-caret-right"></i> 免费</router-link>
                    </li> -->
                    <li>
                      <router-link :to="'payfail'"><i class="fa fa-caret-right"></i> 失败</router-link>
                    </li>
                  </ul>
                </li>
                <li>
                  <router-link :to="'check'"><i class="fa fa-th"></i> 签到</router-link>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-list"></i> 编辑 <b class="fa fa-plus dropdown-plus"></b>
                    </a>
                  <ul class="dropdown-menu">
                    <!-- <li>
                      <a href="#">
                          <i class="fa fa-pencil-square-o"></i> 关于
                        </a>
                    </li>
                    <li>
                      <a href="#">
                          <i class="fa fa-pencil-square-o"></i> 时间
                        </a>
                    </li> -->
                    <li>
                      <router-link :to="'schedule'"><i class="fa fa-pencil-square-o"></i> 行程</router-link>
                    </li>
                    <li>
                      <router-link :to="'email'"><i class="fa fa-pencil-square-o"></i> 邮件</router-link>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
          <!-- Sidebar end -->
        </div>
        <!--/.nav-collapse -->
      </div>
      <!-- Fixed navbar end -->
    </header>
    <div class="modal fade" id="changethepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">修改密码</h4></div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="oldPass">旧密码</label>
                <input type="password" class="form-control" id="oldPass" placeholder="" v-model="oldPassword">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="newPass">新密码</label>
                <input type="password" class="form-control" id="newPass" placeholder="" v-model="newPassword">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary" @click="changePassword()" data-dismiss="modal">确认
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      oldPassword: '',
      newPassword: ''
    }
  },
  created() {

  },
  mounted() {

  },
  methods: {
    signout: function() {

      this.$http.post('manager/logout', {})
        .then((response) => {
          response.data.state == 0 ? this.$router.push({ path: '/login' }) : alert('退出失败，请重试');
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    changePassword() {

      var newPassword = this.newPassword,
        oldPassword = this.oldPassword;

      this.$http.post('manager/updatePWD', Qs.stringify({
          oldPWD: oldPassword,
          newPWD: newPassword
        }))
        .then((response) => {

          console.log(response);

          if (response.data.state == 0) {

            alert('密码已修改, 请重新登录');
            this.newPassword = '';
            this.oldPassword = '';
            this.$router.push({ path: '/login' });

          } else if (response.data.state == 1) {
            alert('旧密码错误')

          }
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }


}

</script>
