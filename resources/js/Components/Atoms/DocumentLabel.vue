<template>
  <span
    class="border border-gray-200 rounded-md w-full p-1 text-center text-xl font-bold"
    :style="{ color: `${color}` }"
  >
    {{ name }}
  </span>
</template>
      
    <script setup>
import { ref } from "vue";
const props = defineProps({
  name: {
    type: String,
    default: "",
  },

  color: {
    type: String,
    default: "#000",
  },
});

const inputValue = ref(props.modelValue);
</script>