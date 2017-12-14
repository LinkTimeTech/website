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
            ans: 'Purchase will be open on January 1, 2018. Please stay tuned.\n'
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
    ]

};

var vm = new Vue({
    el: '.wrap',
    data: data
});