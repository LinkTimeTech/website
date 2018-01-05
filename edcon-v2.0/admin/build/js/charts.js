/* ECHRTS */


function init_echarts() {

    if (typeof (echarts) === 'undefined') {
        return;
    }
    // console.log('init_echarts');


    var theme = {
        color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
        ],

        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: 'normal',
                color: '#408829'
            }
        },

        dataRange: {
            color: ['#1f610a', '#97b58d']
        },

        toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
        },

        tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: '#408829',
                    type: 'dashed'
                },
                crossStyle: {
                    color: '#408829'
                },
                shadowStyle: {
                    color: 'rgba(200,200,200,0.3)'
                }
            }
        },

        dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
        },
        grid: {
            borderWidth: 0
        },

        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },

        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },
        timeline: {
            lineStyle: {
                color: '#408829'
            },
            controlStyle: {
                normal: {color: '#408829'},
                emphasis: {color: '#408829'}
            }
        },

        k: {
            itemStyle: {
                normal: {
                    color: '#68a54a',
                    color0: '#a9cba2',
                    lineStyle: {
                        width: 1,
                        color: '#408829',
                        color0: '#86b379'
                    }
                }
            }
        },
        map: {
            itemStyle: {
                normal: {
                    areaStyle: {
                        color: '#ddd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                },
                emphasis: {
                    areaStyle: {
                        color: '#99d2dd'
                    },
                    label: {
                        textStyle: {
                            color: '#c12e34'
                        }
                    }
                }
            }
        },
        force: {
            itemStyle: {
                normal: {
                    linkStyle: {
                        strokeColor: '#408829'
                    }
                }
            }
        },
        chord: {
            padding: 4,
            itemStyle: {
                normal: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                },
                emphasis: {
                    lineStyle: {
                        width: 1,
                        color: 'rgba(128, 128, 128, 0.5)'
                    },
                    chordStyle: {
                        lineStyle: {
                            width: 1,
                            color: 'rgba(128, 128, 128, 0.5)'
                        }
                    }
                }
            }
        },
        gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
                show: true,
                lineStyle: {
                    color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                    width: 8
                }
            },
            axisTick: {
                splitNumber: 10,
                length: 12,
                lineStyle: {
                    color: 'auto'
                }
            },
            axisLabel: {
                textStyle: {
                    color: 'auto'
                }
            },
            splitLine: {
                length: 18,
                lineStyle: {
                    color: 'auto'
                }
            },
            pointer: {
                length: '90%',
                color: 'auto'
            },
            title: {
                textStyle: {
                    color: '#333'
                }
            },
            detail: {
                textStyle: {
                    color: 'auto'
                }
            }
        },
        textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
        }
    };

    //echart Pie

    if ($('#ticket_pie').length) {

        var ticket_pie = echarts.init(document.getElementById('ticket_pie'), theme);

        var ticketsData, birdVal, standardVal, devVal, studentVal, freeVal, TotalTicketNum;

        /*
         *  拿ticket_pie数据
         */
        var getticketStatistics = new XMLHttpRequest();
        getticketStatistics.open('post', 'https://edcon.io/tp/public/index.php/admin/edcon/ticketStatistics');
        getticketStatistics.send();

        getticketStatistics.onload = function () {

            var json = JSON.parse(this.response);

            // console.log('json: ', json)
            // console.log('json.data: ', json.data)

            var status = this.response.status;
            ticketsData = json.data.ticket;
            birdVal = ticketsData[0].value;
            standardVal = ticketsData[1].value;
            devVal = ticketsData[2].value;
            studentVal = ticketsData[3].value;
            freeVal = ticketsData[4].value;
            TotalTicketNum = json.data.total;

            // console.log('registration: ', json.data.registration);

            ticket_pie.setOption({
                title: {
                    text: 'Tickets Data',
                    subtext: 'Total: ' + TotalTicketNum,
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: ['Early Bird Ticket', 'Standard Ticket', 'Developer Ticket', 'Student Ticket', 'Free Ticket']
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
                        },
                        restore: {
                            show: true,
                            title: "Restore"
                        },
                        saveAsImage: {
                            show: true,
                            title: "Save Image"
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
                        value: birdVal,
                        name: 'Early Bird Ticket'
                    }, {
                        value: standardVal,
                        name: 'Standard Ticket'
                    }, {
                        value: devVal,
                        name: 'Developer Ticket'
                    }, {
                        value: studentVal,
                        name: 'Student Ticket'
                    }, {
                        value: freeVal,
                        name: 'Free Ticket'
                    }]
                }]
            });


        };


        var dataStyle = {
            normal: {
                label: {
                    show: false
                },
                labelLine: {
                    show: false
                }
            }
        };

        var placeHolderStyle = {
            normal: {
                color: 'rgba(0,0,0,0)',
                label: {
                    show: false
                },
                labelLine: {
                    show: false
                }
            },
            emphasis: {
                color: 'rgba(0,0,0,0)'
            }
        };

    }

    if ($('#register_pie').length) {

        var registrationData, speakerVal, sponsorVal, mediaVal, superdemoVal, communityVal, TotalRegistNum;


        var register_pie = echarts.init(document.getElementById('register_pie'));

        /*
         *  拿register_pie数据
         */
        // var registrationStatistics;
        var getRegistrationStatistics = new XMLHttpRequest();
        getRegistrationStatistics.open('post', 'https://edcon.io/tp/public/index.php/admin/edcon/registrationStatistics');
        getRegistrationStatistics.send();

        getRegistrationStatistics.onload = function () {

            var json = JSON.parse(this.response);

            var status = this.response.status;
            registrationData = json.data.registration;
            speakerVal = registrationData[0].value;
            sponsorVal = registrationData[1].value;
            mediaVal = registrationData[2].value;
            superdemoVal = registrationData[3].value;
            communityVal = registrationData[4].value;
            TotalRegistNum = json.data.total;

            // console.log('registration: ', json.data.registration);

            register_pie.setOption({
                title: {
                    text: 'Registration Data',
                    subtext: 'Total: ' + TotalRegistNum,
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    x: 'center',
                    y: 'bottom',
                    data: ['Speaker', 'Sponsor', 'Media', 'Community', 'Superdemo']
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
                        },
                        restore: {
                            show: true,
                            title: "Restore"
                        },
                        saveAsImage: {
                            show: true,
                            title: "Save Image"
                        }
                    }
                },
                calculable: true,
                series: [{
                    name: 'Registration',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '48%'],
                    data:
                        [{
                            value: speakerVal,
                            name: 'Speaker'
                        }, {
                            value: sponsorVal,
                            name: 'Sponsor'
                        }, {
                            value: mediaVal,
                            name: 'Media'
                        }, {
                            value: communityVal,
                            name: 'Community'
                        }, {
                            value: superdemoVal,
                            name: 'Superdemo'
                        }]
                }]
            });

        };


        var dataStyle = {
            normal: {
                label: {
                    show: false
                },
                labelLine: {
                    show: false
                }
            }
        };

        var placeHolderStyle = {
            normal: {
                color: 'rgba(0,0,0,0)',
                label: {
                    show: false
                },
                labelLine: {
                    show: false
                }
            },
            emphasis: {
                color: 'rgba(0,0,0,0)'
            }
        };

    }


}

$(document).ready(function () {

    init_echarts();

});