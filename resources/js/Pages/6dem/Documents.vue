<template>
  <Head title="Documents" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <ListEmptyMessage
        message-title="Vous n'avez pas de documents créés"
        message-content="Commencez par ajouter un nouveau document"
      >
        <IconButton
          class="mt-6"
          text="Créer un document"
        > 
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2.2"
            stroke="currentColor"
            aria-hidden="true"
            class="pointer-events-none shrink-0 w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 4.5v15m7.5-7.5h-15"
            />
          </svg>
        </IconButton>
      </ListEmptyMessage>
    </div>
  </DemLayout>
</template>
  
<script setup>
    import DemLayout from '@/Layouts/DemLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import IconButton from '@/Components/Atoms/IconButton.vue';
    import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
</script>