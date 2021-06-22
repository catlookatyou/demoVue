<template>
    <aside class="md:w-1/4 md:pt-8">
        <section class="mb-10">
            <div class="fixed flex flex-col rounded-full border border-gray-900 text-gray-900 h-8 w-8 md:hidden" style="top:90%; right:3%">
                <button @click="navToggle" id="toggle">
                    ...
                </button>
            </div>
            <div id="navDiv" class="hidden fixed flex flex-col mt-4 text-gray-300 bg-transparent text-base md:flex md:text-xs">
                <!--<div class="flex-shrink-0 px-4 py-4 flex flex-row items-center justify-between">
                    <h1 class="mb-4">卡路阿泥 Demo</h1>
                </div>-->
                <nav id="nav" class="flex-grow overflow-y-auto">
                    <router-link class="underline block px-4 pb-8 bg-transparent focus:text-gray-900" to="/">Index</router-link>
                    <!--<router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" to="/all">All</router-link>-->
                    <router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: 'Demo1' }}">Demo 1</router-link>
                    <router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: 'Demo2' }}">Demo 2</router-link>
                    <router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: 'Demo3' }}">Demo 3</router-link>
                    <router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: 'Demo4' }}">Demo 4</router-link>
                    <router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: 'Demo5' }}">Demo 5</router-link>
                    <router-link class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" to="/about">About</router-link>

                    <a v-if="authenticated" class="block px-4 pb-1.5 mt-8">*adminMode</a>
                    <router-link v-if="authenticated" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" to="/new">發布</router-link>
                    <!--<router-link v-if="!authenticated" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" to="/adminLogin">登入</router-link>-->
                    <router-link v-if="authenticated" class="underline block px-4 pb-1.5 bg-transparent focus:text-gray-900" to="/adminLogout">登出</router-link>
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