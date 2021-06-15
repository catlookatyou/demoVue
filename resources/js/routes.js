export default {
    mode: 'history',
    linkActiveClass: 'font-bold',
    routes: [
        {
            path: '/',
            redirect: '/',
            component: require('./components/layout/Layout').default,
            children: [
                {
                    path: '/',
                    component: require('./components/Home').default
                },
                {
                    path: '/all',
                    component: require('./components/AllPost').default
                },
                {
                    path: '/about',
                    component: require('./components/About').default
                },
                {
                    path: '/adminLogin',
                    component: require('./components/Login').default,
                    beforeEnter: (to, from, next) => {
                        if(localStorage.getItem('authenticated')) {
                            //已登入，跳轉至首頁
                            next('/');
                        }else{
                            //進入登入頁面
                            next();
                        }
                    }
                },
                {
                    path: '/adminLogout',
                    component: require('./components/Logout').default,
                    beforeEnter: (to, from, next) => {
                        if(localStorage.getItem('authenticated')) {
                            //已登入，可訪問
                            next();
                        }else{
                            //進入登入頁面
                            next('/adminLogin');
                        }
                    }
                },
                {
                    path: '/new',
                    component: require('./components/NewPost').default,
                    beforeEnter: (to, from, next) => {
                        if(localStorage.getItem('authenticated')) {
                            //已登入，可訪問
                            next();
                        }else{
                            //進入登入頁面
                            next('/adminLogin');
                        }
                    }
                },
                {
                    path: '/edit/:id',
                    name: 'edit',
                    component: require('./components/EditPost').default,
                    beforeEnter: (to, from, next) => {
                        if(localStorage.getItem('authenticated')) {
                            //已登入，可訪問
                            next();
                        }else{
                            //進入登入頁面
                            next('/adminLogin');
                        }
                    }
                },
                {
                    path: '/:name',
                    name: 'category',
                    component: require('./components/Category').default
                }
            ]
        }
    ]
}