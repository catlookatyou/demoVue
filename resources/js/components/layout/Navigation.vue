<template>
    <aside class="md:w-1/4 md:pt-8">
        <section class="mb-10">
            <div class="fixed flex flex-col rounded-full text-4xl border-gray-900 text-gray-200 h-8 w-8 z-50 md:hidden" style="bottom:3%; right:3%">
                <a @click="navToggle" id="toggle" class="text-center"> <!-- border -->
                    ☰
                </a>
            </div>
            <div id="navDiv" class="hidden fixed flex flex-col text-gray-300 bg-black opacity-75 w-full h-full text-base md:text-gray-900 md:bg-transparent md:opacity-50 md:w-1/6 md:h-full md:flex md:text-xs">
                <!--<div class="flex-shrink-0 px-4 py-4 flex flex-row items-center justify-between">
                    <h1 class="mb-4">卡路阿泥 Demo</h1>
                </div>-->
                <nav id="nav" class="flex-grow overflow-y-auto">
                    <router-link @click.native="navToggle" class="underline block mt-4 px-4 pb-8 bg-transparent focus:text-gray-300 md:hover:text-gray-300" to="/">Index</router-link>
                    <!--<router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900 md:hover:text-gray-900" to="/all">All</router-link>-->
                    <router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" :to="{ name: 'category', params: { name: 'Demo1' }}">Demo 1</router-link>
                    <router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" :to="{ name: 'category', params: { name: 'Demo2' }}">Demo 2</router-link>
                    <router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" :to="{ name: 'category', params: { name: 'Demo3' }}">Demo 3</router-link>
                    <!--<router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" :to="{ name: 'category', params: { name: 'Demo4' }}">Demo 4</router-link>
                    <router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" :to="{ name: 'category', params: { name: 'Demo5' }}">Demo 5</router-link>-->
                    <router-link @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" to="/about">About</router-link>

                    <a v-if="authenticated" class="block px-4 pb-1.5 mt-8">*adminMode</a>
                    <router-link v-if="authenticated" @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" to="/new">發布</router-link>
                    <!--<router-link v-if="!authenticated" @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" to="/adminLogin">登入</router-link>-->
                    <router-link v-if="authenticated" @click.native="navToggle" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-300 md:hover:text-gray-300" to="/adminLogout">登出</router-link>
                </nav>
            </div>
        </section>
    </aside>
</template>

<script>
export default {
    props: ['authenticated'],
    created(){
        this.checkAuthenticated();
    },
    methods: {
        checkAuthenticated(){
            this.authenticated = localStorage.getItem('authenticated');
            //console.log('nav_prop: ' + this.authenticated);
            //console.log('nav_auth: ' + localStorage.getItem('authenticated'));
        },
        navToggle(){
            document.getElementById("navDiv").classList.toggle("hidden");
        }
    }
}
</script>

<style>
.font-bold{
  font-weight: 400;
}
</style>