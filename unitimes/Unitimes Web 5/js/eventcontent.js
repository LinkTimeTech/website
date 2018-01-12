var data = {
    contents: [
        // {
        //     top: '1',
        //     id: '',
        //     date: 'Dec 03, 2017',
        //     datecn: '2017.12.27',
        //     cover: 'images/events/'+'',
        //     title: '',
        //     titlecn: '',
        //     intro: '',
        //     introcn: '',
        //     url: 'events/'+'' + '.html',
        //     urlcn: 'events/'+'' + '_cn.html'
        // },
        {
            top: '1',
            id: '',
            date: 'Dec 03, 2017',
            datecn: '2017.12.03',
            cover: 'images/events/' + 'asia_pacific_ethereum_s.jpg',
            title: 'Asia-Pacific Ethereum Community Meetup',
            titlecn: '亚太区以太坊社区培训暨交流活动',
            intro: 'Asia-Pacific Ethereum Community Meetup will be taking place in Shenzhen, China on Dec 3, 2017！',
            introcn: '灵钛科技将于12月3日在中国深圳举办亚太以太坊社区培训及技术交流meetup！',
            url: 'events/' + 'asia_pacific_ethereum_community_meetup' + '.html',
            urlcn: 'events/' + 'asia_pacific_ethereum_community_meetup' + '_cn.html'
        },
        {
            top: '1',
            id: '',
            date: 'November 1-4, 2017',
            datecn: '2017.11.01 - 2017.11.04',
            cover: 'images/events/devcon3-crop-1200.jpg',
            title: 'Devcon3 | 2017 Conference Overview',
            titlecn: 'Devcon3 | 2017 以太坊开发者大会',
            intro: 'This year, the Ethereum Foundation(organizer) has dedicated convention center space that accommodates close to double the capacity as last year as well as a second hall to allow for more presentations and formats.',
            introcn: '今年，会议主办方准备了专门的会议中心，可容纳较去年近多一倍的人数，并且另外准备了大厅来支持更多的演示并且用于其他安排。',
            url: 'events/' + 'devcon3_2017_conference' + '.html',
            urlcn: 'events/' + 'devcon3_2017_conference' + '_cn.html'
        }
    ]

};

var vm = new Vue({
    el: '#gtco-maine',
    data: data
});
