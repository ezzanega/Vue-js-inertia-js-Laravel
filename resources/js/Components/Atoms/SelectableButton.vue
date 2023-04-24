<template>
  <button
    type="button"
    class="
        flex
        items-center
        justify-center
        border
        px-3
        space-x-2.5
        rounded-md
        shadow-sm
        focus:outline-none
      "
    :class="[
      selected ? 'bg-primary text-white' : 'bg-white text-primary',
      customStyle != '' ? customStyle : 'py-3 w-full',
    ]"
    @click="$emit('selected', value)"
  >
    <span>
      <slot />
    </span>
    <span class="font-inter">
      {{ text }}
    </span>
  </button>
</template>
  

<script setup>
    defineProps({
        text: {
            type: String,
            default: '',
        },

        value: {
            type: String,
            default: '',
        },

        customStyle: {
            type: String,
            default: '',
        },

        selected: {
            type: Boolean,
            default: false,
        },

        type: {
            type: String,
            default: '',
        },
    });
</script>
  