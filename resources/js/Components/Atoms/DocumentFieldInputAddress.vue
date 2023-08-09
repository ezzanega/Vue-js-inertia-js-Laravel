<template>
  <div class="col-span-12 h-full">
    <div class="relative" :class="classText">
          <GMapAutocomplete
            :id="'name-floating-' + name"
            :placeholder="placeholder"
            autocomplete="off"
            :value="value"
            @place_changed="placeChanged"
            @focusout="$emit('savingValue')"
            @input="$emit('update:modelValue', $event.target.value)"
            class="form-input custom w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-0 focus:border-none"
            :options="{
              componentRestrictions: { country: 'FR' },
            }"
          />
          <InputError v-if="error" class="mt-1" :message="error" />
        </div>
  </div>
</template>
    
<script setup>
import { ref, nextTick, onMounted, watch } from "vue";
import InputError from "@/Components/InputError.vue";
import { parseLocation } from "@/utils/index";
const emit = defineEmits(["update:modelValue","savingValue", "place_changed"]);
const props = defineProps({
  value: {
    type: String,
    required: true,
  },

  name: {
    type: String,
    default: "",
  },

  className: {
    type: String
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

  fontBold: {
    type: Boolean,
    default: false,
  },
});

const classText = ref(props.className);

const placeChanged = (location) => {
  emit("place_changed", parseLocation(location));
};

</script>
<style scoped>
.custom {
  background-color: #edf3f1;
}
</style>