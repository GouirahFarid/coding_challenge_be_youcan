<script setup>
import {onMounted, ref, reactive, computed} from 'vue'
const state = reactive({
    product:{
        description :'',
        price :'',
        categories :null,
        image  : null,
    },
    categories :[],
    products:[],
    errors:[],
    filterBy:0,
    sortBy:0
})
function handleFileUpload($event) {
    const target = $event.target;
    if (target && target.files) {
        this.state.product.image= target.files[0];
    }
}
onMounted(async () => {
    await axios.get('api/products').then((response) => {
       state.products=response.data.data;
    })
    await axios.get('api/categories').then((response) => {
       state.categories=response.data.data;
    })
})
function createProduct(){
    let formData=new FormData();
    formData.append('name',state.product.name)
    formData.append('description',state.product.description)
    formData.append('image',state.product.image)
    formData.append('price',state.product.price)
    if (state.product.categories)
      formData.append('categories',state.product.categories)
    axios({
        method: 'post',
        url: 'api/products',
        data:formData,
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(({data})=>{
        state.products.push(data.data);
        state.errors=[]
    }).catch(({response})=>{
        state.errors= Object.values(response.data.errors).map(error=>error[0]);
    });
}
function  deleteProduct(id){
    axios.delete(  `api/products/${id}`).then((response) => {
        state.products=state.products.filter(product=>product.id!=id);
        state.errors=[];
    }).catch(({response})=>{
        state.errors= Object.values(response.data.errors).map(error=>error[0]);
    })
}
const getProducts = computed(() => {
    let currentProducts=[];
    if (state.filterBy==0)
        currentProducts= state.products
    else
        currentProducts=  state.products.filter(product=>{
            return product.categories.find(category=>category.id==state.filterBy);
        })
    switch (parseInt(state.sortBy)){
        case 0:return currentProducts;
        case 1:return  currentProducts.sort((a,b)=>(a.name<b.name)?1:-1);
        case 2:return currentProducts.sort((a,b)=>(a.price<b.price)?1:-1)
    }

})
</script>

<template>
    <Head title="Welcome" />

    <div class="container mx-auto">
        <div class="flex flex-row">
            <div class="basis-1/3">
                <form @submit.prevent='createProduct' class="bg-white shadow-md rounded px-8  pb-8 mb-4 my-10">
                    <div v-show="this.state.errors.length>0" class="flex justify-between text-black shadow-inner rounded p-3 bg-red-400">
                        <ul>
                            <li v-for="error in this.state.errors" :key="error">{{error}}</li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="name">Poduct</label>
                        <input v-model="this.state.product.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="description">
                            Description
                        </label>
                        <input v-model="this.state.product.description"  class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" placeholder="Descirption">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="price">Price</label>
                        <input v-model="this.state.product.price"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                               id="price" type="number" placeholder="price">
                    </div>
                    <div class="mb-4">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="image">Image</label>
                        <input id="image"  accept="image/*" ref="image" @change="handleFileUpload($event)"  type="file"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                               placeholder="Image">
                    </div>
                    <div class="mb-4" v-show="this.state.categories.length>0">
                        <label class="block text-grey-darker text-sm font-bold mb-2" for="categories">Categories</label>
                        <select id="categories" v-model="this.state.product.categories" multiple
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline">
                            <option v-for="category in this.state.categories" :key="category.id" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" style="background-color: #1a202c">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>

            <div v-if="this.state.products.length>0" class="basis-2/3 px-5">
                    <div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">Sort By:</label>
                            <select v-model="this.state.sortBy"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Category">
                                <option value="0">All</option>
                                <option value="1">Name</option>
                                <option value="2">Price</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">Filter By Category</label>
                            <select v-model="this.state.filterBy"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Category">
                                <option value="0">All</option>
                                <option v-for="category in this.state.categories" :key="category.id" :value="category.id">{{category.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: grid">
                        <table class="table-auto ">
                            <thead>
                            <tr class="">
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>categories</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in getProducts" key="product.id">
                                <!--                        <td><img :src="getImageUrl(product.image)" :alt="product.image"></td>-->
                                <td>{{product.name}}</td>
                                <td>{{product.description.substring(1, 30)}}</td>
                                <td>{{product.price}}</td>
                                <td><span v-for="category in product.categories" :key="category.id" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{ category.name }}</span></td>
                                <td>
                                    <button @click="deleteProduct(product.id)" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" style="background-color: #ee1919">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
            <div v-else class="basis-2/3 px-5 mt-5">
                <div class="flex justify-between text-black shadow-inner rounded p-3 bg-red-400">
                    <p>there is no product right now ,you should create one</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
