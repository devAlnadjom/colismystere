<template>
  <Head title="About us"/>

  <BreezeAuthenticatedLayout>
  <template #header>
    Drivers List
  </template>

  <div class="p-4 -bg-white rounded-lg shadow-xs">
    <div class="flex mb-4 w-full justify-between">
         <div class="flex flex-row w-3/5">
      <div class=" w-44">
                <select v-model="form.trashed" class=" rounded-l py-1 w-full border-r-0">
                    <option :value="null" />
                    <option value="with">All </option>
                    <option value="only">Trashed</option>
                  </select>
            </div>
              <div class="flex w-full bg-white shadow rounded">
      <input class="relative w-full px-4 py-1 rounded-r -focus:ring border" autocomplete="off" type="text" name="search" placeholder="Search…" v-model="form.search"  />
    </div>
    <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500 " type="button" @click="reset()">Reset</button>
    
      </div>
              <Link :href="route('driver.create')" active class="block">
                    <span class="flex ml-auto text-white bg-pink-400 border-0 py-1 px-4 focus:outline-none hover:bg-pink-500 rounded">Add New</span>
                </Link>
    </div>
   

    <div class="overflow-hidden mb-8 w-full rounded border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
            <th class="px-4 py-3"></th>
            <th class="px-4 py-3">name</th>
            <th class="px-4 py-3">Vehicule</th>
            <th class="px-4 py-3">Telephone</th>
            <th class="px-4 py-3">Action</th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y">
          <tr v-for="driver in drivers.data" :key="driver.id" class="text-gray-700">
            <td class="px-4 py-3 text-sm">
              
                <span class="mb-1"># - {{ driver.id }} </span>
           
   
            </td>
            <td class="px-4 py-3 text-sm">
              <span class="flex flex-row">
                <span class="mb-1">{{ driver.user.name }} </span>
                <span></span>
              </span>
              
            </td>
            
            <td class="px-4 py-3 text-sm">
              <span class=" font-semibold"> {{ driver.user.contact }}</span>
            </td>
            <td class="px-4 py-3 text-sm">
              <span class=" font-semibold"> {{ driver.vehicule_model }}</span>
            </td>
            <td class="px-4 py-3 text-sm">
              <span class=" p-1 text-xs bg-red-100 text-red-500 rounded" v-if="driver?.deleted_at!=null">Deleted</span>
              <span class=" p-1 text-xs bg-green-100 text-green-500 rounded" v-if="driver?.deleted_at==null">Avaible</span>
            </td>
            <td class="px-4 py-3 text-sm">
              
               <Link :href="route('driver.show',driver.id)" active class="text-sm text-gray-700 block">
                    <span class="text-green-500 hover:text-green-700 px-2 py-1 font-bold cursor-pointer">Edit</span>
                </Link>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <div
          class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        <pagination :links="drivers.links" />
      </div>
    </div>
  </div>

  <Modal  title="MoreInfo" v-if="modalOPen">
    <div class=" w-40 bg-pink-700 rounded-lg flex justify-between p-4">
      <h3 class=" text-2xl"> Hey</h3>
      <p class=""> This should works </p>
    </div>
  </Modal>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from "@inertiajs/inertia-vue3";
import Modal from '@/Components/Modal.vue';


import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import mapValues from 'lodash/mapValues';

export default {
  components: {
    BreezeAuthenticatedLayout,
    Pagination,
    Link,
    Modal,
  },

  data() {
        return {
            modalOpen:false,
            form: {
            search: this.filters.search,
            trashed: this.filters.trashed,
          },
        };
    },
  props: {
    drivers: Object,
    filters:Object,
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function() {
        this.$inertia.get(this.route('driver.index'), pickBy(this.form), { preserveState: true })
      }, 400),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
   
    
  },
}
</script>
