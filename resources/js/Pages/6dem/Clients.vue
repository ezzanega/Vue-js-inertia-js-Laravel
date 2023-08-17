<template>
  <Head title="Clients" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <div class="">
        <ClientList class="mt-2"  @openMailModal="openMailModal" :deleteClient="deleteClient" :opendelModal="opendelModal"/>

        <ClientMailModal :isMailOpen="isMailOpen" :client="currentClient" @closeMailModal="closeMailModal" />

        <DeleteFormModal :isModaldelOpen="isModaldelOpen"
        @closedelModal="closedelModal()" @deleteFunction="deleteClient(selectedClient)"/>

      </div>
    </div>
  </DemLayout>
</template>

<script setup>

import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import IconButton from "@/Components/Atoms/IconButton.vue";
import ClientList from "@/Components/Molecules/ClientList.vue";
import Drawer from "@/Components/Organisms/Drawer.vue";
import CreateClientForm from "@/Components/Organisms/CreateClientForm.vue";
import ClientMailModal from "@/Components/Molecules/ClientMailModal.vue";
import DeleteFormModal from "@/Components/Atoms/DeleteFormModal.vue";
import DrawerContent from "@/Components/Molecules/DrawerContent.vue";
import { ref } from "vue";
import { router } from '@inertiajs/vue3'



let isDrawerOpen = ref(false);
const currentClient = ref(null);

const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};

const closeDrawer = () => {
  isDrawerOpen.value = false;
};

const isMailOpen = ref(false);

const openMailModal = (client) => {
  currentClient.value = client;
  isMailOpen.value = true;
};
const closeMailModal = () => {
    isMailOpen.value = false;
};

//début Open  et Close de formulaire de suppression Client
function deleteClient(id) {
    router.delete(`/6dem/clients/delete/${id}`, {
        onBefore: () => opendelModal(),
        onSuccess:() => closedelModal()
    });
}
//début Open et Close Pop-up
const isModaldelOpen=ref(false);
const selectedClient=ref(null);

const opendelModal = (id,type) => {
    isModaldelOpen.value = true;
    selectedClient.value = id;
};

const closedelModal = () => {
    isModaldelOpen.value = false;
};
//fin Open et Close Pop-up

//fin Open et Close de formulaire de suppression Client
</script>
