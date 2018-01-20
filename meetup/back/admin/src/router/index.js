import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/page/index'
import Content from '@/page/content'
import Ticket from '@/page/ticket'
import Delivery from '@/page/delivery'
import Check from '@/page/check'
import About from '@/page/about'
import Schedule from '@/page/schedule'
import Location from '@/page/location'
import Email from '@/page/email'
import Login from '@/page/login'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            component: Index
        }, {
            path: '/content/:id',
            component: Content
        }, {
            path: '/ticket',
            component: Ticket
        }, {
            path: '/delivery',
            component: Delivery
        }, {
            path: '/check',
            component: Check
        }, {
            path: '/about',
            component: About
        }, {
            path: '/schedule',
            component: Schedule
        }, {
            path: '/location',
            component: Location
        }, {
            path: '/email',
            component: Email
        }, {
            path: '/login',
            component: Login
        }
    ]
})
