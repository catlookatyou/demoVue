<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>
    <body class="font-sans">
        <div id="app">
            <div class="container px-8">
                <main class="flex">
                    <!-- 侧边栏（导航菜单） -->
                    <aside class="h-screen sticky top-0 w-1/3 pt-8">
                        <section class="mb-10">
                            <ul class="list-reset">
                                <h1 class="mb-4">
                                    貓
                                </h1>
                                <li class="leading-loose">
                                    <router-link to="/">Home</router-link>
                                </li>
                                <li class="leading-loose">
                                    <router-link :to="{ name: 'category', params: { name: '作品1號' }}">作品1號</router-link>
                                </li>
                                <li class="leading-loose">
                                    <router-link :to="{ name: 'category', params: { name: '作品2號' }}">作品2號</router-link>
                                </li>
                                <li class="leading-loose">
                                    <router-link :to="{ name: 'category', params: { name: '作品3號' }}">作品3號</router-link>
                                </li>
                                <li class="leading-loose">
                                    <router-link to="/about">About</router-link>
                                </li>
                            </ul>
                        </section>
                    </aside>

                    <!-- 主体内容 -->
                    <div class="w-2/3 lg:w-full primary pt-20">
                        <!-- 路由匹配到的组件将渲染在这里 -->
                        <router-view></router-view>
                    </div>
                    
                    <!-- 底部内容 -->
                    <footer></footer>
                </main>
            </div>
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>