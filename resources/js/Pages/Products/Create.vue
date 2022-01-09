<template>
  <Head title="My profile"/>
 
  <BreezeAuthenticatedLayout>
    <template #header>
      Add Product
    </template>
 
    <div class="p-4 bg-white rounded-lg shadow-xs max-w-screen-lg">
 
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
 
      <BreezeValidationErrors class="mb-4"/>
 
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
 

        <div class="mt-4">
          <BreezeLabel for="description" value="Description"/>
              <input
                          type="file"
                          @change="previewImage"
                          ref="photo"
                          class="
                              w-full
                              px-4
                              py-2
                              mt-2
                              border
                              rounded-md
                              focus:outline-none
                              focus:ring-1
                              focus:ring-blue-600
                          "
                      />
                      <img
                          v-if="url"
                          :src="url"
                          class="w-full mt-4 h-80"
                      />
                      <div
                          v-if="errors?.image"
                          class="font-bold text-red-600"
                      >
                          {{ errors?.image }}
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
 
  data() {
    return {
      form: useForm({
       // _method: 'post',
        name: "",
        slug:"",
        supplier: "",
        small_description: null,
        description: null,
        price: 0,
        avaible:0,
        picture: null,
      }),
      value:null,
      
      preview:null,
    };
  },
 
  methods: {
    submit() {
      this.form.slug= this.form.name;
      if (this.$refs.photo) {
                this.form.picture = this.$refs.photo.files[0];
            }
      //this.form.picture=this.preview;
      //console.log(this.form.picture);
      this.form.post(this.route('products.store'), {
        onSuccess: () => this.form.reset('name', 'password_confirmation'),
        onError: () => {},
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


    change(e) {
        //
    var files = e.target.files || e.dataTransfer.files;
    if(!files.length){return}
    const reader = new FileReader();

    reader.onload = (e) => {
        this.preview = e.target.result;
    };

    reader.readAsDataURL(this.$refs.file.files[0]);
        //


      this.$emit('input', e.target.files[0])
      
    },
    remove() {
      this.preview = null;
    },
  },

};
</script>
 

