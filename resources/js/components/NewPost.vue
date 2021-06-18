<template>
    <div v-if="loaded" class="bg-white flex flex-col">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 md:w-1/2">
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
                <select required v-model="category_id" class="appearance-none border w-full py-1 px-1 text-xs text-gray-900">
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
            <button @click="publishNewPost" type="button" class="border px-4 py-2 text-xs font-semibold">
                發布
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
            loaded: false,
            categories:[],
            title: '',
            category_id: '',
            content: '',
            errors: ''
        }
    },
    created() {
        this.loadPostsCategories();
    },
    computed: {
        /*categories() {
            return this.categories;
        }*/
    },
    methods: {
        loadPostsCategories(){
            axios.get('/api/posts/categories').then((resp) => {
                this.categories = resp.data.data;
                this.loaded = true;
            }).catch((err) => {
                console.log(err);
            })
        },
        publishNewPost(){
            this.loaded = false;
            let formData = new FormData();
            formData.append('title', this.title ? this.title : '');
            formData.append('category_id', this.category_id);
            //formData.append('image', this.$refs.image.files[0]);
            formData.append('image', this.$refs.image.files[0] ? this.$refs.image.files[0] : '');
            formData.append('content', this.content ? this.content : '');
            /*
            const formData = {
                "title": this.title,
                "category_id": this.category_id,
                "image": this.$refs.image.files[0],
                "content": this.content,
            }
            console.log(formData);
            */
            axios.post('/api/posts/store', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
            }}).then((resp) => {
                if (resp.data.success === true) {
                    //this.loaded = true;
                    console.log('post success!');
                    //console.log(this.categories[this.category_id-1].name);
                    this.$router.push('/' + this.categories[this.category_id-1].name);
                } else {
                    console.log('post failed!');
                }
            }).catch((err) => {
                this.loaded = true;
                //console.log('err = ' + JSON.stringify(err.response.data.errors));
                this.errors = err.response.data.errors;
            })
        }
    }
}
</script>