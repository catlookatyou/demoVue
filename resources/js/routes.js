export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: require('./components/Home').default
        },
        {
            path: '/about',
            component: require('./components/About').default
        },
        {
            path: '/new',
            component: require('./components/NewPost').default
        },
        {
            path: '/:name',
            name: 'category',
            component: require('./components/Category').default
        }
    ]
}