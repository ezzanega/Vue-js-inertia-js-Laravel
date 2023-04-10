<template>
  <div class="col-span-12">
    <div class="mb-3">
      <div>
        <label
          class="text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
          for="name-floating"
        >
          <span
            v-if="required"
            class="mr-1 text-sm text-red-500"
          >*</span>
          <span>{{ label }}</span>
        </label>
        <div class="relative">
          <input
            id="name-floating"
            type="text"
            class="form-input h-12 w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  defineProps({
    name: {
      type: String,
      default: '',
    },

    type: {
      type: String,
      default: '',
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
      default: '',
    },

    placeholder: {
      type: String,
      default: '',
    },
  });

</script>