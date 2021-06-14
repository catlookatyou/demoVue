<template>
    <div class="border w-full lg:flex mb-5">
        <div v-if="post.image" class="h-48 lg:w-48 flex-none bg-cover text-center overflow-hidden opacity-75"
             :style="'background-image: url(' + post.image  +')'" :title="post.title">
        </div>
        <div class="bg-white px-4 flex flex-col justify-between leading-normal pt-2 pb-2">
            <div>
                <div class="mt-3 md:mt-0 text-gray-700 font-bold text-base mb-2">
                    <!--<router-link :to="{ name: 'post', params: { id: post.id }}">-->
                        {{ post.title }}
                    <!--</router-link>-->
                </div>
                <!--<p class="text-gray-700 text-base">
                    {{ post.content }}
                </p>-->
                <div v-html="post.content" class="text-sm"></div>
            </div>
            <div class="flex mt-3">
                <!--<img :src="post.author.avatar_url" class="h-10 w-10 rounded-full mr-2 object-cover" />-->
                <div>
                    <!--<p class="font-semibold text-gray-700 text-sm capitalize"> {{ post.author.name }} </p>-->
                    <p class="text-gray-600 text-xs"> {{ post.created_at }} </p>
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