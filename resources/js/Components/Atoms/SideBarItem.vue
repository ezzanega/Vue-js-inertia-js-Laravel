<template>
  <Link :href="route(itemroute)"
    class="hover:bg-secondary hover:text-primary group relative flex items-center rounded-md px-2 py-3 text-md font-bold"
    :class="[(route(itemroute).includes($page.url.split('/').slice(1, 3).join('/') || '')) ? 'text-primary bg-secondary' : 'text-white']"
  >
    <slot />
    {{ item }}
  </Link>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
  item: {
    type: String,
    default: "",
  },
  itemroute: {
    type: String,
    default: "",
  },
});
</script>