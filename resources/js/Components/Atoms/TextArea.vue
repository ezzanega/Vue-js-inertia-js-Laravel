<template>
  <div class="">
    <label
      class="text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
      :for="'editor-' + name"
      >{{ label }}</label
    >
    <textarea
      :id="'editor-' + name"
      rows="8"
      :placeholder="placeholder"
      :value="modelValue"
      class="block w-full text-sm text-gray-800 border-0 focus:ring-0 rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
      @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
    <InputError v-if="error" class="mt-1" :message="error" />
  </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";

defineEmits(["update:modelValue"]);

defineProps({
  modelValue: {
    type: String,
    required: true,
  },

  name: {
    type: String,
    default: "",
  },

  label: {
    type: String,
    default: "",
  },

  placeholder: {
    type: String,
    default: "",
  },

  error: {
    type: String,
    default: "",
  },
});
</script>