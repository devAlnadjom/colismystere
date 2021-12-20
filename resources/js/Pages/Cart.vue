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
	<h2 class="text-2xl font-semibold">Your cart</h2>
    <hr>
	<ul v-for="product in cart" :key="product.index" class="flex flex-col divide-y divide-coolGray-300">
		<li class="flex flex-col py-6 sm:flex-row sm:justify-between">
			<div class="flex w-full space-x-2 sm:space-x-4">
				<img class="flex-shrink-0 object-cover w-20 h-20 border-transparent rounded outline-none sm:w-32 sm:h-32 bg-coolGray-500" src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80" alt="Polaroid camera">
				<div class="flex flex-col justify-between w-full pb-4">
					<div class="flex justify-between w-full pb-2 space-x-2">
						<div class="space-y-1">
							<h3 class="text-lg font-semibold leading-snug sm:pr-8">{{product.name}}</h3>
							<p class="text-sm text-coolGray-600 flex flex-row">

                            <input type="number" min="1" v-model="product.quantity" @change="updateCart(product.id, $event.target.value)" class=" w-20 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:bg-transparent focus:ring-2 focus:ring-pink-200 focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-4 transition-colors duration-200 ease-in-out">
                            <span class=" leading-7">Items</span>
                            </p>

						</div>
						<div class="text-right">
							<p class="text-lg font-semibold">{{(product.price/100)}}$</p>
							<p class="text-sm  text-pink-400">{{product.quantity*product.price/100}} €</p>
						</div>
					</div>
					<div class="flex text-sm divide-x">
						<button type="button" class="flex items-center px-2 py-1 pl-0 space-x-1" @click="updateCart(product.id, 0)">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
								<path d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z"></path>
								<rect width="32" height="200" x="168" y="216"></rect>
								<rect width="32" height="200" x="240" y="216"></rect>
								<rect width="32" height="200" x="312" y="216"></rect>
								<path d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z"></path>
							</svg>
							<span>Remove</span>
						</button>
						<button type="button" class="flex items-center px-2 py-1 space-x-1">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
								<path d="M453.122,79.012a128,128,0,0,0-181.087.068l-15.511,15.7L241.142,79.114l-.1-.1a128,128,0,0,0-181.02,0l-6.91,6.91a128,128,0,0,0,0,181.019L235.485,449.314l20.595,21.578.491-.492.533.533L276.4,450.574,460.032,266.94a128.147,128.147,0,0,0,0-181.019ZM437.4,244.313,256.571,425.146,75.738,244.313a96,96,0,0,1,0-135.764l6.911-6.91a96,96,0,0,1,135.713-.051l38.093,38.787,38.274-38.736a96,96,0,0,1,135.765,0l6.91,6.909A96.11,96.11,0,0,1,437.4,244.313Z"></path>
							</svg>
							<span>Add to favorites</span>
						</button>
					</div>
				</div>
			</div>
		</li>


	</ul>
	<div class="space-y-1 text-right">
		<p>Total amount:
			<span class="font-semibold text-pink-800">{{cartTotal/100}}$</span>
		</p>
		<p class="text-sm text-coolGray-600">Not inclouding taxes and shipping costs</p>
	</div>
	<div class="flex justify-end space-x-4">
		<button type="button" class="px-6 py-2 border rounded-md text-pink-400  border-pink-400 hover:text-pink-600 hover:bg-pink-50" @click="$inertia.visit(route('home'))" >Back
			<span class="sr-only sm:not-sr-only">to shop</span>
		</button>
		<button type="button" @click="$inertia.visit(route('order.recipient'))" class="px-6 py-2 border rounded-md bg-pink-400 hover:bg-pink-500 text-white border-pink-400">
			<span class="sr-only sm:not-sr-only">Continue to</span>Checkout
		</button>
	</div>
</div>
  </section>

    <Footer  class=" border-t" />
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
import Footer  from '@/Components/Footer.vue';

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
    cart: Object,
    cartTotal: Number,
  },
   data() {
    return {
      form: this.$inertia.form({
        id: 0,
        quantity: 0,

      }),
    };
  },
  methods:{
    updateCart(cartId, value){
      console.log("valeur "+cartId+" "+value);
      if(isNaN(value)){return};

      this.form.id=cartId;
      this.form.quantity=value;
        if(value==0){this.form.post(this.route('cart.remove')); }
        else{this.form.post(this.route('cart.update'));}


    }
  },
};
</script>
