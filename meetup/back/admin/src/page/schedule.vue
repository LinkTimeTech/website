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
                <h1><strong>编辑行程内容</strong> </h1>
              </div>
              <!-- /tile header -->
              <!-- tile body -->
              <div class="tile-body color transparent-white rounded-corners">
                <div class="margin-bottom-20">
                  <button type="button" class="btn btn-primary">中</button>
                  <button type="button" class="btn btn-primary">英</button>
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
<script>
import myHeader from '../components/header.vue'
import myFooter from '../components/footer.vue'
import Uediter from '@/components/ue.vue'

export default {
  components: { myHeader, myFooter, Uediter },
  data() {
    return {
      subject: '',

      scrollWatch: true,

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
            ],
            ['inserttable', 'insertrow', 'insertcol', 'mergeright', 'mergedown', 'splittorows', 'splittocols', 'splittocells', 'mergecells', 'insertparagraphbeforetable', 'edittable']
          ],
          initialFrameHeight: 400,
          initialFrameWidth: null
        }
      }
    }
  },
  created() {
    this.getData()
  },
  mounted: function() {

    $(window).scrollTop(0);
    $(window).on('scroll', () => {
      if (this.scrollWatch) {
        //your code here
      }
    });
    this.$nextTick(function() {
      // 代码保证 this.$el 在 document 中

    })
  },

  destroyed() {
    this.scrollWatch = false;
  },
  
  methods: {
    getData() {


    },
    returnContent() {
      this.dat.content = this.$refs.ue.getUEContent()
      console.log(this.dat.content)
    }
  }
}

</script>
