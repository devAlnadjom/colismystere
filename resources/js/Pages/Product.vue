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
  <section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{product.supplier}}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{product.name}}</h1>
        <div class="flex mb-4">
          <a class="flex-grow border-b-2 border-gray-300 py-2 text-lg px-1 cursor-pointer" :class="{ 'text-pink-400  border-pink-400': tabposition==1 }" @click="tabposition=1">Description</a>
          <a class="flex-grow border-b-2 border-gray-300 py-2 text-lg px-1 cursor-pointer" :class="{ 'text-pink-400  border-pink-400': tabposition==2 }" @click="tabposition=2">Reviews</a>
          <a class="flex-grow border-b-2 border-gray-300 py-2 text-lg px-1 cursor-pointer" :class="{ 'text-pink-400  border-pink-400': tabposition==3 }" @click="tabposition=3">Details</a>
        </div>
        <div v-show="tabposition==1" class="transition duration-300">
          <p class="leading-relaxed mb-4">{{product.description}}</p>
          <div v-for="feature in product.features" :key="feature.id" class="flex border-t border-gray-200 py-2">
          <span class="text-gray-500">{{feature.name}}</span>
          <span class="ml-auto text-gray-900">{{feature.description}}</span>
        </div>
        </div>

        <div v-show="tabposition==2" class="transition duration-150">
          <p class="leading-relaxed mb-4 h-24">No comment found...</p>
          
        </div>

        <div v-show="tabposition==3">
          <p class="leading-relaxed mb-4">{{product.small_description}}</p>
          
        </div>
        
        
        
        <div class="flex">
          <span class="title-font font-medium text-2xl text-gray-900">{{product.price/100 }}$</span>
          <button class="flex ml-auto text-white bg-pink-400 border-0 py-2 px-6 focus:outline-none hover:bg-pink-500 rounded" @click="addTocart(product.id)">Add To Cart</button>
          <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
          </button>
        </div>
      </div>
      <img v-if="!product.media[0]" alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/400x400">
      <img v-if="product.media[0]" alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" :src="makeimg(product.media[0])">
    </div>
  </div>
</section>

<Footer class="text-gray-600 border-t" />
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
    product: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: this.product.id,
        name: this.product.name,
        price: this.product.price,
        quantity:1,
        thumb:null
      }),

      tabposition:1,
    };
  },

  methods :{

    maketmg(img){
      return "/storage/"+img.id+"/conversions/"+this.getThunb(img.file_name);
    },

    getThunb(img){
      let filen= img.split('.')[0];
      
      return filen+"-thumb.jpg";
    },
      addTocart(ide){
          this.form.thumb= "/storage/"+this.product.media[0].id+"/conversions/"+this.getThunb(this.product.media[0].file_name);
          this.form.post(this.route('cart.store'));
      },

      makeimg(img){
      return "/storage/"+img.id+"/"+img.file_name;
    },

    
  }
};
</script>
