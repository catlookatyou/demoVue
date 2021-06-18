<template>
    <div v-if="loaded">
        <h1 class="text-gray-500 mb-8 text-xs font-semibold">{{ name }}</h1>
        <post-list v-if="loaded" :posts="posts"></post-list>
    </div>
    <loading v-else></loading>
</template>

<script>
import PostList from './common/List';
import Loading from "./common/Loading";

export default {
    components: {PostList, Loading},
    data () {
        return {
            name: '',
            posts: [],
            loaded: false
        }
    },
    mounted () {
        if (!this.loaded) {
            this.updateCategoryName();
        }
    },
    watch: {
        '$route': 'updateCategoryName'
    },
    methods: {
        updateCategoryName ()  {
            this.name = this.$route.params.name.toUpperCase();
            this.loaded = false;
            this.getCategoryPosts();
        },
        getCategoryPosts() {
            axios.get('/api/posts/category/' + this.name).then((resp) => {
                this.posts = resp.data.data;
                this.loaded = true;
            }).catch((err) => {
                console.log(err);
            })
        }
    }
}
</script>

<style>
/*
h1{
    color:#63bea8;
}
*/
</style>