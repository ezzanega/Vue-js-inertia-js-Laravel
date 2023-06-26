<template>
  <Head title="Documents" />
  <DemLayout>
    <Tabs>
      <Tab title="Devis">
        <ListEmptyMessage
          message-title="Vous n'avez pas de devis créés"
          message-content="Commencez par ajouter un nouveau devis"
        >
        <SelectClientModal/>
        </ListEmptyMessage>
      </Tab>
      <Tab title="Lettres de voiture">
        <ListEmptyMessage
          message-title="Vous n'avez pas de lettres de voiture créées"
          message-content="Commencez par ajouter une nouvelle lettre de voiture"
        >
        <SelectQuoteModal/>
        </ListEmptyMessage>
      </Tab>
      <Tab title="Facture">
        <ListEmptyMessage
          message-title="Vous n'avez pas de factures créées"
          message-content="Commencez par ajouter une nouvelle facture"
        >
          <IconButton
            @click="openInviteUserModal"
            class="mt-6"
            text="Ajouter une facture"
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
      </Tab>
    </Tabs>
  </DemLayout>
</template>
  
<script setup>
import DemLayout from '@/Layouts/DemLayout.vue';
import { Head } from '@inertiajs/vue3';
import IconButton from '@/Components/Atoms/IconButton.vue';
import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
import Drawer from '@/Components/Organisms/Drawer.vue';
import DrawerContent from '@/Components/Molecules/DrawerContent.vue';
import SelectClientModal from '@/Components/Organisms/SelectClientModal.vue';
import SelectQuoteModal from '@/Components/Organisms/SelectQuoteModal.vue';
import { ref } from 'vue';
import Tabs from "@/Components/Molecules/Tabs.vue";
import Tab from "@/Components/Atoms/Tab.vue";

let isDrawerOpen = ref(false);
let innerWidth = ref(window.innerWidth / 4 + 'px');

const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};

const closeDrawer = () => {
  isDrawerOpen.value = false;
};
</script>