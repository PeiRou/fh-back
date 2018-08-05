$(function () {
    $('#menu-chartsManage').addClass('nav-show');
    $('#menu-chartsManage-gameBunko').addClass('active');

    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('gameBunkoCharts'));
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: 'ECharts 入门示例'
        },
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        legend: {
            data:['盈亏']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'value'
            }
        ],
        yAxis : [
            {
                type : 'category',
                axisTick : {show: false},
                data : ['周一','周二','周三','周四','周五','周六','周日']
            }
        ],
        series : [
            {
                name:'盈亏',
                type:'bar',
                label: {
                    normal: {
                        show: true,
                        position: 'inside'
                    }
                },
                itemStyle:{
                    normal:{
                        color:function (e) {
                            console.log(e);
                        }
                    }
                },
                data:[200, 170, -240, 244, 200, -220, 210]
            }
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
});