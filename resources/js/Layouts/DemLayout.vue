<template>
  <body>
    <div class="flex h-screen overflow-hidden bg-neutral-100">
      <div class="hidden bg-white md:flex md:shrink-0 shadow">
        <SideBar />
      </div>

      <div class="flex w-0 flex-1 flex-col overflow-hidden">
        <!-- Top Bar -->
        <TopBar />
        <ToastList/>
        <main
          id="main"
          class="relative flex-1 focus:outline-none overflow-y-auto"
        >
          <div class="py-6">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
              <slot />
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</template>
  
  <script setup>
import SideBar from "@/Components/Organisms/SideBar.vue";
import TopBar from "@/Components/Organisms/TopBar.vue";
import ToastList from "@/Components/ToastList.vue";
defineProps({});
</script>