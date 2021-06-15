<template>
    <div class="w-full mb-5"> <!--flex-->
        <div v-if="post.image">
            <img :src="post.image" :title="post.title" class="object-contain w-auto h-auto" />
        </div>
        <div class="bg-white flex flex-col justify-between leading-normal">
            <div>
                <div class="text-gray-700 font-bold text-sm mt-2 mb-2">
                    <!--<router-link :to="{ name: 'post', params: { id: post.id }}">-->
                        {{ post.title }}
                    <!--</router-link>-->
                </div>
                <!--<p class="text-gray-700 text-base">
                    {{ post.content }}
                </p>-->
                <div v-html="post.content" class="text-xs"></div>
            </div>
            <div class="flex mt-2">
                <!--<img :src="post.author.avatar_url" class="h-10 w-10 rounded-full mr-2 object-cover" />-->
                <div>
                    <!--<p class="font-semibold text-gray-700 text-xs capitalize"> {{ post.author.name }} </p>-->
                    <!--<p class="text-gray-600 text-xs"> {{ post.created_at }} </p>-->
                    <router-link v-if="authenticated" :to="{ name: 'edit', params: { id: post.id }}">
                       <p class="text-blue-500 text-xs">編輯</p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import marked from "marked";
export default {
    props: ['post', 'authenticated'],
    created(){
        //covert markdown to html
        this.post.content = marked(this.post.content);
    }
}
</script>