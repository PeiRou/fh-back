$(function () {
    $('#menu-chartsManage').addClass('nav-show');
    $('#menu-chartsManage-gameBunko').addClass('active');

    // 基于准备好的dom，初始化echarts实例
    myChart = echarts.init(document.getElementById('gameBunkoCharts'));
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
                data : []
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
                        color:function (d) {
                            var data = d.data;
                            if(data > 0){
                                return '#1cbf1c';
                            } else {
                                return '#fd3148';
                            }
                        }
                    }
                },
                data:[]
            }
        ]
    };
    gameList = [];
    gameData = [];
    
    ajaxData(gameList,gameData);

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

});

function refreshCharts() {
    myChart.showLoading();
    ajaxData(gameList,gameData);
}

function ajaxData(gameList,gameData) {
    myChart.showLoading();
    myChart.setOption({
        yAxis:{
            data:[]
        },
        series:{
            type:'bar',
            data:[]
        }
    });
    $.ajax({
        type : "post",
        async : true,            //异步请求（同步请求将会锁住浏览器，用户其他操作必须等待请求完成才可以执行）
        url : "/back/charts/gameBunko",    //请求发送到TestServlet处
        data : {},
        dataType : "json",        //返回数据形式为json
        success : function(result) {
            console.log(result);
            result.forEach(function (value) {
                gameList.push(value.game_name);
                gameData.push(value.sumBunko);
            });
            myChart.hideLoading();
            myChart.setOption({
                yAxis:{
                    data:gameList
                },
                series:{
                    data:gameData
                }
            });
        },
        error : function(errorMsg) {
            //请求失败时执行该函数
            alert("图表请求数据失败!");
            myChart.hideLoading();
        }
    });
}