<template>
  <div>
    <!-- Page content -->
    <div id="content" class="col-md-12 full-page login">
      <div class="inside-block">
        <!-- <img src="assets/images/logo-big.png" alt class="logo"> -->
        <h1><strong>Welcome</strong> Admin</h1>
        <form id="form-signin" class="form-signin">
          <section>
            <div class="input-group">
              <input type="text" class="form-control" name="username" placeholder="Username" v-model="Username" required="">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
            </div>
            <div class="input-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="" v-model="Password">
              <div class="input-group-addon"><i class="fa fa-key"></i></div>
            </div>
          </section>
          <section class="controls">
            <!--  <div class="checkbox check-transparent">
                  <input type="checkbox" value="1" id="remember" checked>
                  <label for="remember">Remember me</label>
                </div> -->
          </section>
          <section class="log-in">
            <button class="btn btn-greensea" @click="login">Log In</button>
          </section>
        </form>
      </div>
    </div>
    <!-- /Page content -->
  </div>
</template>
<script>
var Qs = require('qs');

export default {
  data() {
    return {
      Username: '',
      Password: ''
    }
  },
  created() {

  },
  methods: {

    login: function() {
      event.preventDefault()

      var username = this.Username,
        password = this.Password;

      this.$http.post('manager/login',
          Qs.stringify({
            loginname: username,
            loginpsw: password
          }))
        .then((response) => {

          response.data.state == 0 ? this.$router.push({ path: '/' }) : alert('登陆失败，请检查用户名或密码后再试');

        })

    },


  }
}

</script>
