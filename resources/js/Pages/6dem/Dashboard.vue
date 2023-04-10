<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <Head title="Design Sys" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <Drawer
        :is-open="isDrawerOpen"
        :speed="500"
        max-width="900px"
        @close="closeDrawer"
      >
        <div>
          <h2>Drawer Slot here</h2>
        </div>
      </Drawer>
      <button @click="toggleDrawer">
        Toggle Drawer
      </button>
    </div>
  </DemLayout>
</template>
  
  <script setup>
  import DemLayout from '@/Layouts/DemLayout.vue';
  import Drawer from '@/Components/Organisms/Drawer.vue';
  import { Head } from '@inertiajs/vue3';
  import { ref } from 'vue';

  let isDrawerOpen = ref(false);

  const toggleDrawer = () => {
    isDrawerOpen.value = !isDrawerOpen.value;
  };

  const closeDrawer = () => {
    isDrawerOpen.value = false;
  };
  </script>