<template>
    <div v-if="loaded" class="bg-white flex flex-col">
        <div v-if="loginError">
            <a class="text-xs text-red-500 font-semibold">登入失敗!</a>
        </div>
        <div class="mb-4">
            <label class="block text-gray-900 text-xs font-semibold mb-2">
                Email
            </label>
            <input v-model="email" class="md:w-1/2 appearance-none border w-full text-gray-900 text-xs px-1 py-1" type="email">
            <error-msg v-if="errors.email" :error="errors.email"></error-msg>
        </div>
        <div class="mb-6">
            <label class="block text-gray-900 text-xs font-semibold mb-2">
                Password
            </label>
            <input v-model="password" class="md:w-1/2 appearance-none border w-full text-gray-900 text-xs px-1 py-1" type="password">
            <error-msg v-if="errors.password" :error="errors.password"></error-msg>
        </div>
        <div class="flex items-center justify-between">
            <button @click="login" type="button" class="text-gray-900 text-xs border px-4 py-2 font-semibold">
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
            loginError: false,
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
                if (resp.data.success === true){
                    //儲存登入狀態到localStorage，以便在前端路由識別登入狀態
                    localStorage.setItem('authenticated', true);
                    this.loadUserAuthenticated();
                    //首頁
                    //window.location.href = '/';
                    //this.$router.push('/');
                }else{
                    this.loaded = true;
                    this.loginError = true;
                    console.log("login failed!");
                }
            }).catch(err => {
                this.loaded = true;
                //console.log('err = ' + JSON.stringify(err.response.data.errors));
                this.errors = err.response.data.errors;
                //console.log('login: ' + err);
            });
            this.submitted = true;
        },
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