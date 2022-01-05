<template>
  <Head title="About us"/>

  <BreezeAuthenticatedLayout>
  <template #header>
    Orders
  </template>

  <div class="p-4 -bg-white rounded-lg shadow-xs">
    <div class="flex mb-4 w-full  flex-row-reverse">
      
        <button class="flex ml-auto text-white bg-pink-400 border-0 py-2 px-6 focus:outline-none hover:bg-pink-500 rounded" @click="$inertia.visit(route('order.create'))">Add New</button>
          
    </div>

    <div class="overflow-hidden mb-8 w-full rounded border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Receveur date</th>
            <th class="px-4 py-3">Receiver</th>
            <th class="px-4 py-3">Total</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Action</th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y">
          <tr v-for="order in orders.data" :key="order.id" class="text-gray-700">
            <td class="px-4 py-3 text-sm">
              
              <span class="flex flex-col">
                <!--span class="mb-1"># - {{ order.id }} </span-->
                <span class=" font-light">{{ order.created_at.substring(0,10) }}</span>
              </span>
            </td>
            <td class="px-4 py-3 text-sm">
              <span class="flex flex-row">
                <span class="mb-1">{{ order.recipient_name }} </span>
                <span></span>
              </span>
              
            </td>
            <td class="px-4 py-3 text-sm">
              <span class="flex flex-col">
                <span class=" mb-1">{{ order.recipient_address }}</span>
                <span class=" font-bold text-xs">{{order.recipient_zip_code }}</span>
              </span>
            </td>
            <td class="px-4 py-3 text-sm">
              <span class=" font-semibold">$ {{ order.total/100 }}</span>
            </td>
            <td class="px-4 py-3 text-sm">
              <span class=" p-1 text-xs bg-red-100 text-red-500 rounded" v-if="order.status==0">Cancelled</span>
              <span class=" p-1 text-xs bg-blue-100 text-blue-500 rounded" v-if="order.status==1">Paid</span>
              <span class=" p-1 text-xs bg-yellow-100 text-yellow-500 rounded" v-if="order.status==2">Planed</span>
              <span class=" p-1 text-xs bg-green-100 text-green-500 rounded" v-if="order.status==3">Delivered</span>
              <span class=" p-1 text-xs bg-gray-100 text-gray-600 rounded" v-if="order.status==5">Rembourser</span>
            </td>
            <td class="px-4 py-3 text-sm">
              
               <Link :href="route('order.show',order.id)" active class="text-sm text-gray-700 block">
                    <span class="text-green-500 hover:text-green-700 px-2 py-1 font-bold cursor-pointer">Edit</span>
                </Link>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <div
          class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        <pagination :links="orders.links" />
      </div>
    </div>
  </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Pagination,
    Link,
  },

  props: {
    orders: Object,
  }
}
</script>
