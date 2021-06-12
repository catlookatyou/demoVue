<template>
    <div v-if="loaded" class="bg-white shadow-md rounded mt-2 px-8 pt-6 pb-8 mb-6 flex flex-col">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Title
                </label>
                <input required v-model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" placeholder="title">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 md:w-1/2">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Category
                </label>
                <select required v-model="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker">
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 md:w-1/2">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Image
                </label>
                <div class="h-48 lg:w-48 flex-none bg-cover text-center overflow-hidden opacity-75"
                    :style="'background-image: url(' + post.image  +')'" :title="post.title">
                </div>
                <input required ref="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="file">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Content
                </label>
                <textarea required v-model="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker h-48" placeholder="content..."></textarea>
            </div>
        </div>
        <div class="flex items-center">
            <button @click="updatePost" type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                編輯
            </button>
        </div>
        <div class="flex items-center">
            <button @click="deletePost" type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                刪除
            </button>
        </div>
    </div>
    <loading v-else></loading>
</template>

<script>
//import FlashMessage from "./common/FlashMessage";
import Loading from "./common/Loading";
export default {
    components: {Loading},
    data() {
        return {
            post: null,
            loaded: false,
            categories:[],
            title: '',
            category_id: '',
            content: '',
            postId: ''
        }
    },
    created() {
        this.postId = this.$route.params.id;
        this.loadPostsCategories();
    },
    mounted() {
        if (!this.loaded) {
            this.getPostData(this.postId);
        }
    },
    computed: {
        categories() {
            return this.categories;
        }
    },
    methods: {
        getPostData(id){
            axios.get('/api/posts/' + id).then((resp) => {
                this.post = resp.data.data;
                this.loaded = true;
            }).then((err) => {
                console.log(err);
            })
        },
        loadPostsCategories(){
            axios.get('/api/posts/categories').then((resp) => {
                this.categories = resp.data.data;
            }).catch((err) => {
                console.log(err);
            })
        },
        updatePost(){
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('category_id', this.category_id);
            formData.append('image', this.$refs.image.files[0]);
            formData.append('content', this.content);
            formData.append('_method', 'PUT')
         
            axios.post('/api/posts/' + this.postId, formData).then((resp) => {
                if (resp.data.success === true) {
                    console.log('update success!');
                } else {
                    console.log('update failed!');
                }
            }).catch((err) => {
                console.log('err = '.err);
            })
        },
        deletePost(){
            axios.delete('/api/posts/' + this.postId).then((resp) => {
                if(resp.data.success === true){
                    console.log('delete success!');
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