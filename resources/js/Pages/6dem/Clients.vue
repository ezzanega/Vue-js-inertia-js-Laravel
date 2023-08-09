<template>
  <Head title="Clients" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <div class="">
        <IconButton @click="toggleDrawer" class="mt-6" text="Créer un client">
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
        <Drawer
          :is-open="isDrawerOpen"
          :speed="500"
          max-width="680px"
          @close="closeDrawer"
        >
          <div>
            <DrawerContent title="Create client" @closeDrawer="closeDrawer()">
              <CreateClientForm @close="closeDrawer()" />
            </DrawerContent>
          </div>
        </Drawer>
        <ClientList class="mt-2"  @openMailModal="openMailModal"/>
        <IconButton @click="openMailModal" class="mt-6" text="Envoyer un Mail">
        </IconButton>
        <ClientMailModal :isMailopen="isMailopen" @closeMailModal="closeMailModal" />

      </div>
    </div>
  </DemLayout>
</template>

<script setup>

import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import IconButton from "@/Components/Atoms/IconButton.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import ClientList from "@/Components/Molecules/ClientList.vue";
import Drawer from "@/Components/Organisms/Drawer.vue";
import CreateClientForm from "@/Components/Organisms/CreateClientForm.vue";
import ClientMailModal from "@/Components/Molecules/ClientMailModal.vue";
import ClientActionsPopperContent from "@/Components/Molecules/ClientActionsPopperContent.vue";
import DrawerContent from "@/Components/Molecules/DrawerContent.vue";
import { ref } from "vue";


let isDrawerOpen = ref(false);

const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};

const closeDrawer = () => {
  isDrawerOpen.value = false;
};

const isMailopen = ref(false);


const openMailModal = () => {
  console.log("Opening mail modal");
  isMailopen.value = true; // Open the modal
};
const closeMailModal = () => {
    isMailopen.value = false;
};
</script>
