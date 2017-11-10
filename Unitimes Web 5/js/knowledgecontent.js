var data = {
    contents: [
        {
            top: '1',
            id: '13',
            date: '',
            cover: 'images/knowledge/chain_Relays.jpg',
            title: 'Chain Relays or a Practical Approach for Cross-chain Trades',
            titlecn: '链中继技术：实现跨链交易的实用方案',
            intro: 'A chain relay for a blockchain X, or X-relay for brevity, is a way to implement and maintain light client for blockchain X within an Ethereum smart contract. The contract essentially stores all block headers which are much lighter than the size of the chain state or the entire blockchain, hence the term light client. With the block headers, it is sufficient to verify if a transaction has been included, or even the blockchain state, depending on what are stored in a block header. Thus, X-relay allows any contract in Ethereum to verify transactions, and sometimes even account states of the blockchain X via the implemented light client.',
            introcn: '用于区块链X的链中继技术，简称X-Relay，是在以太坊智能合约中实施和维护区块链X轻客户端的一种方式',
            url: 'knowledge/chain_relays_or_a_practical_approach_for_cross_chain_trades' + '.html',
            urlcn: 'knowledge/chain_relays_or_a_practical_approach_for_cross_chain_trades' + '_cn.html'
        },
        {
            top: '1',
            id: '12',
            date: '',
            cover: 'images/knowledge/what_is_ethereum_metropolis.jpg',
            title: 'What is Ethereum Metropolis: The Ultimate Guide',
            titlecn: '什么是以太坊大都会：终极指南',
            intro: 'Metropolis is upon us! Or at least it’s the first iteration. After a lot of deliberations and updates, the time has finally arrived for the next big jump. There is a lot of buzz going on right now and for good reason. The last time Ethereum did a network shift i.e. from Frontier to Homestead, the price jumped more than 100% from $12 to $30.',
            introcn: '作为以太坊的里程碑事件，大都会终于要来到我们身边了。以太坊开发团队计划于9月18日在测试网络上测试"大都会"（Metropolis），测试至少3周时间。如果测试正常，"大都会"将被部署在主网络。所以，升级到"大都会"阶段的最早时间是10月9日（译者注：实际部署时间已经推迟）。',
            url: 'knowledge/what_is_ethereum_metropolis' + '.html',
            urlcn: 'knowledge/what_is_ethereum_metropolis' + '_cn.html'
        },
        {
            id: '11',
            date: '',
            cover: 'images/knowledge/ethereum_history.jpg',
            title: 'What is Ethereum?',
            titlecn: '以太坊历史',
            intro: 'Ethereum, like any advanced system, will mean different things to different people. As you read this section, some bits may not resonate with you or even make sense. That is fine, just skip to the next paragraph and hopefully that one will be more enlightening. If you reach the end of this section and still feel confused, then jump on a forum and start asking questions',
            introcn: '项目概况 2013年年末，以太坊创始人Vitalik Buterin发布了以太坊初版白皮书，在全球的密码学货币社区陆续召集到一批认可以太坊理念的开发者，启动了项目。',
            url: 'knowledge/what_is_ethereum' + '.html',
            urlcn: 'knowledge/what_is_ethereum' + '_cn.html'
        },
        {
            id: '10',
            date: '',
            cover: 'images/knowledge/3151510038262_.pic.jpg',
            title: '',
            titlecn: '智能合约',
            intro: '',
            introcn: '智能合约是 1990s 年代由尼克萨博提出的理念，几乎与互联网同龄。由于缺少可信的执行环境，智能合约并没有被应用到实际产业中，自比特币诞生后，人们认识到比特币的底层技术区块链天生可以为智能合约提供可信的执行环境，以太坊首先看到了区块链和智能合约的契合，发布了白皮书《以太坊：下一代智能合约和去中心话应用平台》，并一直致力于将以太坊打造成最佳智能合约平台，所以比特币引领区块链，以太坊复活智能合约。',
            url: 'knowledge/' + '.html',
            urlcn: 'knowledge/smart_contract' + '_cn.html'
        },
        {
            id: '9',
            date: '2015.11.6',
            cover: 'images/knowledge/state_Channels.jpg',
            title: 'State Channels',
            titlecn: '状态通道',
            intro: 'This post is the second in a series which aims to clarify uncommon terms that I use. Like those that follow, this term has proven useful in my own understanding of blockchains and blockchain-related technologies. I hope that by clearly explaining it here, the term can become useful for others as well.',
            introcn: '这一篇文章，我们将与大家分享区块链的通道技术。',
            url: 'knowledge/state_channels' + '.html',
            urlcn: 'knowledge/state_channels' + '_cn.html'
        },
        {
            id: '8',
            date: '',
            cover: 'images/knowledge/z6-thumb.jpg',
            title: '',
            titlecn: '到底什么是以太坊（Ethereum）？',
            intro: '',
            introcn: '比特币长达8年的成功，将其底层的区块链技术推上了历史的舞台。',
            url: 'knowledge/' + '.html',
            urlcn: 'knowledge/what_on_earth_is_ethereum' + '_cn.html'
        },
        {
            id: '7',
            date: 'Jan 19, 2017',
            datecn: '2017.01.19',
            cover: 'images/knowledge/z5-thumb.jpg',
            title: 'An Update on Integrating Zcash on Ethereum' +
            '                                (ZoE)',
            titlecn: '最新以太坊｜零知识证明专题系列报告（一）： 以太坊整合Zcash技术的最新进展（ZoE）',
            intro: 'Members of the Ethereum R&D team and the' +
            '                                    Zcash Company are collaborating on a research project addressing the' +
            '                                    combination of programmability and privacy in blockchains.',
            introcn: '以太坊研发团队的成员和Zcash公司正在一个研究项目上展开合作，该项目旨在解决区块链可编程性和隐私保护功能结合的难题。',
            url: 'knowledge/an_update_on_Integrating' + '.html',
            urlcn: 'knowledge/an_update_on_Integrating' + '_cn.html'
        },
        {
            id: '6',
            date: '',
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
            id: '5',
            date: '',
            cover: 'images/knowledge/z3-thumb.jpg',
            title: 'Exploring Elliptic Curve Pairings',
            titlecn: '最新以太坊｜零知识证明专题系列报告（三）：' +
            '                                对椭圆曲线配对的探索（前方高能：一大波数学公式来袭！！）',
            intro: 'One of the key cryptographic primitives' +
            '                                    behind various constructions, including deterministic threshold' +
            '                                    signatures, zk-SNARKs and other simpler forms of zero-knowledge' +
            '                                    proofs is the elliptic curve pairing.',
            introcn: '本文将探讨各种结构（包括确定性阈值签名，zk-SNAR以及零知识证明的其它更简单形式）背后的关键密码原语的一员——椭圆曲线配对。',
            url: 'knowledge/exploring_elliptic_curve' + '.html',
            urlcn: 'knowledge/exploring_elliptic_curve' + '_cn.html'
        },
        {
            id: '4',
            date: '',
            cover: 'images/knowledge/z4-thumb.jpg',
            title: 'Zk-SNARKs: Under the Hall Hood.',
            titlecn: '最新以太坊｜零知识证明专题系列报告（四）： 算法迷踪',
            intro: 'This is the third part of a series of' +
            '                                    articles explaining how the technology behind zk-SNARKs works; the' +
            '                                    previous articles on quadratic arithmetic programs and elliptic' +
            '                                    curve pairings are required reading, and this article will assume' +
            '                                    knowledge of both concepts.',
            introcn: '本文是阐述zk-SNARKs技术原理的系列文章的第三部分。前两部分的文章分别阐述了二次算术程序（quadratic arithmetic' +
            '                                    program，QAP）以及椭圆曲线配对的运作原理，也是本文的基础。',
            url: 'knowledge/zk_snarks_under_the_hood' + '.html',
            urlcn: 'knowledge/zk_snarks_under_the_hood' + '_cn.html'
        },
        {
            id: '3',
            date: '',
            cover: 'images/knowledge/z1-thumb.jpg',
            title: 'A Prehistory of the Ethereum Protocol',
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
            date: '',
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
            date: '',
            cover: 'images/knowledge/information_technology_thumb.jpg',
            title: 'Explaining the Ethereum Namespace Auction',
            titlecn: '最新以太坊 | 以太坊命名空间拍卖',
            intro: 'The first portion of the post provides the motivation, if you just want the nitty' +
            '                                    gritty, skip ahead to “Ownership of names”.',
            introcn: '本文的第一部分单纯阐述了我们的动机，如果你只是想了解具体的细节，那么可以直接跳到“名称所有权”的章节。',
            url: 'knowledge/explaining_the_ethereum_namespace_auction' + '.html',
            urlcn: 'knowledge/explaining_the_ethereum_namespace_auction' + '_cn.html'
        }


    ]

}

var vm = new Vue({
    el: '#gtco-maine',
    data: data
})
