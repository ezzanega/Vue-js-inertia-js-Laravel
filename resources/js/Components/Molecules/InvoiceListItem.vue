<template>
  <div class="flex px-6 py-4 rounded-xl border border-gray-300 bg-white text-xs">
    <div class="lg:w-1/12 min-w-1/12 my-auto">
      <input name="" type="checkbox" class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0"
        :checked="props.selectedAll" @change="handleCheckboxChange" />
    </div>
    <div class="text-left w-2/12 flex justify-center my-auto">
      <span class="font-bold text-primary border-b border-dashed border-primary cursor-pointer" @click="() => router.visit(route('6dem.documents.invoice.preview', props.document.id))">
        F-{{ props.document.number }}
      </span>
    </div>
    <div class="text-center w-2/12">
      <div class="font-medium text-gray-700">
        {{
          props.document.moving_job?.client?.type == "professional"
          ? props.document.moving_job?.client.client_organization.name
          : props.document.moving_job?.client.first_name +
          " " +
          props.document.moving_job?.client.last_name
        }}
      </div>
      <!-- <div class="text-gray-400">{{ props.document.moving_job?.client.email }}</div> -->
      <div class="text-gray-400">Tél: {{ props.document.moving_job?.client.phone_number }}</div>
    </div>
    <div class="text-left w-2/12 flex justify-center my-auto">{{ formatDate(props.document.date) }}</div>
    <div class="text-left w-2/12 flex justify-center my-auto">{{ getAdvanceOrBalanceNameFromKey(props.document.type) }}</div>
    <div v-if="props.document.status == 'A payer'" class="text-left w-2/12 flex justify-center my-auto">
      <p class="text-left rounded-full bg-yellow-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.document.status }}</p>
    </div>
    <div v-if="props.document.status == 'Retard'" class="text-left w-2/12 flex justify-center my-auto">
      <p class="text-left rounded-full bg-fuchsia-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.document.status }}</p>
    </div>
    <div v-if="props.document.status == 'Partiellement payé'" class="text-left flex justify-center w-2/12 my-auto">
      <p class="text-left rounded-full bg-yellow-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.document.status }}</p>
    </div>
    <div v-if="props.document.status == 'Payé'" class="text-left w-2/12 flex justify-center my-auto">
      <p class="text-left rounded-full bg-primary text-white w-fit px-1.5 py-1 my-auto">{{ props.document.status }}</p>
    </div>
    <div v-if="props.document.status == 'Annulé'" class="text-left w-2/12 flex justify-center my-auto">
      <p class="text-left rounded-full bg-red-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.document.status }}</p>
    </div>
    <div class="text-left w-2/12 flex justify-center my-auto font-bold">{{ props.document.amount_ht }}€</div>
    <div class="text-left w-2/12 flex justify-center my-auto font-bold">{{ props.document.amount_ttc }}€</div>
    <div class="w-1/12 my-auto">
      <div class="flex justify-end gap-4">
        <Dropdown placement="bottom-end">
          <svg class="h-6 w-6 cursor-pointer" viewBox="0 0 28 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M13.9449 6.06482C15.6474 6.06482 17.0276 4.70716 17.0276 3.03241C17.0276 1.35766 15.6474 0 13.9449 0C12.2424 0 10.8623 1.35766 10.8623 3.03241C10.8623 4.70716 12.2424 6.06482 13.9449 6.06482Z"
              fill="currentColor" />
            <path
              d="M24.8082 6.06482C26.5107 6.06482 27.8909 4.70716 27.8909 3.03241C27.8909 1.35766 26.5107 0 24.8082 0C23.1057 0 21.7256 1.35766 21.7256 3.03241C21.7256 4.70716 23.1057 6.06482 24.8082 6.06482Z"
              fill="currentColor" />
            <path
              d="M3.08263 6.06482C4.78513 6.06482 6.16527 4.70716 6.16527 3.03241C6.16527 1.35766 4.78513 0 3.08263 0C1.38014 0 0 1.35766 0 3.03241C0 4.70716 1.38014 6.06482 3.08263 6.06482Z"
              fill="currentColor" />
          </svg>
          <template #popper>
            <InvoiceActionsPopperContent :moving_job_id="props.document.moving_job?.id"
              :client_id="props.document.moving_job?.client.id" :id="props.document.id"
              :deleteFacture="deleteFacture" :document="document" :opendelModal="opendelModal" :openUpdateModal="openUpdateModal" @clicked="optionClicked" />
          </template>
        </Dropdown>
      </div>
    </div>
  </div>
  <ChangeInvoiceStatus :invoice="document" :openModal="changeStatusModal" @closeModal="closeChangeStatusModal" :searchingInvoice="props.searchingInvoice" :searchInvoice="props.searchInvoice" />

  <UpdateInvoiceForm v-if="UpdateInvModal && selectedinvoice"
   :invoice="selectedinvoice" :openModal="UpdateInvModal" @closeModal="closeUpdateModal" />

</template>

<script setup>
import { Dropdown } from "floating-vue";
import InvoiceActionsPopperContent from "@/Components/Molecules/InvoiceActionsPopperContent.vue";
import ChangeInvoiceStatus from "@/Components/Molecules/ChangeInvoiceStatus.vue";
import UpdateInvoiceForm from "@/Components/Organisms/UpdateInvoiceForm.vue";
import { getAdvanceOrBalanceNameFromKey } from "@/utils";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import { formatDate } from "@/utils/index";

const emit = defineEmits(["toggle-selected-all"]);
const props = defineProps({
  selectedAll: Boolean,
  document: {
    required: true,
  },
  toggleDocumentSelection: Function,
  deleteFacture:Function,
  opendelModal:Function,
  searchingInvoice:Boolean,
  searchInvoice:Function,
});

const changeStatusModal = ref(false);


const optionClicked = (element) => {
  switch (element) {
    case 'update-status':
      changeStatusModal.value = true;
      break;
    default:
      console.log(element)
  }
}
const selectedinvoice = ref(null);
const UpdateInvModal = ref(false);

const openUpdateModal = (invoice) => {
    UpdateInvModal.value = true;
    selectedinvoice.value= invoice;
};

const closeChangeStatusModal = () => {
  changeStatusModal.value = false;
};
const closeUpdateModal = () => {
    UpdateInvModal.value = false;
};

const handleCheckboxChange = () => {
  props.toggleDocumentSelection(props.document);
  emit("toggle-selected-all");
};
</script>
