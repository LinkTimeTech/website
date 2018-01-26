<template>
  <div>
    <myHeader></myHeader>
    <!-- Page content -->
    <div id="content" class="col-md-12">
      <!-- page header -->
      <!-- <div class="pageheader">
        <h2><i class="fa fa-pencil-square-o" style="line-height: 48px;padding-left: 0;"></i> 编辑</h2>
      </div> -->
      <!-- /page header -->
      <!-- content main container -->
      <div class="main">
        <!-- row -->
        <div class="row">
          <!-- col 12 -->
          <div class="col-md-6">
            <!-- tile -->
            <section class="tile transparent">
              <!-- tile header -->
              <!--  <div class="tile-header transparent">
                <h1><strong>编辑邮件内容</strong> </h1>
              </div> -->
              <!-- /tile header -->
              <!-- tile body -->
              <div class="tile-body color transparent-white rounded-corners">
                <Echart></Echart>
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
import Echart from '../components/indexChart.vue'

export default {
  components: { myHeader, myFooter, Echart },

}

</script>
