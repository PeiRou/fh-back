$(function () {
    $('#menu-chartsManage').addClass('nav-show');
    $('#menu-chartsManage-recharges').addClass('active');

    // 基于准备好的dom，初始化echarts实例
    myChart = echarts.init(document.getElementById('rechargeCharts'));
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '24小时充值统计图表'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['充值','提款']
        },
        xAxis: [
            {
                type: 'category',
                data: ['00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            // {
            //     type: 'value',
            //     name: '金额',
            //     min: 0,
            //     max: 250,
            //     interval: 50,
            //     axisLabel: {
            //         formatter: '{value} ml'
            //     }
            // }
            {
                type : 'value'
            }
        ],
        series: [
            {
                name:'充值',
                type:'bar',
                data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
            },
            {
                name:'提款',
                type:'bar',
                data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
});