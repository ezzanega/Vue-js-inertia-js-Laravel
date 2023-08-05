<template>
  <div>
    <label for="location" class="block text-sm font-medium text-gray-700">
      <div class="flex">
        <span>
          {{ label }}
        </span>
      </div>
    </label>
    <select
      @input="$emit('update:modelValue', $event.target.value)"
      :id="name"
      :name="name"
      class="form-input h-12 w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
    >
      <option value="" selected="selected">--</option>
      <option
        v-for="(option, index) in options"
        :key="index"
        :value="option.value"
      >
        {{ option.name }}
      </option>
    </select>
    <InputError v-if="error" class="mt-1" :message="error" />
  </div>
</template>

<script setup>
import { ref } from "vue";
import InputError from "@/Components/InputError.vue";
defineEmits(["update:modelValue"]);

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });

defineProps({
  modelValue: {
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

  selectedValue: {
    type: String,
    default: "",
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
