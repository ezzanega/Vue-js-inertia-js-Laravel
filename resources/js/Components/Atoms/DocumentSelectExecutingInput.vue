<template>
    <DocumentFieldFrame>
      <select
        @input="$emit('update:modelValue', $event.target.value)"
        @change="$emit('change')"
        :id="id"
        :name="name"
        :value="value"
        class="form-input py-1 w-full rounded-md bg-secondary border-none focus:outline-none focus:ring-0 focus:border-none"
      >
        <option value="" selected="selected">{{ defaultText }}</option>
        <option
          v-for="(option, index) in options"
          :key="index"
          :value="option.id"
        >
          {{ option.name }}
        </option>
      </select>
    </DocumentFieldFrame>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
  defineEmits(["update:modelValue", "change"]);
  
  const input = ref(null);
  
  defineExpose({ focus: () => input.value.focus() });
  
  defineProps({
    defaultText: {
      type: String,
      required: true,
    },

    value: {
      type: String,
      required: true,
    },
  
    name: {
      type: String,
      default: "",
    },
  
    type: {
      type: String,
      default: "text",
    },
  
    required: {
      type: Boolean,
      default: false,
    },
  
    label: {
      type: String,
      default: "",
    },
  
    options: {
      type: Array,
      default: [],
    },
  
    error: {
      type: String,
      default: "",
    },
  });
  </script>
  