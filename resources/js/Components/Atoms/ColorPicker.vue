<template>
  <div class="mx-5 flex items-center">
    <h1 class="text-primary truncate font-semibold mx-2">{{ label }} :</h1>
    <color-picker
      @update:pureColor="pureColorChange"
      shape="circle"
      v-model:pureColor="pureColor"
      v-model:gradientColor="gradientColor"
    />
  </div>
</template>
  
  <script setup lang="ts">
import { ref } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
  color: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
});
const pureColor = ref(props.color);
const gradientColor = ref(
  "linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 1) 100%)"
);

const pureColorChange = (c) => {
  emit("update:modelValue", c);
};
</script>