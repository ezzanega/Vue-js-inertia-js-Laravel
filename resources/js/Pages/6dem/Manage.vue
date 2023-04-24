<template>
  <Head title="Gestion" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <ListEmptyMessage
        message-title="La page Gestion"
        message-content="La page Gestion est en cours de développement"
      />
    </div>
  </DemLayout>
</template>
    
<script setup>
  import DemLayout from '@/Layouts/DemLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
</script>