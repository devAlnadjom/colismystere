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
          :href="route('cart.show')"
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
	<h2 class="text-2xl font-semibold">Suprise's Information</h2>
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
                <input type="text" v-model="form.recipient_name" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="last-name"  class="block text-sm font-medium text-gray-700">Last name</label>
                <input type="text" v-model="form.recipient_surname" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-6">
                <label for="contact" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" v-model="form.recipient_contact" name="econtact"  autocomplete="email" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="sexe" class="block text-sm font-medium text-gray-700">For * </label>
                <select id="sexe" v-model="form.recipient_sexe" name="sexe" autocomplete="off" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                  <option>Select one Option</option>
                  <option value="H">Him</option>
                  <option value="F">She</option>
                  <option value="N">Him/Her</option>
                </select>
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


<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Adress And Contact</h3>
        <p class="mt-1 text-sm text-gray-600">
          Give us information about the adress of the recipient.
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="#" method="POST">
        <div class="overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">

              <fieldset class="">
                <div>
                <legend class="text-base font-medium text-gray-900">Place</legend>
                <p class="text-sm text-gray-500">Where are we going to deliver?</p>
              </div>
              <div class="mt-4 .space-y-4 grid grid-cols-6 gap-2">
                <div class="flex items-center col-span-6 sm:col-span-3 lg:col-span-2">
                  <input id="push-everything" value="Home" v-model="form.recipient_place" name="push-notifications" type="radio" class="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300">
                  <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                    Home
                  </label>
                </div>
                <div class="flex items-center col-span-4 sm:col-span-3 lg:col-span-2">
                  <input id="push-email" value="Workplace" v-model="form.recipient_place" name="push-notifications" type="radio" class="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300">
                  <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">
                    WorkPlace
                  </label>
                </div>
                <div class="flex items-center col-span-4 sm:col-span-3 lg:col-span-2">
                  <input id="push-nothing" value="Other" v-model="form.recipient_place" name="push-notifications" type="radio" class="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300">
                  <label for="push-nothing" class="ml-3 block text-sm font-medium text-gray-700">
                    Other
                  </label>
                </div>
              </div>
            </fieldset>

            <div class="grid grid-cols-6 gap-6 mt-5">

              <div class="col-span-6">
                <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                <input type="text" v-model="form.recipient_address" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                <input type="text" v-model="form.recipient_zip_code" name="postal-code" id="postal-code" autocomplete="postal-code" placeholder="HXX XXX" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>
              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postal-code" class="block text-sm font-medium text-gray-700">Ville</label>
                <span  class="mt-1 pt-2 block w-full  sm:text-sm border-0 focus:border-0 font-bold">MONTREAL</span>
              </div>
            </div>

            <div>
              <label for="about" class=" mt-5 block text-sm font-medium text-gray-700">
                Special Instruction
              </label>
              <div class="mt-1">
                <textarea v-model="form.recipient_comment" id="about" name="about" rows="3" class="shadow-sm focus:ring-pink-500 focus:border-pink-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Give some Information"></textarea>
              </div>
              <p class="mt-2 text-sm text-gray-500">
                Give some preference like how you wish to be delivered.
              </p>
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

<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Services Type</h3>
        <p class="mt-1 text-sm text-gray-600">
          Select All extra services you wish.
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form action="#" method="POST">
        <div class=" overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <fieldset>
              <legend class="text-base font-medium text-gray-900">Services</legend>
              <div class="mt-4 space-y-4">
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="premium" v-model="form.recipient_premium" @change="calcutePrice()"  name="premium" type="checkbox" class="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="premium" class="font-medium text-gray-700">Fast Delivery  <b class=" ml-5 text-pink-700">+15$</b></label>
                    <p class="text-gray-500">Your gift will be delivered in less than 3hrs.</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="tracking" v-model="form.recipient_tracking" @change="calcutePrice()" name="tracking" type="checkbox" class="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="tracking" class="font-medium text-gray-700">Candidates <b class=" ml-5 text-pink-700">+2$</b></label>
                    <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex items-center h-5">
                    <input id="offers" v-model="form.recipient_basic" @change="calcutePrice()" name="offers" type="checkbox" class="focus:ring-pink-500 h-4 w-4 text-pink-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="offers" class="font-medium text-gray-700"> Tracking<b class=" ml-5 text-pink-700">Free</b></label>
                    <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                  </div>
                </div>
              </div>
            </fieldset>

             <!--fieldset class="mt-5">
              <p class=".sr-only">
                Choose a size
              </p>
              <div class="grid grid-cols-2 gap-4 sm:grid-cols-8 lg:grid-cols-2">
                <-- Active: "ring-2 ring-indigo-500" ->
                <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-gray-50 text-gray-200 cursor-not-allowed">
                  <input type="radio" name="size-choice" value="XXS" disabled class="sr-only" aria-labelledby="size-choice-0-label">
                  <p id="size-choice-0-label">
                    XXS
                  </p>

                  <div aria-hidden="true" class="absolute -inset-px rounded-md border-2 border-gray-200 pointer-events-none">
                    <svg class="absolute inset-0 w-full h-full text-gray-200 stroke-2" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                      <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                    </svg>
                  </div>
                </label>

                <-- Active: "ring-2 ring-indigo-500" ->
                <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none border-pink-400  sm:flex-1 sm:py-6 bg-white shadow-sm text-pink-400 cursor-pointer">
                  <input type="radio" name="size-choice" value="XS" class="sr-only" aria-labelledby="size-choice-1-label">
                  <p id="size-choice-1-label">
                    XS
                  </p>

                  <--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  ->
                  <div class="absolute -inset-px rounded-md pointer-events-none" aria-hidden="true"></div>
                </label>

                <-- Active: "ring-2 ring-indigo-500" ->




                <-- Active: "ring-2 ring-indigo-500" ->
                <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none focus:border-pink-400 sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                  <input type="radio" name="size-choice" value="L" class="sr-only" aria-labelledby="size-choice-4-label">
                  <p id="size-choice-4-label">
                    L
                  </p>

                  <--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  ->
                  <div class="absolute -inset-px rounded-md pointer-events-none" aria-hidden="true"></div>
                </label>





                <-- Active: "ring-2 ring-indigo-500" ->
                <label class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                  <input type="radio" name="size-choice" value="3XL" class="sr-only" aria-labelledby="size-choice-7-label">
                  <p id="size-choice-7-label">
                    3XL
                  </p>

                  <--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  ->
                  <div class="absolute -inset-px rounded-md pointer-events-none" aria-hidden="true"></div>
                </label>
              </div>
            </fieldset-->

          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<hr>





	<div class="space-y-1 text-right">
		<p>Cart amount:
			<span class="font-semibold text-pink-800">{{cartTotal /100}}</span>
		</p>
    <p>Services & Extra:
			<span class="font-semibold text-pink-800">{{livraison }}.00</span>
		</p>
    <p>Total amount:
			<span class="font-semibold text-pink-800">{{total/100}}</span>
		</p>
		<p class="text-sm text-coolGray-600">Not inclouding taxes and shipping costs</p>
	</div>
	<div class="flex justify-end space-x-4">
		<button type="button" class="px-6 py-2 border rounded-md border-violet-600" @click="$inertia.visit(route('home'))" >Back
			<span class="sr-only sm:not-sr-only">to shop</span>
		</button>
		<button type="button" @click="sendDelivery()" class="px-6 py-2 border rounded-md bg-pink-400 hover:bg-pink-500 text-white border-pink-400">
			<span class="sr-only sm:not-sr-only">Continue to</span>Checkout
		</button>
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
    recipientData:Object,
  },
   data() {
    return {
      form: this.$inertia.form({

        recipient_surname: "",//
        recipient_name: "",//
        recipient_contact: "",//
        recipient_email: "",
        recipient_address: "",//
        recipient_zip_code:"",//
        recipient_comment:"",//
        recipient_place:"",
        recipient_sexe:"",
        recipient_basic:true,
        recipient_tracking:false,
        recipient_premium:false,

      }),

      livraison:0,
      total:0,
    };
  },
  methods:{
    sendDelivery(){
      //console.log("valeur "+cartId+" "+value);
      if(String(this.form.recipient_surname).length<4 || String(this.form.recipient_name).length<4 || String(this.form.recipient_contact).length<4
            || String(this.form.recipient_address).length<4 || String(this.form.recipient_zip_code).length<5  )
            {
                alert("Some value need to be filled Right");
                return
            };

        this.form.post(this.route('store.recipient'))
    },

    calcutePrice()
    {
      this.livraison=0;
      this.form.recipient_basic=true;
      if(this.form.recipient_basic==true){this.livraison+=15}
      if(this.form.recipient_premium==true){this.livraison+=15}
      if(this.form.recipient_tracking==true){this.livraison+=2}
      this.total=this.cartTotal+this.livraison*100;
    },

    setMemoryData(){

      if(this.recipientData==false)
        return;

        this.form.recipient_surname= this.recipientData?.recipient_surname;//
        this.form.recipient_name= this.recipientData?.recipient_name;//
        this.form.recipient_contact= this.recipientData?.recipient_contact;//
        this.form.recipient_email= this.recipientData?.recipient_email;
        this.form.recipient_address= this.recipientData?.recipient_address;//
        this.form.recipient_zip_code=this.recipientData?.recipient_zip_code;//
        this.form.recipient_comment=this.recipientData?.recipient_comment;//
        this.form.recipient_place=this.recipientData?.recipient_place;
        this.form.recipient_sexe=this.recipientData?.recipient_sexe;
        this.form.recipient_basic=this.recipientData?.recipient_basic;
        this.form.recipient_tracking=this.recipientData?.recipient_tracking;
        this.form.recipient_premium=this.recipientData?.recipient_premium;

    }
  },

  mounted() {
  this.$nextTick(function () {
    this.setMemoryData();
    this.calcutePrice();
  })
}
};
</script>
