<template>
  <Head title="My profile"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      Info Order Number: <span class=" font-light">{{order.id}}  </span>
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
        <div class=" w-2/5  rounded border py-4 px-3 bg-gray-50 ">
        <BreezeValidationErrors class="mb-4"/>
            <h3 class=" text-xl mb-3  ml-2"> General Infos</h3>
            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Sha_key"/>
                </div>
                <div class="pl-3 flex-1">
                    <span class=" font-semibold text-right">{{order.sha_key}}</span>
                </div>
            </div>
            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Amount"/>
                </div>
                <div class="pl-3 flex-1">
                    <span class=" font-semibold text-right">${{order.total}}</span>
                </div>
            </div>
            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Transaction Id"/>
                </div>
                <div class="pl-3 flex-1">
                    <span class=" font-semibold text-right">{{order?.transaction_id}}</span>
                </div>
            </div>


            <h3 class=" text-xl mt-8 ml-2"> Delivery Infos</h3>
            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Recipient"/>
                </div>
                <div class="pl-3 flex-1">
                    <span class=" font-semibold text-right">{{order.recipient_name}}</span>
                </div>
            </div>
            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Contact"/>
                </div>
                <div class="pl-3 flex-1">
                    <span class=" font-semibold text-right"> {{order.recipient_contact}}</span>
                </div>
            </div>
            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Adress"/>
                </div>
                <div class="">
                    <p class=" font-semibold ">{{order?.recipient_address}}</p>
                    <p class=" font-semibold ">
                        {{order?.recipient_zip_code}} - Montreal, {{order?.recipient_state}}
                    </p>
                </div>
            </div>

            <div class="mt-4 flex flex-row mx-2 border-b py-2">
                <div class=" w-1/3">
                    <BreezeLabel  value="Place"/>
                </div>
                <div class="pl-3 flex-1">
                    <span class=" font-semibold text-right"> {{order.recipient_place}}</span>
                </div>
            </div>





        </div>


        <!-- hover side information -->
        <div class=" flex-1 pl-3 ">

           <div class="rounded border py-4 px-3 bg-gray-100">
                <h3 class=" text-xl mb-3"> Products ({{ products.length}})</h3>
                <div class=" w-full">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">

                            <th class="px-4 py-3">name</th>
                            <th class="px-4 py-3">slug</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                    <tr v-for="product in products" :key="product.id" class="mb-3 border-b ">
                                        <td class="pl-3 text-sm font-semibold">{{product?.pivot.qty}} X </td>
                                        <td class=" text-sm font-semibold">{{product.name}}  </td>
                                        <td class=" text-sm font-semibold">{{product?.pivot.cprice}}</td>
                                        <td>  <button class=" text-sm text-red-500 hover:text-red-700 hover:bg-red-200 border border-red-500  px-2 rounded mb-1 " @click="remove_feature(product.id)">-</button></td>

                                    </tr>
                        </tbody>
                    </table>


                </div>
            </div>

            <div class="rounded border py-4 px-3 bg-gray-100 mt-3">
                <div class="flex justify-between">
                  <h3 class=" text-xl mb-3"> Delivery info</h3>
                  <span class=" p-1 text-xs bg-red-100 text-red-500 rounded h-6" v-if="Number(order.status)   <=1">Not Planned</span>
                  <span class=" p-1 text-xs bg-blue-100 text-blue-500 rounded h-6" v-if="Number(order.status) ==2">Planned</span>
                  <span class=" p-1 text-xs bg-green-100 text-green-500 rounded" v-if="Number(order.status) > 2">Delivered</span>
                </div>
                <div class="w-full">
                  <ul>
                    <li v-for="delivery in deliveries " :key="delivery.id" class="mb-3 border-b flex flex-row justify-between">
                      <span class=" text-sm">{{delivery?.driver.user.name}}</span>
                      <span class=" text-sm">{{delivery?.created_at}}</span>
                    </li>
                  </ul>
                </div>
                <div class=" w-full" v-if="Number(order.status) <3">
                    <div class="mt-6  flex flex-row justify-between gap-8">
                        <div class="w-full flex-1">
                            <select v-model="form_deliver.driver_id" class=" border-gray-400 rounded-md shadow-sm  focus:border-green-200  focus:ring-1 focus:ring-green-200 focus:ring-opacity-50 focus-within:text-green-400 w-full p-2">
                                <option :value="null">Attach driver</option>
                                <option v-for="driver in drivers " :key="driver.id" :value="driver.id">{{driver.user.name}} - {{driver.vehicule_model}}</option>
                            </select>
                            <div class="mt-4 flex flex-row">
                                <div class=" w-1/3">
                                <BreezeLabel for="deliver_before" value="Date"/>
                                <BreezeInput
                                    id="deliver_before"
                                    type="date"
                                    class="block mt-1 w-full"
                                    v-model="form_deliver.deliver_before"
                                    required
                                />
                                </div>
                                <div class="pl-3 w-2/3">
                                <BreezeLabel for="delivery_comment" value="Comment"/>
                                <BreezeInput
                                    id="delivery_comment"
                                    type="text"
                                    class="block mt-1 w-full"
                                    v-model="form_deliver.comment"
                                    required
                                />
                                </div>

                            </div>
                        </div>

                        <button class=" text-sm text-green-500 hover:text-green-700 p-2 hover:bg-green-200 rounded border border-green-500 max-h-12" @click="plan_delivery()">Select Driver</button>
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
    order: Object,
    categories:Object,
    //medias:Array,
    drivers:Object,
    products:Object,
    deliveries:Object,

  },

  data() {
    return {
      form: useForm({
        _method: 'put',
        name: "",
        slug:"",
        supplier: this.order.supplier,
        small_description: this.order.small_description,
        description: this.order.description,
        price: this.order.price,
        avaible:this.order.avaible,
      }),
      form_category: useForm({
        _method: 'post',
        id_order: this.order.id,
        id_category: null,
      }),

      form_feature: useForm({
        _method: 'post',
        id_order: this.order.id,
        name: null,
        description: null,
        id_feature : null,
      }),

      form_deliver: useForm({
        _method: 'post',
        order_id: this.order.id,
        driver_id:null,
        deliver_before: null,
        comment:null,
      }),
      value:null,
      new_category:null,

      preview:null,
    };
  },

  methods: {
    submit() {
      this.form.slug= this.form.name;
      this.form.post(this.route('orders.update',this.order.id), {
        onSuccess: () => {},
        onError: () => {alert("Sorry something went Wrong")},
      });
    },

    plan_delivery()
    {
      if(!this.form_deliver.driver_id || !this.form_deliver.deliver_before) return;
      

      this.form_deliver.post(this.route('delivery.store'), {
        onSuccess: () => {this.form_deliver.driver_id=this.form_deliver.deliver_before= null;},
        onError: () => {},
      });
      this.new_category=null;
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

      this.form_category.post(this.route('orders.remove_category'), {
        onSuccess: () => alert('Category delete'),
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },

    remove_feature(id_feature)
    {

      this.form_feature.id_feature= id_feature;

      this.form_feature.post(this.route('orders.remove_feature'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },

    remove_media(id_media)
    {

      this.form_photo.id_media= id_media;

      this.form_photo.post(this.route('orders.remove_media'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
    },

    add_category()
    {
      if(!this.new_category) return;
      this.form_category.id_category= this.new_category;

      this.form_category.post(this.route('orders.add_category'), {
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
      this.form_photo.post(this.route('orders.add_media'), {
        onSuccess: () => {},
        onError: () => {alert('Une erreur s\'est produite')},
      });
      this.form_photo.picture=null;
    },

    add_feature()
    {
      if(!this.form_feature.name) return;

      this.form_feature.post(this.route('orders.add_feature'), {
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


