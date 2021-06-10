<template>
    <div>
        <list-item v-for="post in posts" :key="post.id" :post="post"></list-item>
        <div v-if="links" class="w-full text-center mx-auto">
            <button
                v-if="links.next"
                @click="loadMorePosts"
                type="button"
                class="border border-black-500 bg-black-500 text-black rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray focus:outline-none focus:shadow-outline"
            >
                more
            </button>
        </div>
    </div>
</template>

<script>
import ListItem from "./ListItem";

export default {
    components: {ListItem},
    //links, loadMorePosts()用來處理分頁
    props: ['posts', 'links'],
    methods: {
        loadMorePosts(){
            this.$emit('loadMorePosts', this.links.next);
        }
    }
}
</script>