<template>
  <div class="w-48 divide-y divide-neutral-200 dark:divide-neutral-700">
    <div class="py-1">
      <a
        href="#"
        class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900"
        >Mon compte </a
      ><a
        href="#"
        class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900"
        >Calendrier</a
      >
    </div>
    <div class="py-1">
      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50 hover:text-neutral-900"
        >Se déconnecter</Link
      >
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
