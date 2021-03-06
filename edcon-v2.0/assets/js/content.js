var data = {
    faq: [
        {
            url: '#ansOne',
            ansid: 'ansOne',
            quesid: 'quesOne',
            question: 'How many tickets are available in total?',
            ans: ' We plan to have up to 600 participants in total, including EDCON staff and volunteers. An early registration and purchase for the ticket is highly' +
            '                                            recommended as you can get a good discount if you are an early bird.'
        },
        {
            url: '#ansTwo',
            ansid: 'ansTwo',
            quesid: 'quesTwo',
            question: 'How can I buy tickets?',
            ans: 'Ticket purchase is open now, you can register and pay via the website link directly. If you want to pay with Ether, please email at contact@linktimetech.com'
        },
        {
            url: '#ansThree',
            ansid: 'ansThree',
            quesid: 'quesThree',
            question: 'Are there any good places to visit around the venue?',
            ans: ' Toronto, the capital of the Ontario province, is a major Canadian city along\n' +
            '                                            Lake\n' +
            '                                            Ontario’s northwestern shore. It\'s a dynamic metropolis with a core of\n' +
            '                                            soaring\n' +
            '                                            skyscrapers, all dwarfed by the iconic, free-standing CN Tower. Toronto also\n' +
            '                                            has\n' +
            '                                            many green spaces, from the orderly oval of Queen’s Park to 400-acre High\n' +
            '                                            Park and\n' +
            '                                            its trails, sports facilities and zoo. Ryerson University is located in the\n' +
            '                                            center\n' +
            '                                            of Toronto, surrounding by the central shopping mall, CF Toronto Eaton\n' +
            '                                            Centre, which\n' +
            '                                            is just a step away from Ryerson University. There are full of Hotels and\n' +
            '                                            Restaurants near by and the CN tower is only 1.7 km away from Ryerson\n' +
            '                                            University.'
        }
    ],
    faq2: [
        {
            url: '#ansFour',
            ansid: 'ansFour',
            quesid: 'quesFour',
            question: 'Will there be any video recordings of the event?',
            ans: 'Yes, there will be video recordings of the wonderful presentations / demos /\n' +
            '                                            activities, and they will be uploaded to the website, you can check after\n' +
            '                                            the event.'
        },
        {
            url: '#ansFive',
            ansid: 'ansFive',
            quesid: 'quesFive',
            question: 'Can I watch the live stream of the conference online?',
            ans: 'Yes, there will be live stream from beginning to the end!'
        },
    ],


    goldsponsor: [
        {
            imgurl: 'assets/images/partner/' + 'kyber_logo-2.svg',
            website: 'https://kyber.network/'
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        }
    ],
    silversponsor: [
        {
            imgurl: 'assets/images/partner/' + 'AKASHA.png',
            website: 'https://akasha.world/'
        },
        {
            imgurl: 'assets/images/partner/' + 'BookLocal.png',
            website: 'http://BookLocal.in'
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        }
    ],
    communitySponsor: [
        {
            imgurl: 'assets/images/partner/' + 'f2pool.jpg',
            website: 'https://www.f2pool.com',
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        },
        {
            imgurl: 'assets/images/partner/' + 'coming_soon_wh.jpg',
        }
    ],
    communitySupports: [
        {
            imgurl: 'assets/images/partner/' + 'apec.svg',
            imgwidth: 'width: 55px'
        },
        {
            imgurl: 'assets/images/partner/' + 'ethfans_logo.jpg',
            website: 'http://ethfans.org',
            imgwidth: 'position: relative;left: 40px'
        },
        {
            imgurl: 'assets/images/partner/' + 'hongkong_eth.jpg',
            website: 'https://www.meetup.com/Ethereum-Hong-Kong/',
            imgwidth: 'width: 50px'
        },
        {
            imgurl: 'assets/images/partner/' + 'taipei_eth.png',
            website: 'https://www.meetup.com/Taipei-Ethereum-Meetup/',
            imgwidth: 'width: 60px'
        },
        // {
        //     imgurl: 'assets/images/partner/' + 'asseth-logo.jpg',
        //     website: 'http://www.asseth.fr/',
        //     imgwidth: 'width: 110px;position: relative;left: 38px'
        // },
        {
            imgurl: 'assets/images/partner/' + 'ethereum-Singapore.jpg',
            website: 'https://www.meetup.com/Ethereum-Singapore/',
            imgwidth: 'width: 55px'
        },
        {
            imgurl: 'assets/images/partner/' + 'meetupko.svg',
            website: 'https://www.meetup.com/ko-KR/Seoul-Ethereum-Meetup/',
            imgwidth: 'width: 45px'
        },
        // {
        //     imgurl:'assets/images/partner/'+'',
        //     website:'',
        //     imgwidth:''
        // }
    ],

};

var vm = new Vue({
    el: '.wrap',
    data: data
});