<template>
  <Head title="Réglages" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <ListEmptyMessage
        message-title="La page Réglages"
        message-content="La page Réglages est en cours de développement"
      />
    </div>
  </DemLayout>
</template>
        
<script setup>
  import DemLayout from '@/Layouts/DemLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
</script>