<template>
  <div class="w-auto">
    <div class="space-y-0.5">
      <PopperItem item="Previsualiser" @clicked="previewInvoice">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </PopperItem>
      <PopperItem item="Modifier" @clicked="updateInvoice">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
      </PopperItem>
      <PopperItem item="Envoyer au client" @clicked="PopperItemClicked">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
        </svg>
      </PopperItem>
      <PopperItem item="Supprimer la facture" @clicked="opendelModal(document.id,'facture')">
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
const props = defineProps({
  id: {
    required: true,
  },
  moving_job_id: {
    required: true,
  },
  client_id: {
    required: true,
  },
    //Props pour la suppression de Facture
    document: {
    type: Object,
    required: true,
  },
  deleteFacture:Function,
  opendelModal:Function,
});
const PopperItemClicked = () => { };
const previewInvoice = () => {
  router.visit(route("6dem.documents.invoice.preview", props.id), {
    method: "get",
    replace: true
  });
};
const updateInvoice = () => {
  router.visit(route("6dem.documents.invoice", [props.moving_job_id, props.client_id, props.id]), {
    method: "get",
    replace: true
  });
};
</script>
