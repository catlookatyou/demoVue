<template>
    <div class="container px-8">
        <main class="flex">
            <!-- sidbar -->
            <navigation :authenticated="authenticated"></navigation>
            <!-- content -->
            <div class="w-4/5 pt-12 px-4 py-4">
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