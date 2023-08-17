<template>
  <div class="col-span-12">
    <div class="mb-3">
      <div>
        <label
          v-if="label"
          class="text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
          :for="'name-floating-' + name"
        >
          <span v-if="required" class="mr-1 text-sm text-red-500">*</span>
          <span>{{ label }}</span>
        </label>
        <div class="relative">
          <input
            :id="'name-floating-' + name"
            :type="type"
            :placeholder="placeholder"
            :value="modelValue"
            :disabled="disabled"
            @focusout="$emit('savingValue')"
            @input="$emit('update:modelValue', $event.target.value)"
            class="form-input h-12 w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
          />
          <InputError v-if="error" class="mt-1" :message="error" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import { onMounted, ref } from "vue";

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

  disabled: {
    type: Boolean,
    default: false,
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