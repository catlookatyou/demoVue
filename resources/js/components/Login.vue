<template>
    <div v-if="loaded" class="bg-white flex flex-col">
        <div class="mb-4">
            <label class="block text-grey-darker text-xs font-bold mb-2">
                Email
            </label>
            <input v-model="email" class="md:w-1/2 appearance-none border w-full text-grey-darker text-xs px-1 py-1" type="email">
            <error-msg v-if="errors.email" :error="errors.email"></error-msg>
        </div>
        <div class="mb-6">
            <label class="block text-grey-darker text-xs font-bold mb-2">
                Password
            </label>
            <input v-model="password" class="md:w-1/2 appearance-none border w-full text-grey-darker text-xs px-1 py-1" type="password">
            <error-msg v-if="errors.password" :error="errors.password"></error-msg>
        </div>
        <div class="flex items-center justify-between">
            <button @click="login" type="button" class="text-xs border px-4 py-2 font-bold">
                登入
            </button>
        </div>
    </div>
    <loading v-else></loading>
</template>

<script>
import Loading from "./common/Loading";
import ErrorMsg from "./common/ErrorMsg";
export default {
    components: {Loading, ErrorMsg},
    data(){
        return{
            email: '',
            password: '',
            submitted: false,
            loaded: true,
            errors: '',
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
            this.loaded = false;
            let formData = new FormData();
            formData.append('email', this.email);
            formData.append('password', this.password);
            axios.post('/adminLogin', formData).then(resp => {
                //儲存登入狀態到localStorage，以便在前端路由識別登入狀態
                localStorage.setItem('authenticated', true);
                //首頁
                window.location.href = '/';
                //this.$router.push('/');
            }).catch(err => {
                this.loaded = true;
                //console.log('err = ' + JSON.stringify(err.response.data.errors));
                this.errors = err.response.data.errors;
                //console.log('login: ' + err);
            });
            this.submitted = true;
        }
    }
}
</script>