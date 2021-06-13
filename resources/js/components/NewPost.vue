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
            <button @click="publishNewPost" type="button" class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                發布
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
            loaded: false,
            categories:[],
            title: '',
            category_id: '',
            content: '',
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
            formData.append('title', this.title);
            formData.append('category_id', this.category_id);
            formData.append('image', this.$refs.image.files[0]);
            formData.append('content', this.content);
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
                    window.location.href = '/' + this.categories[this.category_id-1].name;
                } else {
                    console.log('post failed!');
                }
            }).catch((err) => {
                console.log('err = '.err);
            })
        }
    }
}
</script>