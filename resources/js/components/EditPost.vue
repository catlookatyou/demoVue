<template>
    <div v-if="loaded" class="bg-white flex flex-col">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <p class="text-gray-900 font-semibold text-xs mb-2"> {{ post.created_at }} </p>
                <div v-if="post.image">
                    <img :src="post.image" :title="post.title" class="object-contain w-auto h-auto mb-2" />
                </div>
            </div>
            <div class="w-full px-3 md:w-1/2 ">
                <label class="block text-gray-900 text-xs font-semibold mb-2">
                    標題
                </label>
                <input required v-model="title" class="appearance-none border w-full px-1 py-1 text-gray-900 text-xs" type="text">
                <error-msg v-if="errors.title" :error="errors.title"></error-msg>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 md:w-1/2">
                <label class="block text-gray-900 text-xs font-semibold mb-2">
                    分類
                </label>
                <select required v-model="category_id" class="appearance-none border w-full py-1 px-1 text-xs text-gray-900" style="background-color: white;">
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
                <error-msg v-if="errors.category_id" :error="errors.category_id"></error-msg>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 md:w-1/2">
                <label class="block text-gray-900 text-xs font-semibold mb-2">
                    圖片
                </label>
                <!--<div class="h-48 lg:w-48 flex-none bg-cover text-center overflow-hidden"
                    :style="'background-image: url(' + post.image  +')'" :title="post.title">
                </div>-->
                <input required ref="image" class="appearance-none border w-full py-1 px-1 text-xs text-gray-900" type="file">
                <error-msg v-if="errors.image" :error="errors.image"></error-msg>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block text-gray-900 text-xs font-semibold mb-2">
                    內容
                </label>
                <textarea required v-model="content" class="appearance-none border w-full py-1 px-1 text-xs text-gray-900 h-48" placeholder="content..."></textarea>
                <error-msg v-if="errors.content" :error="errors.content"></error-msg>
            </div>
        </div>
        <div class="flex items-center">
            <button @click="updatePost" type="button" class="border px-4 py-2 text-xs font-semibold mb-4 text-gray-900">
                編輯
            </button>
        </div>
        <div class="flex items-center">
            <button @click="deletePost" type="button" class="border px-4 py-2 text-xs font-semibold text-red-500">
                刪除
            </button>
        </div>
    </div>
    <loading v-else></loading>
</template>

<script>
//import FlashMessage from "./common/FlashMessage";
import Loading from "./common/Loading";
import ErrorMsg from "./common/ErrorMsg";
export default {
    components: {Loading, ErrorMsg},
    data() {
        return {
            post: null,
            loaded: false,
            categories:[],
            title: '',
            category_id: '',
            content: '',
            postId: '',
            errors: ''
        }
    },
    created() {
        this.postId = this.$route.params.id;
        this.loadPostsCategories();
        if (!this.loaded) {
            this.getPostData(this.postId);
        }
    },
    mounted() {
        /*if (!this.loaded) {
            this.getPostData(this.postId);
        }*/
    },
    computed: {
        /*categories() {
            return this.categories;
        }*/
    },
    methods: {
        getPostData(id){
            axios.get('/api/posts/' + id).then((resp) => {
                this.post = resp.data.data;
                this.title = this.post.title;
                //const category = this.post.category;
                //console.log('c:' + category);
                this.category_id = this.post.category.id;
                this.content = this.post.content;
                this.loaded = true;
            }).then((err) => {
                //console.log('post: ' + err);
            })
        },
        loadPostsCategories(){
            axios.get('/api/posts/categories').then((resp) => {
                this.categories = resp.data.data;
            }).catch((err) => {
                console.log('cat: ' + err);
            })
        },
        updatePost(){
            this.loaded = false;
            let formData = new FormData();
            //formData.append('title', this.title);
            formData.append('title', this.title ? this.title : '');
            formData.append('category_id', this.category_id);
            //formData.append('image', this.$refs.image.files[0]);
            formData.append('image', this.$refs.image.files[0] ? this.$refs.image.files[0] : '');
            //formData.append('content', this.content);
            formData.append('content', this.content ? this.content : '');
            formData.append('_method', 'PUT')
         
            axios.post('/api/posts/' + this.postId, formData).then((resp) => {
                if (resp.data.success === true) {
                    //this.loaded = true;
                    console.log('update success!');
                    this.$router.push('/' + this.categories[this.category_id-1].name);
                } else {
                    console.log('update failed!');
                }
            }).catch((err) => {
                this.loaded = true;
                //console.log('err = ' + JSON.stringify(err.response.data.errors));
                this.errors = err.response.data.errors;
            })
        },
        deletePost(){
            this.loaded = false;
            axios.delete('/api/posts/' + this.postId).then((resp) => {
                if(resp.data.success === true){
                    //this.loaded = true;
                    console.log('delete success!');
                    window.history.back();
                }else{
                    console.log('delete failed!');
                }
            }).catch((err) => {
                console.log('err = '.err);
            })
        }
    }
}
</script>