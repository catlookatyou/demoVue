<template>
    <h1>Post: {{ name }}</h1>
</template>

<script>
export default {
    data () {
        return {
            name: ''
        }
    },
    mounted () {
        this.updatePostName();
    },
    watch: {
        '$route': 'updatePostName'
    },
    methods: {
        updatePostName ()  {
            this.name = this.$route.params.name.toUpperCase();
        },
    }
}
</script>