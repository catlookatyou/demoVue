<template>
    <div class="w-full mb-5"> <!--flex-->
        <div v-if="post.image">
            <img :src="post.image" :title="post.title" class="object-contain w-auto h-auto mb-4" />
        </div>
        <div class="bg-white flex flex-col justify-between leading-normal">
            <div>
                <div v-if="post.title" class="text-gray-900 font-semibold text-xs mb-2">
                    <!--<router-link :to="{ name: 'post', params: { id: post.id }}">-->
                        {{ post.title }}
                    <!--</router-link>-->
                </div>
                <!--<p class="text-gray-900 text-base">
                    {{ post.content }}
                </p>-->
                <div v-if="post.content" v-html="post.content" class="font-light text-xs text-gray-500"></div>
            </div>
            <div class="flex mt-2">
                <!--<img :src="post.author.avatar_url" class="h-10 w-10 rounded-full mr-2 object-cover" />-->
                <div>
                    <!--<p class="font-semibold text-gray-900 text-xs capitalize"> {{ post.author.name }} </p>-->
                    <!--<p class="text-gray-600 text-xs"> {{ post.created_at }} </p>-->
                    <router-link v-if="authenticated" :to="{ name: 'edit', params: { id: post.id }}">
                       <p class="underline text-gray-900 text-xs">編輯</p>
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
        if(this.post.content)
            this.post.content = marked(this.post.content);
    }
}
</script>