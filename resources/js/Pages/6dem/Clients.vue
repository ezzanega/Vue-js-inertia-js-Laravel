<template>
  <Head title="Clients" />
  <DemLayout>
    <div class="mb-4 text-sm text-gray-600">
      <div class="">
        <ClientList class="mt-2"  @openMailModal="openMailModal" :deleteClient="deleteClient" :opendelModal="opendelModal"/>

        <ClientMailModal :isMailOpen="isMailOpen" :client="currentClient" @closeMailModal="closeMailModal" />

        <DeleteFormModal :isModaldelOpen="isModaldelOpen"
        @closedelModal="closedelModal()"
        @deleteFunction="deleteClient(selectedClient)"/>

      </div>
    </div>
  </DemLayout>
</template>

<script setup>

import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import ClientList from "@/Components/Molecules/ClientList.vue";
import ClientMailModal from "@/Components/Molecules/ClientMailModal.vue";
import DeleteFormModal from "@/Components/Atoms/DeleteFormModal.vue";
import { ref } from "vue";
import { router } from '@inertiajs/vue3'

const currentClient = ref(null);

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
</script>
