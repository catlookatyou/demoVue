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
            path: '/:name',
            name: 'category',
            component: require('./components/Category').default
        }
    ]
}