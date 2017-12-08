var data = {
    contents: [

        {
            id: '6',
            date: '2017.7.29',
            cover: 'images/knowledge/z2-thumb.jpg',
            title: 'Quadratic Arithmetic Programs: from Zero to Hero',
            titlecn: '最新以太坊｜零知识证明专题系列报告（二）： 二次方程式算术的编程：从零到“灵”',
            intro: 'There has been a lot of interest lately in' +
            '                                    the technology behind zk-SNARKs, and people are increasingly trying' +
            '                                    to demystify something that many have come to call “moon math” due' +
            '                                    to its perceived sheer indecipherable complexity.',
            introcn: '最近，zk-SNARKs背后的技术引起了不少人的兴趣。越来越多的人想要去解开这一被誉为“月亮数学（因为它实在复杂得让人摸不着头脑）”的东西的神秘面纱。',
            url: 'knowledge/qadratic_arithmetic_programs' + '.html',
            urlcn: 'knowledge/qadratic_arithmetic_programs' + '_cn.html'
        },
        {
            id: '3',
            date: '2017.7.5',
            cover: 'images/knowledge/z1-thumb.jpg',
            title: 'A Prehistory of The Ethereum Protocol',
            titlecn: '以太坊协议的发展历程',
            intro: 'Although the ideas behind the current' +
            '                                    Ethereum protocol have largely been stable for two years, Ethereum' +
            '                                    did not emerge all at once, in its current conception and fully' +
            '                                    formed.',
            introcn: '虽然在两年前，以太坊当前协议背后的想法就已经基本稳定下来，但以太坊并不是一出现就形成了现在的概念和规模。在区块链推出前，该协议经历了许多重大的演变和设计决策。',
            url: 'knowledge/a_prehistory_of_the_ethereum_protocol' + '.html',
            urlcn: 'knowledge/a_prehistory_of_the_ethereum_protocol' + '_cn.html'
        },
        {
            id: '2',
            date: '2017.6.16',
            cover: 'images/knowledge/0-52_QQpw7YGDelBvo_thumb.jpg',
            title: 'White Paper',
            titlecn: '以太坊白皮书',
            intro: 'Satoshi Nakamoto\'s development of Bitcoin in 2009 has often been hailed as a radical' +
            '                                    development in money and currency, being the first example of a digital asset which' +
            '                                    simultaneously has no backing or "[intrinsic value]" and no centralized issuer or' +
            '                                    controller.',
            introcn: '当中本聪在2009年1月启动比特币区块链时，他同时向世界引入了两种未经测试的革命性的新概念。第一种就是比特币（bitcoin），一种去中心化的点对点的网上货币，在没有任何资产担保、内在价值或者中心发行者的情况下维持着价值。',
            url: 'knowledge/white_paper' + '.html',
            urlcn: 'knowledge/white_paper' + '_cn.html'
        },
        {
            id: '1',
            date: '2017.6.1',
            cover: 'images/knowledge/information_technology_thumb.jpg',
            title: 'Explaining The Ethereum Namespace Auction',
            titlecn: '最新以太坊 | 以太坊命名空间拍卖',
            intro: 'The first portion of the post provides the motivation, if you just want the nitty' +
            '                                    gritty, skip ahead to “Ownership of names”.',
            introcn: '本文的第一部分单纯阐述了我们的动机，如果你只是想了解具体的细节，那么可以直接跳到“名称所有权”的章节。',
            url: 'knowledge/explaining_the_ethereum_namespace_auction' + '.html',
            urlcn: 'knowledge/explaining_the_ethereum_namespace_auction' + '_cn.html'
        }


    ]

};

var vm = new Vue({
    el: '#gtco-maine',
    data: data
});
