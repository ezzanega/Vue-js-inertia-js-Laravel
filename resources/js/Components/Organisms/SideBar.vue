<template>
  <div class="flex w-45 flex-col bg-primary">
    <div class="flex grow flex-col overflow-y-auto pb-4">
      <div class="flex shrink-0 items-center px-4 mx-10 mt-5 mb-5">
        <a href="/" class="whitespace-normal">
          <span class="font-bold text-white text-xl flex space-x-1">
              <img src="/assets/favicon.png" class="h-7 bg-white rounded-lg p-0.5" alt="">
              <span class="text-lg">Sysdem</span>
          </span>
        </a>
      </div>
      <SideBarMenu />
      <div class="group mt-8 px-2">
        <div
          class="mt-1 space-y-1"
          role="group"
          aria-labelledby="highlights-headline"
        >
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-secondary hover:text-primary"
          >
            <span
              class="bg-white mr-4 h-2.5 w-2.5 rounded-full"
              aria-hidden="true"
            />
            <span class="mr-1 truncate">Se déconnecter</span>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { Link } from "@inertiajs/vue3";
import { Dropdown } from "floating-vue";
import ProfileMenuPopperContent from "@/Components/Molecules/ProfileMenuPopperContent.vue";
import SideBarMenu from "@/Components/Atoms/SideBarMenu.vue";
import ProfileMenu from "@/Components/Atoms/ProfileMenu.vue";
import { usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;
</script>