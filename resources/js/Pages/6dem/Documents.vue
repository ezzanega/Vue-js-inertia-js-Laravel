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
          @click="toggleDrawer"
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
    <Drawer
    :is-open="isDrawerOpen"
    :speed="500"
    :max-width="innerWidth"
    @close="closeDrawer"
  >
    <div>
      <DrawerContent
        title="Choix du document"
        @closeDrawer="closeDrawer()"
      >
        <IconButton
          class="mt-6"
          text="Devis"
          @click="createDocument('6dem.documents.devis')"
        />
        <IconButton
          class="mt-6"
          text="Facture client"
        /> 
        <IconButton
          class="mt-6"
          text="Lettre de voiture"
        /> 
      </DrawerContent>
    </div>
  </Drawer>
  </DemLayout>
</template>
  
<script setup>
    import DemLayout from '@/Layouts/DemLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import IconButton from '@/Components/Atoms/IconButton.vue';
    import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
    import Drawer from '@/Components/Organisms/Drawer.vue';
    import DrawerContent from '@/Components/Molecules/DrawerContent.vue';
    import { router } from '@inertiajs/vue3'
    import { ref } from 'vue';

    let isDrawerOpen = ref(false);
    let innerWidth = ref(window.innerWidth/4 + 'px');

    const toggleDrawer = () => {
      isDrawerOpen.value = !isDrawerOpen.value;
    };

    const closeDrawer = () => {
      isDrawerOpen.value = false;
    };

    const createDocument = (routeLink) => {
      router.get(route(routeLink));
    };
</script>