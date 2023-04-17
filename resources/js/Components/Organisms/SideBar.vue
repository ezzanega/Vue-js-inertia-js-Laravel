<template>
  <div class="flex w-56 flex-col bg-primary">
    <div class="flex grow flex-col overflow-y-auto pt-5 pb-4">
      <div class="flex shrink-0 items-center px-4 m-10">
        <a
          href="/"
          class="whitespace-normal"
        >
          <span class="font-bold text-white text-xl">6dem CRM</span></a>
      </div>
      <SideBarMenu />
      <div class="group mt-8 px-2">
        <div
          class="mt-1 space-y-1"
          role="group"
          aria-labelledby="highlights-headline"
        >
          <a
            href="#"
            class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-secondary hover:text-primary"
          >
            <span
              class="bg-white mr-4 h-2.5 w-2.5 rounded-full"
              aria-hidden="true"
            />
            <span class="mr-1 truncate">Activités (0)</span></a>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import SideBarMenu from '@/Components/Atoms/SideBarMenu.vue';
</script>