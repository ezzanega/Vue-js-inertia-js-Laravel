<template>
  <div class="mt-6 flex flex-1 flex-col overflow-y-auto">
    <nav class="flex-1 space-y-3 px-2">
      <SideBarItem item="Clients" />
      <SideBarItem item="Documents" />
      <SideBarItem item="Temletes" />
      <SideBarItem item="Gestion" />
      <SideBarItem item="Garde meubles" />
      <SideBarItem item="Réglages" />
    </nav>
  </div>
</template>
  
  <script setup>
  import SideBarItem from '@/Components/Atoms/SideBarItem.vue';
  </script>