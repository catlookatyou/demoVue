<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div id="app">
            <!-- 路由匹配到的组件将渲染在这里 -->
            <router-view></router-view>

            <hr>

            <!-- 使用 router-link 组件来导航 -->
            <!-- 通过传入 `to` 属性指定链接 -->
            <!-- <router-link> 默认会被渲染成一个 `<a>` 标签 -->
            <router-link to="/">Home</router-link>
             <!-- 传递路由参数到命名路由 -->
            <router-link :to="{ name: 'post', params: { name: 'helloworld' }}">helloworld</router-link>
            <router-link :to="{ name: 'post', params: { name: 'cat' }}">cat</router-link>
            <router-link to="/about">About</router-link>
        </div>

        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>