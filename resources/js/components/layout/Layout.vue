<template>
    <div class="container md:px-8">
        <main class="flex">
            <!-- sidbar -->
            <navigation :authenticated="auth"></navigation>
            <!-- content -->
            <div class="px-4 py-4 w-full md:w-3/4 md:pt-12 md:ml-8">
                <!-- vue-router -->
                <router-view></router-view>
                <!-- bottom -->
                <!--<bottom></bottom>-->
            </div>
        </main>
    </div>
</template>

<script>
import Navigation from './Navigation';
import Bottom from './Bottom';

export default {
    components: {Navigation, Bottom},
    data(){
        return{
            auth: false
        }
    },
    created(){
        this.loadUserAuthenticated();
    },
    computed: {
        /*authenticated() {
            return this.auth;
        }*/
    },
    methods: {
        loadUserAuthenticated(){
            axios.get('/api/user', {withCredentials: true}).then(resp => {  // /api/user
                console.log(resp);
                localStorage.setItem('authenticated', true);
                //console.log('layout_auth: ' + localStorage.getItem('authenticated'));
                this.auth = localStorage.getItem('authenticated');
                //console.log('layout_this.auth: ' + this.auth);
            }).catch(err => {
                localStorage.removeItem('authenticated');
                console.log('loadUserAuthenticated: ' + err);
                this.auth = localStorage.getItem('authenticated');
                //console.log('layout_this.auth: ' + this.auth);
            })
        }
    }
}
</script>