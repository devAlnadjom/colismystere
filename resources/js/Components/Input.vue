<template>
  <input
      class="mt-1 border-gray-300 rounded-md shadow-sm  focus:border-primary-200  focus:ring-1 focus:ring-primary-100 focus:ring-opacity-50 focus-within:text-primary-600"
      :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
</template>

<script>
export default {
  props: ["modelValue"],

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>
