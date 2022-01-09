<template>
  <Head title="Welcome" />

  <div
    class=" relative flex
      items-top
      justify-center
      min-h-screen
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
        <Link :href="route('login')" class="text-sm text-gray-700 underline">
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
      <section class="text-gray-600 body-font bg-pink-50">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-2/3 flex flex-col sm:flex-row sm:items-center items-start mx-auto">
      <h1 class="flex-grow sm:pr-16 text-2xl font-medium title-font text-gray-900">Already Have your <b class=" text-pink-300">Mysterious Gift</b>? Let us deliver it for you by the best way.</h1>
      <button class="flex-shrink-0 text-white bg-pink-400 border-0 py-2 px-8 focus:outline-none hover:bg-pink-500 rounded text-lg mt-10 sm:mt-0">Process</button>
    </div>
  </div>
</section>
      <section class="text-gray-600 body-font bg-gray-50">
        <div class="container px-5 py-24 mx-auto">
          <div class="flex flex-wrap -m-4">
            <div v-for="product in products.data" :key="product.id" class="lg:w-1/3 md:w-1/2 p-4 w-full">
              <a class="block relative h-48 rounded overflow-hidden">
                <img v-if="!product.media[0]"
                  alt="ecommerce"
                  class="object-cover object-center w-full h-full block"
                  src="https://dummyimage.com/420x260"
                />
                <img v-if="product.media[0]"
                  alt="ecommerce"
                  class="object-cover object-center w-full h-full block"
                  :src="makeimg(product.media[0])"
                />
              </a>
              <div class="mt-4">
                  <div class="flex flex-wrap">
                      <h3 v-for="category in product.categories" :key="category.id"
                  class="text-gray-500 text-xs tracking-widest title-font mb-1 mr-2">
                  {{category.name}}
                </h3>
                  </div>

                <Link :href="route('product.view', [product.slug,product.id] )" class="text-pink-800 title-font text-lg font-medium">
                  {{product.name}}
                </Link>
                <p class="mt-1">{{Math.floor(product.price/100) }} $</p>
              </div>
            </div>

          </div>
        </div>

        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">


  <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-700">
        Showing
        <span class="font-medium">1</span>
        to
        <span class="font-medium">9</span>
        of
        <span class="font-medium">30</span>
        results
      </p>
    </div>
    <div>
        <pagination :links="products.links" />

    </div>
  </div>
</div>
      </section>
    </div>
  </div>

    <Footer />
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
import Pagination from '@/Components/Pagination.vue';
import Footer from '@/Components/Footer.vue';

export default {
  components: {
    Head,
    Link,
    Pagination,
    Footer,
  },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    products: Object,
  },
  methods:{
      makeimg(img){
      return "/storage/"+img.id+"/"+img.file_name;
    }
  }
};
</script>
