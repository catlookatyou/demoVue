<template>
    <aside class="w-1/4 pt-8">
        <section class="mb-10">
            <div class="fixed flex flex-col md:w-64 text-gray-700 bg-transparent">
                <div class="flex-shrink-0 px-4 py-4 flex flex-row items-center justify-between">
                    <h1 class="mb-4">貓</h1>
                </div>
                <nav class="flex-grow md:block pb-4 md:pb-0 md:overflow-y-auto">
                    <router-link class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent rounded-lg" to="/">Home</router-link>
                    <!--<router-link class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent rounded-lg" to="/all">All</router-link>-->
                    <router-link class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent rounded-lg" :to="{ name: 'category', params: { name: '作品1號' }}">作品1號</router-link>
                    <router-link class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent rounded-lg" :to="{ name: 'category', params: { name: '作品2號' }}">作品2號</router-link>
                    <router-link class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent rounded-lg" :to="{ name: 'category', params: { name: '作品ˇ號' }}">作品3號</router-link>
                    <router-link class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent rounded-lg" to="/about">About</router-link>

                    <a v-if="authenticated" class="text-blue-500 block px-4 py-2 mt-8 text-xs font-semibold">*adminMode</a>
                    <router-link v-if="authenticated" class="block px-4 py-2 mt-2 text-xs font-semibold text-blue-500 bg-transparent rounded-lg" to="/new">發布</router-link>
                    <!--<router-link v-if="!authenticated" class="block px-4 py-2 mt-2 text-xs font-semibold text-gray-900 bg-transparent" to="/adminLogin">登入</router-link>-->
                     <router-link v-if="authenticated" class="block px-4 py-2 mt-2 text-xs font-semibold text-blue-500 bg-transparent rounded-lg" to="/adminLogout">登出</router-link>
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