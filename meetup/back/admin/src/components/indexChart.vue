<template>
  <div :class="className" :id="id" :style="{height:height,width:width}" ref="myEchart">
  </div>
</template>
<script>
import echarts from 'echarts'
export default {
  props: {
    className: {
      type: String,
      default: 'yourClassName'
    },
    id: {
      type: String,
      default: 'yourID'
    },
    width: {
      type: String,
      default: '400px'
    },
    height: {
      type: String,
      default: '400px'
    }
  },
  data() {
    return {
      chart: null
    }
  },
  mounted() {
    this.initChart();
  },
  beforeDestroy() {
    if (!this.chart) {
      return
    }
    this.chart.dispose();
    this.chart = null;
  },
  methods: {
    initChart() {
      this.chart = echarts.init(this.$refs.myEchart);
      // 把配置和数据放这里

//        this.$http.get('login', {
//           username: username,
//           password: password
//         })
//         .then((response) => {
//           console.log('response:',response)
//           if (response.data.status == 0) {
// //   this.chart.setOption({

//       //   })


//           } else if (response.data.status == 1) {

//           }

//         })


      this.chart.setOption({
        title: {
          text: '票',
          subtext: '总数: ' + 100,
          x: 'center',
          textStyle:{
            color: '#fff',
            fontSize:24


          },
          subtextStyle:{
            color: '#fff',
            fontSize:14
          }
        },
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['普通票', '赠票']
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            }

          }
        },
        calculable: true,
        series: [{
          name: 'Tickets',
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          data: [{
            value: 2,
            name: '普通票'
          }, {
            value: 5,
            name: '赠票'
          }]
        }],
        color:['#93b7e3','#2f4554', '#edafda', '#93b7e3', '#a5e7f0','#cbb0e3']

      });




    }
  }
}

</script>
