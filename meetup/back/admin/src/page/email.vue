<template>
  <div>
    <myHeader></myHeader>
    <!-- Page content -->
    <div id="content" class="col-md-12">
      <!-- page header -->
      <div class="pageheader">
        <h2><i class="fa fa-pencil-square-o" style="line-height: 48px;padding-left: 0;"></i> 编辑</h2>
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
                <h1><strong>编辑邮件内容</strong> </h1>
              </div>
              <!-- /tile header -->
              <!-- tile body -->
              <div class="tile-body color transparent-white rounded-corners">
                <div class="margin-bottom-20">
                  <div class="margin-bottom-20">
                    <button type="button" class="btn btn-primary">购票</button>
                    <button type="button" class="btn btn-primary">购票(英)</button>
                    <button type="button" class="btn btn-success">赠票</button>
                    <button type="button" class="btn btn-success">赠票(英)</button>
                  </div>
                  <div class="row">
                    <div class="form-group col-sm-12">
                      <label for="name">标题</label>
                      <input type="text" class="form-control" id="name" placeholder="" v-model="subject">
                    </div>
                  </div>
                </div>
                <div class="margin-bottom-20">
                  <Uediter :value="ueditor.value" :config="ueditor.config" ref="ue"></Uediter>
                </div>
                <button class="btn btn-primary" type="button" @click="returnContent">保存</button>
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
<style lang="scss">
@import "../../static/css/ue.scss";

</style>
<script>
import myHeader from '../components/header.vue'
import myFooter from '../components/footer.vue'
import Uediter from '@/components/ue.vue'

export default {
  components: { myHeader, myFooter, Uediter },
  data() {
    return {
      subject:'',
      dat: {
        content: ''
      },
      ueditor: {
        value: '',
        config: {
          toolbars: [
            [
              'removeformat', 'undo', 'redo', '|',
              'forecolor', 'bold', 'italic', 'underline', 'horizontal', 'blockquote', '|',
              'link', 'unlink', '|',
              'justifyleft', 'justifyright', 'justifycenter', 'justifyjustify', 'lineheight', '|',
              'edittip '
            ]
          ],
          initialFrameHeight: 400,
          initialFrameWidth: null
        }
      }
    }
  },
  methods: {
    returnContent() {
      this.dat.content = this.$refs.ue.getUEContent()
      console.log(this.dat.content)
    }
  }
}

</script>
