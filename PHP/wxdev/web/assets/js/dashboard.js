/**
 * @Package: Complete Admin Responsive Theme
 * @Since: Complete Admin 1.0
 * This file is part of Complete Admin Responsive Theme.
 */


jQuery(function($) {

    'use strict';

    var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};




    /*--------------------------------
         Window Based Layout
     --------------------------------*/
    CMPLTADMIN_SETTINGS.dashboardEcharts = function() {


        /*------------- Chart 1 ----------------*/

      // Initialize after dom ready
       var myChart = echarts.init(document.getElementById('browser_type')); 
        
        var option = {

                // Setup grid
                grid: {
                    zlevel: 0,
                    x: 20,
                    x2: 20,
                    y: 20,
                    y2: 20,
                    borderWidth: 0,
                    backgroundColor: 'rgba(0,0,0,0)',
                    borderColor: 'rgba(0,0,0,0)',
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    axisPointer: { 
                        type: 'shadow', // line|shadow
                        lineStyle:{color: 'rgba(0,0,0,.5)', width: 1},
                        shadowStyle:{color: 'rgba(0,0,0,.1)'}
                      }
                },

                // Add legend
                legend: {
                    data: []
                },
                toolbox: {
                  orient: 'vertical',
                    show : true,
                    showTitle: true,
                    color : ['#bdbdbd','#bdbdbd','#bdbdbd','#bdbdbd'],
                    feature : {
                        mark : {show: false},
                        dataZoom : {
                            show : true,
                            title : {
                                dataZoom : 'Data Zoom',
                                dataZoomReset : 'Reset Zoom'
                            }
                        },
                        dataView : {show: false, readOnly: true},
                        magicType : {
                          show: true, 
                            itemSize: 12,
                            itemGap: 12,
                          title : {
                              line : 'Area',
                              bar : 'Bar'
                          },
                          type: ['line', 'bar']
                        },
                        restore : {show: false},
                        saveAsImage : {show: true,title:'Save as Image'}
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['Chrome','Firefox','Safari','Opera','IE'],
                    axisLine: {
                        show: true,
                        onZero: true,
                        lineStyle: {
                            color: 'rgba(63,81,181,1.0)',
                            type: 'solid',
                            width: '2',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },                    
                    axisTick: {
                        show: false,
                    },
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: '#fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: 'fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
                    axisLabel: {
                        show: false,
                    },                    
                    axisTick: {
                        show: false,
                    },                    
                    axisLine: {
                        show: false,
                        onZero: true,
                        lineStyle: {
                            color: '#ff0000',
                            type: 'solid',
                            width: '0',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },


                }],

                // Add series
                series: [
                    {
                        name: 'Total Visits',
                        type: 'line',
                        smooth: true,
                        symbol:'none',
                        symbolSize:2,
                        showAllSymbol: true,
                        itemStyle: {
                          normal: {
                            color:'rgba(63,81,181,1.0)', 
                            borderWidth:4, borderColor:'rgba(63,81,181,1)', 
                            areaStyle: {color:'rgba(63,81,181,1.0)', type: 'default'}
                          }
                        },

                        data: [500,200,322,212,99]
                    }]
            };

        // Load data into the ECharts instance 
        myChart.setOption(option); 






        /*-------------- Chart 2 ---------------*/

// Initialize after dom ready
        var myChart = echarts.init(document.getElementById('user_type')); 
        
        var option = {

                // Setup grid
                grid: {
                    zlevel: 0,
                    x: 30,
                    x2: 55,
                    y: 20,
                    y2: 20,
                    borderWidth: 0,
                    backgroundColor: 'rgba(0,0,0,0)',
                    borderColor: 'rgba(0,0,0,0)',
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    axisPointer: { 
                        type: 'shadow', // line|shadow
                        lineStyle:{color: 'rgba(0,0,0,.5)', width: 1},
                        shadowStyle:{color: 'rgba(0,0,0,.1)'}
                      }
                },

                // Add legend
                legend: {
                    data: []
                },
                toolbox: {
                  orient: 'vertical',
                    show : true,
                    showTitle: true,
                    color : ['#bdbdbd','#bdbdbd','#bdbdbd','#bdbdbd'],
                    feature : {
                        mark : {show: false},
                        dataZoom : {
                            show : true,
                            title : {
                                dataZoom : 'Data Zoom',
                                dataZoomReset : 'Reset Zoom'
                            }
                        },
                        dataView : {show: false, readOnly: true},
                        magicType : {
                          show: true, 
                            itemSize: 12,
                            itemGap: 12,
                          title : {
                              line : 'Area',
                              bar : 'Bar',
                              stack : 'Stacked Bar',
                              tiled: 'Tiled Bar'
                          },
                          type: ['line', 'bar','stack','tiled']
                        },
                        restore : {show: false},
                        saveAsImage : {show: true,title:'Save as Image'}
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['2016-06-01','2016-05-01','2016-04-01','2016-03-01','2016-02-01'],
                    axisLine: {
                        show: true,
                        onZero: true,
                        lineStyle: {
                            color: 'rgba(63,81,181,1.0)',
                            type: 'solid',
                            width: '2',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },                    
                    axisTick: {
                        show: false,
                    },
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: '#fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: 'fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
                    axisLabel: {
                        show: false,
                    },                    
                    axisTick: {
                        show: false,
                    },                    
                    axisLine: {
                        show: false,
                        onZero: true,
                        lineStyle: {
                            color: '#E91E63',
                            type: 'solid',
                            width: '0',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },


                }],

                // Add series
                series: [
                    {
                        name: 'Registered Users',
                        type: 'bar',
                        smooth: true,
                        symbol:'none',
                        symbolSize:2,
                        showAllSymbol: true,
                        barWidth:15,
                        barGap:'10%',
                        itemStyle: {
                          normal: {
                            color:'rgba(63,81,181,1.0)', 
                            borderWidth:2, borderColor:'rgba(63,81,181,1)', 
                            areaStyle: {color:'rgba(63,81,181,1)', type: 'default'}
                          }
                        },

                        data: [2323,2144,4534,1989,3232]
                    },
                    {
                        name: 'Guest Visitors',
                        type: 'bar',
                        smooth: true,
                        symbol:'none',
                        symbolSize:2,
                        showAllSymbol: true,
                        barWidth:15,
                        barGap:'10%',
                        itemStyle: {
                          normal: {
                            color:'#E91E63', 
                            borderWidth:2, borderColor:'#E91E63', 
                            areaStyle: {color:'#E91E63', type: 'default'}
                          }
                        },

                        data: [5656,6567,7675,3423,4343]
                    },
                ]
            };

        // Load data into the ECharts instance 
        myChart.setOption(option); 





        /*--------------- Chart 3 -------------*/

var myChart = echarts.init(document.getElementById('platform_type_dates')); 

var idx = 1;
var option_dt = {

    timeline : {
        show: true,
        data : ['06-16','05-16','04-16'],
        label : {
            formatter : function(s) {
                return s.slice(0, 5);
            }
        },
        x:10,
        y:null,
        x2:10,
        y2:0,
        width:250,
        height:50,
        backgroundColor:"rgba(0,0,0,0)",
        borderColor:"#eaeaea",
        borderWidth:0,
        padding:5,
        controlPosition:"left",
        autoPlay:true,
        loop:true,
        playInterval:2000,
        lineStyle:{
            width:1,
            color:"#bdbdbd",
            type:""
        },

    },

    options : [
        {
            color: ['#3F51B5','#303F9F','#1A237E','#9FA8DA','#7986CB','#C5CAE9'],
            title : {
                text: '',
                subtext: ''
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                show: false,
                x: 'left',
                orient:'vertical',
                padding: 0,
                data:['Apple','Windows','Linux','Android','Others']
            },
            toolbox: {
                show : true,
                color : ['#bdbdbd','#bdbdbd','#bdbdbd','#bdbdbd'],
                feature : {
                    mark : {show: false},
                    dataView : {show: false, readOnly: true},
                    magicType : {
                        show: true, 
                            itemSize:12,
                            itemGap: 12,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '10%',
                                width: '80%',
                                funnelAlign: 'center',
                                max: 50
                            },
                            pie: {
                                roseType : 'none',
                            }
                        }
                    },
                    restore : {show: false},
                    saveAsImage : {show: true}
                }
            },


                            series : [
                                {
                                    name:'06-16',
                                    type:'pie',
                                    radius : [15, '70%'],
                                    roseType : 'radius',
                                    center: ['50%', '45%'],
                                    width: '50%',       // for funnel
                                    itemStyle : {
                                        normal : { label : { show : true }, labelLine : { show : true } },
                                        emphasis : { label : { show : false }, labelLine : {show : false} }
                                    },
                                    data:[{value: 35,  name:'Apple'}, {value: 16,  name:'Windows'}, {value: 27,  name:'Linux'}, {value: 29,  name:'Android'}, {value: 12,  name:'Others'}]
                                }
                            ]
                    }, 
                {
                    series : [
                        {
                            name:'05-16',
                            type:'pie',
                            data:[{value: 42,  name:'Apple'}, {value: 51,  name:'Windows'}, {value: 39,  name:'Linux'}, {value: 25,  name:'Android'}, {value: 9,  name:'Others'}]
                        }
                    ]
                },
                {
                    series : [
                        {
                            name:'04-16',
                            type:'pie',
                            data:[{value: 29,  name:'Apple'}, {value: 16,  name:'Windows'}, {value: 24,  name:'Linux'}, {value: 19,  name:'Android'}, {value: 5,  name:'Others'}]
                        }
                    ]
                },

    ] // end options object
};

myChart.setOption(option_dt);        








            /*----------------- Chart 4 ------------------*/


// Initialize after dom ready
        var myChart = echarts.init(document.getElementById('page_views_today')); 
        
        var option = {

                // Setup grid
                grid: {
                    zlevel: 0,
                    x: 20,
                    x2: 40,
                    y: 20,
                    y2: 20,
                    borderWidth: 0,
                    backgroundColor: 'rgba(0,0,0,0)',
                    borderColor: 'rgba(0,0,0,0)',
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    axisPointer: { 
                        type: 'shadow', // line|shadow
                        lineStyle:{color: 'rgba(0,0,0,.5)', width: 1},
                        shadowStyle:{color: 'rgba(0,0,0,.1)'}
                      }
                },

                // Add legend
                legend: {
                    data: []
                },
                toolbox: {
                  orient: 'vertical',
                    show : true,
                    showTitle: true,
                    color : ['#bdbdbd','#bdbdbd','#bdbdbd','#bdbdbd'],
                    feature : {
                        mark : {show: false},
                        dataZoom : {
                            show : true,
                            title : {
                                dataZoom : 'Data Zoom',
                                dataZoomReset : 'Reset Zoom'
                            }
                        },
                        dataView : {show: false, readOnly: true},
                        magicType : {
                          show: true, 
                            itemSize: 12,
                            itemGap: 12,
                          title : {
                              line : 'Line',
                              bar : 'Bar',
                          },
                          type: ['line', 'bar'],
                          option: {
                            /*line: {
                                itemStyle: {
                                  normal: {
                                    color:'rgba(3,1,1,1.0)', 
                                  }
                                },
                                data: [1,2,3,4,5,6,7,8,9,10,11,12]
                            }*/
                          }
                        },
                        restore : {show: false},
                        saveAsImage : {show: true,title:'Save as Image'}
                    }
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        '0h-2h', '2h-4h', '4h-6h', '6h-8h', '8h-10h', '10h-12h', '12h-14h', '14h-16h', '16h-18h', '18h-20h', '20h-22h', '22h-24h'
                    ],
                    axisLine: {
                        show: true,
                        onZero: true,
                        lineStyle: {
                            color: 'rgba(63,81,181,1.0)',
                            type: 'solid',
                            width: '2',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },                    
                    axisTick: {
                        show: false,
                    },
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: '#fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: 'fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
                    axisLabel: {
                        show: false,
                    },                    
                    axisTick: {
                        show: false,
                    },                    
                    axisLine: {
                        show: false,
                        onZero: true,
                        lineStyle: {
                            color: '#ff0000',
                            type: 'solid',
                            width: '0',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },


                }],

                // Add series
                series: [
                    {
                        name: 'Page Views',
                        type: 'bar',
                        smooth: true,
                        symbol:'none',
                        symbolSize:2,
                        showAllSymbol: true,
                        barWidth:10,
                        itemStyle: {
                          normal: {
                            color:'rgba(63,81,181,1.0)', 
                            borderWidth:2, borderColor:'rgba(63,81,181,1)', 
                            areaStyle: {color:'rgba(63,81,181,1)', type: 'default'}
                          }
                        },

                        data: [1545,1343,1445,2675,2878,1789,1745,2343,2445,1675,1878,2789]
                    }
                ]
            };

        // Load data into the ECharts instance 
        myChart.setOption(option); 











            /*----------------- Chart 5 ------------------*/


// Initialize after dom ready
        var myChart = echarts.init(document.getElementById('scatter_chart')); 
        
        var option = {
            color: ['rgba(63,81,181,1.0)','#E91E63'],
    title : {
       // text: '',
       // subtext: ''
    },

                // Setup grid
                grid: {
                    zlevel: 0,
                    x: 20,
                    x2: 20,
                    y: 55,
                    y2: 20,
                    borderWidth: 0,
                    backgroundColor: 'rgba(0,0,0,0)',
                    borderColor: 'rgba(0,0,0,0)',
                },
    tooltip : {
        trigger: 'axis',
        showDelay : 0,
        formatter : function (params) {
            if (params.value.length > 1) {
                return params.seriesName + '<br/>'
                   + params.value[0] + ' : Social Media<br/>' 
                   + params.value[1] + ' : Advertisement';
            }
            else {
                return params.seriesName + ' :<br/>'
                   + params.name + ' : '
                   + params.value + 'Advertisement';
            }
        },  
        axisPointer:{
            show: false,
            type : 'none',
            lineStyle: {
                type : 'dashed',
                width : 0
            }
        }
    },
    legend: {
        data:['2016','2015'],
        orient: 'vertical',
        x:'left'
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: false},
            dataZoom : {show: true},
            dataView : {show: false, readOnly: false},
            restore : {show: false},
            saveAsImage : {show: true}
        }
    },
    xAxis : [
        {
            type : 'value',
                    axisLine: {
                        show: true,
                        onZero: true,
                        lineStyle: {
                            color: 'rgba(63,81,181,1.0)',
                            type: 'solid',
                            width: '2',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },                    
                    axisTick: {
                        show: false,
                    },
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: '#fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
            scale:true,
            axisLabel : {
                formatter: '{value}'
            }
        }
    ],
    yAxis : [
        {
            show:false,
            type : 'value',
                    axisLine: {
                        show: true,
                        onZero: true,
                        lineStyle: {
                            color: 'rgba(63,81,181,1.0)',
                            type: 'solid',
                            width: '2',
                            shadowColor: 'rgba(0,0,0,0)',
                            shadowBlur: 5,
                            shadowOffsetX: 3,
                            shadowOffsetY: 3,
                        },
                    },                    
                    axisTick: {
                        show: false,
                    },
                    splitLine: {
                          show: false,
                          lineStyle: {
                              color: '#fff',
                              type: 'solid',
                              width: 0,
                              shadowColor: 'rgba(0,0,0,0)',
                        },
                    },
            scale:true,
            axisLabel : {
                formatter: '{value}'
            }
        }
    ],
    series : [
        {
            name:'2016',
            type:'scatter',
            data: [[161, 51], [167, 59], [159, 49], [157, 63], [155, 53],
                [170, 59], [159, 47], [166, 69], [176, 66], [160, 75],
                [172, 55], [170, 54], [172, 62], [153, 42], [160, 50],
                [147, 49], [168, 49], [175, 73], [157, 47], [167, 68]

            ],
            markPoint : {
                show:false,
                data : [
                    {type : 'max', name: ''},
                    {type : 'min', name: ''}
                ]
            },
            /*markLine : {
                show:false,
                data : [
                    {type : '', name: ''}
                ]
            }*/
        },
        {
            name:'2015',
            type:'scatter',
            data: [[174, 65], [175, 71], [193, 80], [186, 72], [187, 78],
                [181, 74], [184, 86], [184, 78], [175, 62], [184, 81],
                [180, 76], [177, 83], [192, 90], [176, 74], [174, 71],
                [184, 79], [192, 93], [171, 70], [173, 72], [176, 85]
                
            ],
            markPoint : {
                show:false,
                data : [
                    {type : 'max', name: ''},
                    {type : 'min', name: ''}
                ]
            },
            /*markLine : {
                show:false,
                data : [
                    {type : 'average', name: ''}
                ]
            }*/
        }
    ]
};
                    

        // Load data into the ECharts instance 
        myChart.setOption(option); 







            /*----------------- Chart 6 ------------------*/


// Initialize after dom ready
        var myChart = echarts.init(document.getElementById('gauge_chart')); 
        
        var option = {
                        
                tooltip : {
                    formatter: "{b} : {c}%"
                },
                toolbox: {
                    show : false,
                    feature : {
                        mark : {show: false},
                        restore : {show: false},
                        saveAsImage : {show: true}
                    }
                },
                series : [
                    {
                        name:'Server Load',
                        type:'gauge',
                        center: ['50%', '50%'],
                        radius: ['0%', '100%'],
                        axisLine: {
                            show: true,
                            lineStyle: {
                                color: [
                                    [0.2, '#536DFE'],
                                    [0.8, 'rgba(63,81,181,1)'],
                                    [1, '#E91E63']
                                ],
                                width: 10
                            }
                        }  ,
                        title: {
                            show : false,
                            offsetCenter: [0, '120%'],
                            textStyle: {
                                color: '#333',
                                fontSize : 15
                            }
                        }  ,
                        detail: {
                            show : true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderWidth: 0,
                            borderColor: '#ccc',
                            width: 100,
                            height: 40,
                            offsetCenter: [0, '40%'],
                            formatter:'{value}%',
                            textStyle: {
                                color: 'auto',
                                fontSize : 20
                            }
                        },
                       
                        data:[{value: 50, name: 'Server Load (MB)'}]
                    }
             ]
};

//myChart.setOption(option);
gauge_load_chart(option);
var timeTicket = setInterval(function (){
    gauge_load_chart(option);
},1500);

function gauge_load_chart(option){
    option.series[0].data[0].value = (Math.random()*100).toFixed(2) - 0;
    myChart.setOption(option,true);
}


//clearInterval(timeTicket);






    }



    /******************************
     initialize respective scripts 
     *****************************/
    $(document).ready(function() {
        CMPLTADMIN_SETTINGS.dashboardEcharts();
    });

    $(window).resize(function() {
        CMPLTADMIN_SETTINGS.dashboardEcharts();
    });

    $(window).load(function() {});

});
