<template>
  <Head title="Welcome" />

  <div
    class=" relative flex
      items-top
      justify-center

      bg-gray-100
      dark:bg-gray-900
      sm:items-center sm:pt-0
    "
  >
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="text-sm text-gray-700 underline"
      >
        Dashboard
      </Link>

      <template v-else>
        <Link :href="route('login')" class="text-sm text-gray-700 underline">
          Log in
        </Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-700 underline"
        >
          Register
        </Link>
      </template>
    </div>
    <div class="w-full flex flex-col bg-gray-200 py-10">
      <div class="mx-auto mb-6 pt-6">
        <h3 class="text-4xl font-bold text-pink-400">Colis Mystere</h3>
      </div>

      <p class="mx-auto lg:w-1/4 flex flex-row justify-between pb-5 ">
        <Link :href="route('home')" class="text-sm text-pink-700 underline">
          Shop
        </Link>

        <Link
          :href="route('register')"
          class="ml-4 text-sm text-gray-700 underline"
        >
          Cart
        </Link>

        <Link
          :href="route('login')"
          class="text-sm text-gray-700 underline hover:text-pink-600"
        >
          About
        </Link>
      </p>

    </div>
  </div>
  <section class="text-gray-700 body-font overflow-hidden py-10">
      <div class="flex flex-col max-w-5xl  mx-auto p-6 space-y-4 sm:p-10 bg-coolGray-50 text-coolGray-800">
	<h2 class="text-2xl font-semibold">Fill your Payment information</h2>
    <hr>





<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
        <p class="mt-1 text-sm text-gray-600">
          Use a permanent address where you can receive mail.
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="#" method="POST">
        <div class="overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">


            <div class="grid grid-cols-6 gap-6 mt-5">

              <div class="col-span-6 sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                <input type="text" v-model="form.name" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name"  class="block text-sm font-medium text-gray-700">Last name</label>
                <input type="text" v-model="form.surname" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-6">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" v-model="form.email" name="email-address" id="email-address" autocomplete="false" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div class="col-span-6 sm:col-span-6">
                <label for="email-address" class="block text-sm font-medium text-gray-700">Phone number</label>
                <input type="tel" v-model="form.contact" name="email-address" id="email-address" autocomplete="false" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              

          </div>
          <div class="grid grid-cols-6 gap-6 mt-5">

              <div class="col-span-6">
                <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                <input type="text" v-model="form.address" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                <input type="text" v-model="form.zip_code" name="postal-code" id="postal-code" autocomplete="postal-code" placeholder="HXX XXX" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal-code" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" v-model="form.city" name="postal-code" id="postal-code" autocomplete="postal-code" placeholder="HXX XXX" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal-code" class="block text-sm font-medium text-gray-700">State</label>
                <input type="text" v-model="form.state" name="postal-code" id="postal-code" autocomplete="postal-code" placeholder="HXX XXX" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
            
            </div>
          </div>


        </div>
      </form>
    </div>
  </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
  <div class="py-5">
    <div class="border-t border-gray-200"></div>
  </div>
</div>


<div class="mt-5 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Paiment Info</h3>
        <p class="mt-1 text-sm text-gray-600">
          Give us information about the adress of the recipient.
        </p>
    <p>Total amount:
			<span class="font-semibold text-pink-800">{{total/100}} $</span>
		</p>
      </div>
    </div>
    <div class="mt-2 md:mt-0 md:col-span-2">
      <form action="#" method="POST">
        <div class="overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6 mt-1">
                <div class="col-span-6">
                  <label for="street-address" class="block text-sm font-medium text-gray-700 focus:ring-pink-500 focus:border-pink-500">Card Number </label>
                        <div class="mt-3 py-2 px-2 block w-full  sm:text-sm border border-gray-300 rounded-md">
                          <div id="card-element" class=" w-full ">
                          <!-- Elements will create input elements here -->
                        </div>
                        </div>
                        

                        <!-- We'll put the error messages in this element -->
                        <div id="card-errors" role="alert"></div>
                        </div>
                <div class="col-span-6 space-x-4">
                  <button type="button" class="px-6 py-2 border rounded-md border-violet-600" @click="$inertia.visit(route('home'))" >Back
                    <span class="sr-only sm:not-sr-only">Go to Cart</span>
                  </button>
                  <button type="button" @click="processPayment()" class="px-6 py-2 border rounded-md bg-pink-400 hover:bg-pink-500 text-white border-pink-400" :disabled="processingPayment">
                    <span class="sr-only sm:not-sr-only"></span>PAY NOW
                  </button>
                </div>

            
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
  <div class="py-5">
    <div class="border-t border-gray-200"></div>
  </div>
</div>

</div>
  </section>

 <Footer class="border-t" />
</template>

<style scoped>
.bg-gray-100 {
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
  border-color: #edf2f7;
  border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
  color: #cbd5e0;
  color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
  color: #a0aec0;
  color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
  color: #718096;
  color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
  color: #4a5568;
  color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
  color: #1a202c;
  color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #2d3748;
    background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
  }

  .dark\:bg-gray-900 {
    background-color: #1a202c;
    background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
  }

  .dark\:border-gray-700 {
    border-color: #4a5568;
    border-color: rgba(74, 85, 104, var(--tw-border-opacity));
  }

  .dark\:text-white {
    color: #fff;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
  }

  .dark\:text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
  }
}
</style>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Footer from '@/Components/Footer.vue';
import {loadStripe} from '@stripe/stripe-js';

export default {
  components: {
    Head,
    Link,
    Footer,
  },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
   // cart: Object,
    cartTotal: Number,
    stripeKey: String,
  },
   data() {
    return {
      stripe:{},
      cardElement:{},
      processingPayment: false,
      form: this.$inertia.form({

        surname: "",//
        name: "",//
        contact: "",//
        email: "",
        address: "",//
        zip_code:"",//
        comment:"",//
        basic:true,
        tracking:false,
        premium:false,
        payment_id:null,
        total:0,
      }),

      livraison:0,
      total:0,
    };
  },
  methods:{
    checkout(){
      
        this.form.post(this.route('order.purchase'))
        //else{this.form.post(this.route('cart.update'));}*/
    },

    calcutePrice()
    {
      this.livraison=0;
      this.form.basic=true;
      if(this.form.basic==true){this.livraison+=15}
      if(this.form.premium==true){this.livraison+=15}
      if(this.form.tracking==true){this.livraison+=2}
      this.total=this.cartTotal+this.livraison*100;
    },

    async processPayment()
    {
      //send payment information to to laravel and the backend
      //console.log("valeur "+cartId+" "+value);
      if(String(this.form.surname).length<4 || String(this.form.name).length<4 || String(this.form.contact).length<4
            || String(this.form.address).length<4 || String(this.form.zip_code).length<5  )
            {
                alert("Some value need to be filled Right");
                return};

      this.processingPayment=true;
      const { paymentMethod, error} = await this.stripe.createPaymentMethod(
        'card', this.cardElement,{
          billing_details:{
            name:this.form.name+ ''+ this.form.surname,
            email: this.form.email,
            address:{
              line1: this.form.address,
              city: this.form.city,
              state: this.form.state,
              postal_code: this.form.zip_code
            }
          }
        }
      );

      if(error){
        this.processingPayment=false;
        alert(error);
      }else{
        
        this.form.payment_id= paymentMethod.id;
        this.form.total= this.total;
        this.checkout();
        //alert("cest bon");
        //Call payment method
      }

    }
  },

  mounted() {
  this.$nextTick(async function () {
    this.calcutePrice();
    this.stripe= await loadStripe(this.stripeKey);
    
    const elements = this.stripe.elements();
    this.cardElement = elements.create('card',{
      classes:{
        base:'',
      }
    });
    this.cardElement.mount('#card-element')
    
  })
}
};
</script>
