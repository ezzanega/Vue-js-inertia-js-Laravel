<template>
    <div class="w-auto">
      <div class="space-y-0.5">
        <PopperItem item="Fiche du client" @clicked="goToClientDetails">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>
        </PopperItem>
        <PopperItem item="Modifier" @clicked="openUpdateClient">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
            />
          </svg>
        </PopperItem>
        <PopperItem
          item="Créer un devis pour ce client"
          @clicked="initQuatation"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
            />
          </svg>
        </PopperItem>
        <PopperItem item="Envoyer un mail" @clicked="openMailModal">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            aria-hidden="true"
            class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"
            />
          </svg>
        </PopperItem>
        <PopperItem item="Supprimer le client" @clicked="opendelModal(client.id) ">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
            />
          </svg>
        </PopperItem>
      </div>
    </div>
  </template>

    <script setup>
  import PopperItem from "@/Components/Atoms/PopperItem.vue";
  import { router } from "@inertiajs/vue3";

  import { defineEmits } from 'vue';

  const props = defineProps({
    client: {
      type: Object,
      required: true,
    },
    deleteClient:Function,
    opendelModal:Function,
    //Pour la modification
    isDrawerUpOpen:Boolean,
    openUpdateClient:Function,
    selectedClient:Object
  });

  const emit = defineEmits(["openMailModal","deleteClient","openUpdateClient","selectedClient"]);

  const openMailModal = () => {
    emit('openMailModal');
  };

  const openUpdateClient = () => {
    emit('openUpdateClient', props.selectedClient);
  }

  const initQuatation = () => {
    router.visit(
      route("6dem.documents.quotation.init", props.client.id),
      {
        method: "post",
        replace: true
      }
    );
  };


  const goToClientDetails = () => {
    router.visit(
      route("6dem.clients.details", props.client.id),
      {
        method: "get",
        replace: true
      }
    );
  };

  const PopperItemClicked = () => {};
  </script>
