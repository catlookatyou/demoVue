<template>
    <!--keep loading-->
    <loading></loading>
</template>

<script>
import Loading from "./common/Loading";
export default {
    components: {Loading},
    created() {
        this.logout();
    },
    methods: {
        logout(){
            axios.post('/adminLogout').then(resp => {
                localStorage.removeItem('authenticated');
                window.location.href = '/';
            }).catch(err => {
                console.log(err);
            })
        }
    }
}
</script>
