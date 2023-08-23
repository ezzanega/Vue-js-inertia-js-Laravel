<template>
  <div class="w-auto">
    <div class="space-y-0.5">
      <PopperItem item="Previsualiser" @clicked="previewQuotation">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </PopperItem>
      <PopperItem item="Modifier" @clicked="updateQuotation(quotation)">
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
      <PopperItem item="Changer le statut du devis" @clicked="openChangeStatusModal">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
        </svg>
      </PopperItem>
      <ChangeStatus :quotation="props.quotation" :openModal="changeStatusModal" @closeModal="closeChangeStatusModal" />
      <PopperItem v-if="client.type === 'individual'" item="Dupliquer dans une autre formule"
        @clicked="PopperItemClicked">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
        </svg>
      </PopperItem>
      <PopperItem item="Enregister un paiement" @clicked="PopperItemClicked">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
        </svg>
      </PopperItem>
      <div v-if="props.quotation.status === 'Accepté'">
        <PopperItem item="Créer une facture pour ce devis" @clicked="openCreateInvoiceModal">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
          </svg>
        </PopperItem>
        <InvoiceModal :quotation="props.quotation" :openModal="createInvoiceModal"
          @closeModal="closeCreateInvoiceModal" />
      </div>
      <div v-if="props.quotation.status === 'Accepté'">
        <PopperItem item="Générer la lettre de voiture" @clicked="openSelectExecutingModal">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
        </svg>
      </PopperItem>
      <SelectExecutingModal :quotation="props.quotation" :openModal="selectExecutingModal"
          @closeModal="closeSelectExecutingModal" />
      </div>
      <PopperItem item="Envoyer au client" @clicked="PopperItemClicked">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
        </svg>
      </PopperItem>
      <PopperItem item="Supprimer le devis" @clicked="opendelModal(quotation.id)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
        </svg>
      </PopperItem>
    </div>
  </div>
</template>

<script setup>
import PopperItem from "@/Components/Atoms/PopperItem.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import ChangeStatus from "@/Components/Molecules/ChangeStatus.vue";
import InvoiceModal from "@/Components/Molecules/InvoiceModal.vue";
import SelectExecutingModal from "@/Components/Molecules/SelectExecutingModal.vue";


const props = defineProps({
  movingjob: {
    required: true,
  },
  client: {
    type: Object,
    required: true,
  },
  //Props pour la suppression de document
  quotation: {
    type: Object,
    required: true,
  },
  deletequotation: Function,
  opendelModal: Function,
  //Props pour la dupliquation de devis
  openDupQuotModal:Function
});

const changeStatusModal = ref(false);
const createInvoiceModal = ref(false);
const selectExecutingModal = ref(false);

const PopperItemClicked = () => { };
const previewQuotation = () => {
  router.visit(route("6dem.documents.quotation.preview", props.quotation.id), {
    method: "get",
  });
};

const updateQuotation = () => {
  router.visit(route("6dem.documents.quotation", [props.movingjob.id, props.client.id, props.quotation.id]), {
    method: "get",
  });
};

const openChangeStatusModal = () => {
  changeStatusModal.value = true;
};

const closeChangeStatusModal = () => {
  changeStatusModal.value = false;
};

const openCreateInvoiceModal = () => {
  createInvoiceModal.value = true;
};

const closeCreateInvoiceModal = () => {
  createInvoiceModal.value = false;
};

const openSelectExecutingModal = () => {
  selectExecutingModal.value = true;
};

const closeSelectExecutingModal = () => {
  selectExecutingModal.value = false;
};
</script>
