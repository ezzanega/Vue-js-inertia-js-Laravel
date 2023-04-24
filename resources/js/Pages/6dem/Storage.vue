<template>
  <Head title="Garde Meubles" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <ListEmptyMessage
        message-title="La page Garde Meubles"
        message-content="La page Garde Meubles est en cours de développement"
      />
    </div>
  </DemLayout>
</template>
      
<script setup>
    import DemLayout from '@/Layouts/DemLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
</script>