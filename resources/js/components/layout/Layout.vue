<template>
    <div class="container md:px-8">
        <main class="flex">
            <!-- sidbar -->
            <navigation :authenticated="authenticated"></navigation>
            <!-- content -->
            <div class="px-4 py-4 md:w-3/4 md:pt-12 md:ml-8">
                <!-- vue-router -->
                <router-view></router-view>
            </div>
        </main>
        <!-- bottom -->
        <!-- <bottom></bottom> -->
    </div>
</template>

<script>
import Navigation from './Navigation';
//import Bottom from './Bottom';

export default {
    components: {Navigation},
    data(){
        return{
            auth: false
        }
    },
    created(){
        this.loadUserAuthenticated();
    },
    computed: {
        authenticated() {
            return this.auth;
        }
    },
    methods: {
        loadUserAuthenticated(){
            axios.get('/api/user').then(resp => {
                console.log(resp);
                localStorage.setItem('authenticated', true);
                //console.log('layout: ' + localStorage.getItem('authenticated'));
            }).catch(err => {
                console.log('loadUserAuthenticated: ' + err);
            })
            this.auth = localStorage.getItem('authenticated');
        }
    }
}
</script>