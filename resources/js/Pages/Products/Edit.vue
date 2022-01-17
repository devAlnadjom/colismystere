<template>
  <Head title="My profile"/>
 
  <BreezeAuthenticatedLayout>
    <template #header>
      Edit Product: <span class=" font-light">{{product.name}}</span>
    </template>

    <div v-show="$page.props.flash.success"
           class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-center w-12 bg-green-500">
          <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
            </path>
          </svg>
        </div>
 
        <div class="px-4 py-2 -mx-3">
          <div class="mx-3">
            <span class="font-semibold text-green-500">Success</span>
            <p class="text-sm text-gray-600">{{ $page.props.flash.success }}</p>
          </div>
        </div>
      </div>
 
    <div class="p-4 bg-white rounded-lg shadow-xs w-full">
 
      

      <div class="flex lg:flex-row">
        <div class=" w-2/3"><BreezeValidationErrors class="mb-4"/>
 
      <form @submit.prevent="submit">
        <div class="mt-4 flex flex-row">
          <div class=" w-2/3">
           <BreezeLabel for="name" value="Name"/>
          <BreezeInput
              id="name"
              type="text"
              class="block mt-1 w-full"
              v-model="form.name"
              required
          />
          </div>
          <div class="pl-3 w-1/3">
           <BreezeLabel for="supplier" value="supplier"/>
          <BreezeInput
              id="supplier"
              type="text"
              class="block mt-1 w-full"
              v-model="form.supplier"
              required
          />
          </div>
         
        </div>
 
        <div class="mt-4">
          <BreezeLabel for="small_description" value="Small description"/>
          <textarea rows="3"
              class="mt-1 w-full border-gray-300 rounded-md shadow-sm  focus:border-primary-200  focus:ring-1 focus:ring-primary-100 focus:ring-opacity-50 focus-within:text-primary-600"
              id="small_description"
              v-model="form.small_description"  >
          </textarea>
        </div>
 
        <hr>
 
        <div class="mt-4">
          <BreezeLabel for="description" value="Description"/>
          <textarea rows="7"
          class="mt-1 w-full border-gray-300 rounded-md shadow-sm  focus:border-primary-200  focus:ring-1 focus:ring-primary-100 focus:ring-opacity-50 focus-within:text-primary-600"
              id="description"
              v-model="form.description"  >
          </textarea>
        </div>

         
 
        <div class="mt-6 flex flex-row ">
            <div class=" w-1/3">
            <BreezeLabel for="price" value="Price"/>
          <BreezeInput
              id="price"
              type="number"
              class="block mt-1 w-full"
              v-model="form.price"
          />
            </div>
            <div class=" w-2/3 px-2 ">
            <BreezeLabel for="avaible" value="Is this avaible ?"/>
            <select v-model="form.avaible" name="avaible" id="avaible" class="mt-1 w-full border-gray-300 rounded-md shadow-sm  focus:border-primary-200  focus:ring-1 focus:ring-primary-100 focus:ring-opacity-50 focus-within:text-primary-600">
                <option value="1"> Yes it is</option>
                <option value="0"> No</option>
            </select>
            </div>
 
        </div>
 

       
        
 
        <BreezeButton
            class="block mt-4 w-full"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
          Submit
        </BreezeButton>
      </form>
        </div>

        <div class=" flex-1 pl-3 ">

           <div class="rounded border py-4 px-3 bg-gray-100">
            <h3 class=" text-xl mb-3"> Features ({{ product.features.length}})</h3>
          <div class=" w-full">
            <ul>
              <li v-for="feature in product.features" :key="feature.id" class="mb-3 border-b flex flex-row justify-between gap-2">
                <div class="flex justify-between flex-1 gap-2">
                  <span class=" text-sm">{{feature.name}}</span>
                  <span class=" text-sm">{{feature.description}}</span>
                </div>
                
                <button class=" text-sm text-red-500 hover:text-red-700 hover:bg-red-200 border border-red-500  px-2 rounded mb-1 " @click="remove_feature(feature.id)">-</button>
              </li>
            </ul>
            <div class="mt-6  flex flex-row justify-between gap-2">
                <div>
          <BreezeInput
              id="price"
              type="text"
              class="block mt-1 w-full"
              v-model="form_feature.name"
              placeholder="Name"
          />
          <BreezeInput
              id="price"
              type="text"
              class="block mt-1 w-full"
              v-model="form_feature.description"
              placeholder="Description"
          />
                </div>
                <button class=" text-sm text-green-500 hover:text-green-700 p-2 hover:bg-green-200 rounded border border-green-500 max-h-10" @click="add_feature()">Add New</button>
            </div>
            
          </div>
          </div>

          <div class="rounded border py-4 px-3 bg-gray-100 mt-3">
            <h3 class=" text-xl mb-3"> Categories Linked ({{ product.categories.length}})</h3>
          <div class=" w-full">
            <ul>
              <li v-for="category in product.categories " :key="category.id" class="mb-3 border-b flex flex-row justify-between">
                <span class=" text-sm">{{category.name}}</span>
                <button class=" text-sm text-red-500 hover:text-red-700" @click="remove_category(category.id)">Remove</button>
              </li>
            </ul>
            <div class="mt-6  flex flex-row justify-between">
            <select v-model="new_category" class=" border-gray-400 rounded-md shadow-sm  focus:border-green-200  focus:ring-1 focus:ring-green-200 focus:ring-opacity-50 focus-within:text-green-400 w-3/4 p-2">
                  <option :value="null">Add New Category</option>
                  <option v-for="category in categories " :key="category.id" :value="category.id">{{category.name}}</option>
              </select>
                <button class=" text-sm text-green-500 hover:text-green-700 p-2 hover:bg-green-200 rounded border border-green-500" @click="add_category()">Add New</button>
            </div>
            
          </div>
          </div>


          <div class="rounded border py-4 mt-6 px-3 bg-gray-100">
            <h3 class=" text-xl mb-3"> Galerie ({{ product.media.length}}) </h3>
          <div class=" w-full">
            <ul>
              <li v-for="category in product.media " :key="category.id" class="mb-3 py-1 pl-2 hover:bg-gray-50 flex flex-row justify-between">
                <img v-if="category" :src="makeimg(category)" class="rounded h-12 w-12" />
                <button class=" text-sm text-red-500 hover:text-red-700" @click="remove_media(category.id)">Remove</button>
              </li>
            </ul>
            <div class=" border-t pt-6  gap-2 flex flex-row justify-between">
                <input type="file" @change="previewImage" ref="photo" class="w-full px-4 py-2 mt-2
                              border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 " />
                      
                      <div v-if="errors?.image" class="font-bold text-red-600" >
                          {{ errors?.image }}
                  </div>
                <button class=" text-sm text-green-500 hover:text-green-700 p-2 hover:bg-green-200 rounded border border-green-500" @click="add_media()">Add New</button>
            </div>
            
          </div>
          </div>
          
        </div>

      </div>

      


    </div>
  </BreezeAuthenticatedLayout>
</template>
 
<script>
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
 
export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
  },
   props: {
    product: Object,
    categories:Object,
    medias:Array,
    
  },
 
  data() {
    return {
      form: useForm({
        _method: 'put',
        name: this.product.name,
        slug:"",
        supplier: this.product.supplier,
        small_description: this.product.small_description,
        description: this.product.description,
        price: this.product.price,
        avaible:this.product.avaible,
      }),
      form_category: useForm({
        _method: 'post',
        id_product: this.product.id,
        id_category: null,
      }),
      
      form_feature: useForm({
        _method: 'post',
        id_product: this.product.id,
        name: null,
        description: null,
        id_feature : null,
      }),
      
      form_photo: useForm({
        _method: 'post',
        id_product: this.product.id,
        id_media:null,
        picture: null,
      }),
      value:null,
      new_category:null,
      
      preview:null,
    };
  },
 
  methods: {
    submit() {
      this.form.slug= this.form.name;
     
      
      this.form.post(this.route('products.update',this.product.id), {
        onSuccess: () => {},
        onError: () => {alert("Sorry something went Wrong")},
      });
    },

    filesize(size) {
      var i = Math.floor(Math.log(size) / Math.log(1024))
      return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
    },
    browse() {
      this.$refs.file.click()
    },
    
        previewImage(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },


    remove_category(id_category)
    {
      
      this.form_category.id_category= id_category;

      this.form_category.post(this.route('products.remove_category'), {
        onSuccess: () => alert('Category delete'),
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },

    remove_feature(id_feature)
    {
      
      this.form_feature.id_feature= id_feature;

      this.form_feature.post(this.route('products.remove_feature'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },

    remove_media(id_media)
    {
      
      this.form_photo.id_media= id_media;

      this.form_photo.post(this.route('products.remove_media'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },
    
    add_category()
    {
      if(!this.new_category) return;
      this.form_category.id_category= this.new_category;

      this.form_category.post(this.route('products.add_category'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
      this.new_category=null;
    },
    
    add_media()
    {
      
      if (this.$refs.photo?.files[0]) {
                this.form_photo.picture = this.$refs.photo.files[0];
            }else{return}
      this.form_photo.post(this.route('products.add_media'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
      this.form_photo.picture=null;
    },

    add_feature()
    {
      if(!this.form_feature.name) return;

      this.form_feature.post(this.route('products.add_feature'), {
        onSuccess: () => {this.form_feature.name=null; this.form_feature.description=null;},
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },

    remove() {
      this.preview = null;
    },

    makeimgthumb(img){
      return "/storage/"+img.id+"/"+img.file_name;
    },
    makeimg(img){
      return "/storage/"+img.id+"/conversions/"+this.getThunb(img.file_name);
    },

    getThunb(img){
      let filen= img.split('.')[0];
      
      return filen+"-thumb.jpg";
    }
  },

};
</script>
 

