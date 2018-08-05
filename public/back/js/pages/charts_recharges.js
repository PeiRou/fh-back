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
            // axisPointer: {
            //     type: 'cross',
            //     crossStyle: {
            //         color: '#999'
            //     }
            // }
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
                data: [],
                axisPointer: {
                    type: 'shadow'
                }
            }
        ],
        yAxis: [
            {
                type : 'value'
            }
        ],
        series: [
            {
                name:'充值',
                type:'bar',
                data:[]
            },
            {
                name:'提款',
                type:'bar',
                data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
            }
        ]
    };

    timeList = [];
    rechargesData = [];

    ajaxData(timeList,rechargesData);

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
});

function ajaxData(timeList,rechargesData) {
    myChart.showLoading();
    $.ajax({
        type : "post",
        async : true,            //异步请求（同步请求将会锁住浏览器，用户其他操作必须等待请求完成才可以执行）
        url : "/back/charts/recharges",    //请求发送到TestServlet处
        data : {},
        dataType : "json",        //返回数据形式为json
        success : function(result) {
            console.log(result);
            timeList = [];
            rechargesData = [];
            result.forEach(function (value) {
                timeList.push(value.hours+'点');
                rechargesData.push(value.sumAmount);
            });
            myChart.hideLoading();
            myChart.setOption({
                xAxis:{
                    data:timeList
                },
                series: [
                    {
                        name:'充值',
                        type:'bar',
                        data:rechargesData
                    },
                    {
                        name:'提款',
                        type:'bar',
                        data:rechargesData
                    }
                ]
            });
        },
        error : function(errorMsg) {
            //请求失败时执行该函数
            alert("图表请求数据失败!");
            myChart.hideLoading();
        }
    });
}