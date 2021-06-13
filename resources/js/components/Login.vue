<template>
    <div v-if="loaded" class="bg-white shadow-md rounded mt-6 px-8 pt-6 pb-8 mb-6 flex flex-col">
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2">
                Email
            </label>
            <input v-model="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="email" placeholder="Email">
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-sm font-bold mb-2">
                Password
            </label>
            <input v-model="password" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" type="password">
        </div>
        <div class="flex items-center justify-between">
            <button @click="login" type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                登入
            </button>
        </div>
    </div>
    <loading v-else></loading>
</template>

<script>
import Loading from "./common/Loading";

export default {
    components: {Loading},
    data(){
        return{
            email: '',
            password: '',
            submitted: false,
            loaded: true,
        }
    },
    created(){
        this.loadLoginPage();
        //localStorage.setItem('authenticated', false);
    },
    computed: {
        /*authenticated(){
            return localStorage.getItem('authenticated');
        }*/
    },
    methods: {
        loadLoginPage(){
            axios.get('/sanctum/csrf-cookie').then(resp => {
                console.log('csrf success!');
            }).catch(err => {
                console.log('csrf: ' + err);
            })
        },
        login(){
            let formData = new FormData();
            formData.append('email', this.email);
            formData.append('password', this.password);
            axios.post('/login', formData).then(resp => {
                this.loaded = false;
                //儲存登入狀態到localStorage，以便在前端路由識別登入狀態
                localStorage.setItem('authenticated', true);
                //首頁
                window.location.href = '/';
                //this.$router.push('/');
            }).catch(err => {
                console.log('login: ' + err);
            });
            this.submitted = true;
        }
    }
}
</script>