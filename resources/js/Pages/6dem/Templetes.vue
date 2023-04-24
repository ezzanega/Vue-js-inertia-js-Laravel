<template>
  <Head title="Templetes" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <ListEmptyMessage
        message-title="La page des Templetes"
        message-content="La page des Templetes est en cours de développement"
      />
    </div>
  </DemLayout>
</template>
    
<script setup>
    import DemLayout from '@/Layouts/DemLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
</script>