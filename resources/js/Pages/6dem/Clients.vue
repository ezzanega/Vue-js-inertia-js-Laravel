<template>
  <Head title="Clients" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <!-- <div>
        <ListEmptyMessage
          message-title="Vous n'avez pas de clients ajoutés"
          message-content="Commencez par ajouter un nouveau client."
        >
          <div class="mt-6 flex items-center space-x-2">
            <IconButton text="Ajouter un client">
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
            <IconButton
              class="mx-auto"
              custom-class="bg-secondary text-primary"
              text="Importer une liste de client (fichier CSV)"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
                class="pointer-events-none shrink-0 h-5 w-5 -ml-1 mr-2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                />
              </svg>
            </IconButton>
          </div>
        </ListEmptyMessage>
      </div> -->

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
          :max-width="innerWidth"
          @close="closeDrawer"
        >
          <div>
            <DrawerContent title="Create client" @closeDrawer="closeDrawer()">
              <CreateClientForm @created="closeDrawer()" />
            </DrawerContent>
          </div>
        </Drawer>
        <ClientList class="mt-2" />
      </div>
    </div>
  </DemLayout>
</template>

<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head } from "@inertiajs/vue3";
import IconButton from "@/Components/Atoms/IconButton.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import ClientList from "@/Components/Molecules/ClientList.vue";
import Drawer from "@/Components/Organisms/Drawer.vue";
import CreateClientForm from "@/Components/Organisms/CreateClientForm.vue";
import DrawerContent from "@/Components/Molecules/DrawerContent.vue";
import { ref } from "vue";

let isDrawerOpen = ref(false);
let innerWidth = ref(window.innerWidth / 2 + "px");

const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};

const closeDrawer = () => {
  isDrawerOpen.value = false;
};
</script>