<template>
    <div class="flex px-6 py-4 rounded-xl border border-gray-300 bg-white text-xs">
      <div class="lg:w-1/12 min-w-1/12 my-auto">
        <input name="" type="checkbox" class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0"
          :checked="props.selectedAll" @change="handleCheckboxChange" />
      </div>
      <div class="text-left w-2/12 flex justify-center my-auto">
        <span class="font-bold text-primary border-b border-dashed border-primary cursor-pointer" @click="() => router.visit(route('6dem.documents.invoice.preview', props.invoices.id))">
          F-{{ props.invoices.number }}
        </span>
      </div>

      <div class="text-left w-2/12 flex justify-center my-auto">{{ formatDate(props.invoices.created_at) }}</div>
      <div class="text-left w-2/12 flex justify-center my-auto">{{ getAdvanceOrBalanceNameFromKey(props.invoices.type) }}</div>
      <div v-if="props.invoices.status == 'A payer'" class="text-left w-2/12 flex justify-center my-auto">
        <p class="text-left rounded-full bg-yellow-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.invoices.status }}</p>
      </div>
      <div v-if="props.invoices.status == 'Retard'" class="text-left w-2/12 flex justify-center my-auto">
        <p class="text-left rounded-full bg-fuchsia-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.invoices.status }}</p>
      </div>
      <div v-if="props.invoices.status == 'Partiellement payé'" class="text-left flex justify-center w-2/12 my-auto">
        <p class="text-left rounded-full bg-yellow-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.invoices.status }}</p>
      </div>
      <div v-if="props.invoices.status == 'Payé'" class="text-left w-2/12 flex justify-center my-auto">
        <p class="text-left rounded-full bg-primary text-white w-fit px-1.5 py-1 my-auto">{{ props.invoices.status }}</p>
      </div>
      <div v-if="props.invoices.status == 'Annulé'" class="text-left w-2/12 flex justify-center my-auto">
        <p class="text-left rounded-full bg-red-400 text-white w-fit px-1.5 py-1 my-auto">{{ props.invoices.status }}</p>
      </div>
      <div class="text-left w-2/12 flex justify-center my-auto font-bold">{{ props.invoices.amount_ht }}€</div>
      <div class="text-left w-2/12 flex justify-center my-auto font-bold">{{ props.invoices.amount_ttc }}€</div>
      <div class="text-left w-2/12 flex justify-center my-auto font-bold">{{ props.invoices.amount_tva }}€</div>
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
          </Dropdown>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { Dropdown } from "floating-vue";
  import InvoiceActionsPopperContent from "@/Components/Molecules/InvoiceActionsPopperContent.vue";
  import { getAdvanceOrBalanceNameFromKey } from "@/utils";
  import { router } from "@inertiajs/vue3";
  import { formatDate } from "@/utils/index";

  const emit = defineEmits(["toggle-selected-all"]);
  const props = defineProps({
    selectedAll: Boolean,
    invoices: {
      required: true,
    },
    toggleDocumentSelection: Function,
  });

  const handleCheckboxChange = () => {
    props.toggleDocumentSelection(props.invoices);
    emit("toggle-selected-all");
  };
  </script>
