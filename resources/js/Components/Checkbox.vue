<template>
  <input type="checkbox" :value="value" v-model="proxyChecked"
         class="text-pink-600  form-checkbox focus:border-pink-400 focus:outline-none focus:shadow-outline-pink dark:focus:shadow-outline-gray"/>
</template>

<script>
export default {
  emits: ["update:checked"],

  props: {
    checked: {
      type: [Array, Boolean],
      default: false,
    },
    value: {
      default: null,
    },
  },

  computed: {
    proxyChecked: {
      get() {
        return this.checked;
      },

      set(val) {
        this.$emit("update:checked", val);
      },
    },
  },
};
</script>
