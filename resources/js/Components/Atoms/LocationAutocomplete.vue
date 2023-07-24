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
          <GMapAutocomplete
            :id="'name-floating-' + name"
            :placeholder="placeholder"
            autocomplete="off"
            :value="value"
            @place_changed="placeChanged"
            class="form-input h-12 w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
            :options="{
              componentRestrictions: { country: 'FR' },
            }"
          />
          <InputError v-if="error" class="mt-1" :message="error" />
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";
import { parseLocation } from "@/utils/index";

const emit = defineEmits(["update:modelValue", "place_changed"]);
const input = ref(null);
defineExpose({ focus: () => input.value.focus() });
defineProps({
  value: {
    type: String,
    required: true,
  },

  name: {
    type: String,
    default: "",
  },

  required: {
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

const placeChanged = (location) => {
  emit("place_changed", parseLocation(location));
};
</script>