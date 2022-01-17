<template>
  <Head title="My profile"/>
 
  <BreezeAuthenticatedLayout>
    <template #header>
      Add Driver
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
          <div class=" w-3/5">
           <BreezeLabel for="name" value="Name"/>
          <BreezeInput
              id="name"  type="text" class="block mt-1 w-full"  v-model="form.name"  required
          />
          </div>
          <div class="pl-3 w-2/5">
           <BreezeLabel for="email" value="Email"/>
          <BreezeInput
              id="email" type="email" class="block mt-1 w-full" v-model="form.email"  required  />
          </div>
         
        </div>

        <h3 class="text-gray-700 text-2xl mt-8"> Contact</h3>
        <div class="mt-1 flex flex-row">
          <div class=" w-2/5">
           <BreezeLabel for="contact" value="Contact"/>
          <BreezeInput
              id="contact"  type="text" class="block mt-1 w-full"  v-model="form.contact"  required />
          </div>
          <div class="pl-3 w-3/5">
           <BreezeLabel for="address" value="Address"/>
          <BreezeInput
              id="address" type="text" class="block mt-1 w-full" v-model="form.address"  required  />
          </div>
         
        </div>
        <div class="mt-3 flex flex-row">
          <div class=" w-2/5">
           <BreezeLabel for="city" value="City"/>
          <BreezeInput
              id="city"  type="text" class="block mt-1 w-full"  v-model="form.city"  required />
          </div>
          <div class="pl-3 w-2/5">
           <BreezeLabel for="state" value="State"/>
          <BreezeInput
              id="state" type="text" class="block mt-1 w-full" v-model="form.state"  required  />
          </div>
          <div class="pl-3 w-1/5">
           <BreezeLabel for="zip_code" value="Zip Code"/>
          <BreezeInput
              id="zip_code" type="text" class="block mt-1 w-full" v-model="form.zip_code" pacehoder="XXX XXX"  required/>
          </div>
         
        </div>
 
       
 
        
        <h3 class="text-gray-700 text-2xl mt-8 mb-1"> Drive Information</h3>
        <hr>
        <div class="mt-4">
          <BreezeLabel for="driver_license" value="driver_license"/>
          <BreezeInput
              id="driver_license"  type="text" class="block mt-1 w-full"  v-model="form.driver_license"  required />
        </div>

        <div class="mt-3 flex flex-row">
          <div class=" w-2/5">
           <BreezeLabel for="registration" value="Registration"/>
          <BreezeInput
              id="registration"  type="text" class="block mt-1 w-full"  v-model="form.registration"  required />
          </div>
          <div class="pl-3 w-1/5">
          <BreezeLabel for="vehicule_type" value="Chosse a vehicule type"/>
            <select v-model="form.vehicule_type"  id="vehicule_type" class="mt-1 w-full border-gray-300 rounded-md shadow-sm  focus:border-primary-200  focus:ring-1 focus:ring-primary-100 focus:ring-opacity-50 focus-within:text-primary-600">
                <option value="Car">Car</option>
                <option value="Motor Cycle">Motor Cycle</option>
                <option value="Bicycle"> Bicycle</option>
                <option value="Other"> Other</option>
            </select>
          </div>
          <div class="pl-3 w-2/5">
           <BreezeLabel for="vehicule_model" value="Vehicule model"/>
          <BreezeInput
              id="vehicule_model" type="text" class="block mt-1 w-full" v-model="form.vehicule_model" pacehoder="XXX XXX"  required/>
          </div>
         
        </div>


         
 
 

        <div class="mt-4">
          <BreezeLabel for="description" value="Upoload Driver license"/>
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
        
       <div class="mt-5 flex flex-row-reverse">
           <BreezeButton
            class="block w-1/3 right-0"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
          Submit
        </BreezeButton>
       </div>
      
      </form>
    </div>
    <div class="h-20"></div>
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
        email:"",
        contact: "",
        address: "",
        city: "Montreal",
        state: "Quebec",
        zip_code:"",
        driver_license:"",
        registration:"",
        vehicule_type:"",
        vehicule_model:"",
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
    
      this.form.post(this.route('driver.store'), {
        onSuccess: () => {},
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
 

