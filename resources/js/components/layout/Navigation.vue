<template>
    <aside class="w-1/4 pt-8">
        <section class="mb-10">
            <div class="fixed flex flex-col text-gray-900 bg-transparent">
                <div class="flex-shrink-0 px-4 py-4 flex flex-row items-center justify-between">
                    <h1 class="mb-4 text-xs text-gray-500">貓 Demo</h1>
                </div>
                <nav id="nav" class="flex-grow overflow-y-auto">
                    <router-link class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" to="/">Home</router-link>
                    <!--<router-link class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" to="/all">All</router-link>-->
                    <router-link class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: '作品1號' }}">作品1號</router-link>
                    <router-link class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: '作品2號' }}">作品2號</router-link>
                    <router-link class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" :to="{ name: 'category', params: { name: '作品3號' }}">作品3號</router-link>
                    <router-link class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" to="/about">About</router-link>

                    <a v-if="authenticated" class="text-gray-500 block px-4 pb-1.5 mt-8 text-xs">*adminMode</a>
                    <router-link v-if="authenticated" class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" to="/new">發布</router-link>
                    <!--<router-link v-if="!authenticated" class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" to="/adminLogin">登入</router-link>-->
                     <router-link v-if="authenticated" class="underline block px-4 pb-1.5 text-xs text-gray-500 bg-transparent focus:text-gray-900" to="/adminLogout">登出</router-link>
                </nav>
            </div>
        </section>
    </aside>
</template>

<script>
export default {
    props: ['authenticated'],
    created(){
        //this.checkAuthenticated();
    },
    methods: {
        checkAuthenticated(){
            this.authenticated = localStorage.getItem('authenticated');
            //console.log('auth: ' + localStorage.getItem('authenticated'));
        }
    }
}
</script>

<style>
.font-bold{
  font-weight: 400;
}
</style>