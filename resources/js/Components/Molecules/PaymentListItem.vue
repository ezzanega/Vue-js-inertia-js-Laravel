<template>
    <div class="flex px-6 py-4 rounded-xl border border-gray-300 bg-white">
        <div class="lg:w-1/12 min-w-1/12 my-auto">
            <input
            name=""
            type="checkbox"
            class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0"
            :checked="props.selectedAll"
            @change="handleCheckboxChange"
          />
        </div>
        <div class="flex gap-3 text-left justify-center w-2/12 my-auto">
          <div class="text-sm">
            <div class="font-medium text-gray-700">
             {{props.payments.reference}}
            </div>
          </div>
        </div>
        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="text-sm">
                <div class="font-medium text-gray-700">
                    {{props.payments.type}}
                </div>
            </div>
        </div>
        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="flex gap-2 justify-center">
              <span
                class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">

              {{props.payments.payment_channel}}
              </span>
            </div>
          </div>
        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="text-sm">
                <div class="font-medium text-gray-700">
                    {{props.payments.amount}}
                </div>
            </div>
        </div>
        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="text-sm">
                <div class="font-medium text-gray-700">
                    {{props.payments.moving_job.loading_date}}
                </div>
            </div>
        </div>
        <div class="lg:w-1/12 min-w-1/12 my-auto">
            <div class="flex flex-nowrap justify-end gap-4">
              <Dropdown placement="bottom-end">
                <svg
                  class="h-6 w-6 cursor-pointer"
                  viewBox="0 0 28 7"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M13.9449 6.06482C15.6474 6.06482 17.0276 4.70716 17.0276 3.03241C17.0276 1.35766 15.6474 0 13.9449 0C12.2424 0 10.8623 1.35766 10.8623 3.03241C10.8623 4.70716 12.2424 6.06482 13.9449 6.06482Z"
                    fill="currentColor"
                  />
                  <path
                    d="M24.8082 6.06482C26.5107 6.06482 27.8909 4.70716 27.8909 3.03241C27.8909 1.35766 26.5107 0 24.8082 0C23.1057 0 21.7256 1.35766 21.7256 3.03241C21.7256 4.70716 23.1057 6.06482 24.8082 6.06482Z"
                    fill="currentColor"
                  />
                  <path
                    d="M3.08263 6.06482C4.78513 6.06482 6.16527 4.70716 6.16527 3.03241C6.16527 1.35766 4.78513 0 3.08263 0C1.38014 0 0 1.35766 0 3.03241C0 4.70716 1.38014 6.06482 3.08263 6.06482Z"
                    fill="currentColor"
                  />
                </svg>
                <template #popper>
                  <!-- <QuotationActionsPopperContent
                    :movingjob="props.document.moving_job"
                    :client="props.document.moving_job.client"
                    :quotation="document"
                    :deletequotation="deletequotation"
                    :opendelModal="opendelModal"
                    :openDupQuotModal="openDupQuotModal"
                    :openPayQuotModal="openPayQuotModal"
                  /> -->
                </template>
              </Dropdown>
            </div>
        </div>

    </div>

  </template>

    <script setup>
  import { Dropdown } from "floating-vue";
  import QuotationActionsPopperContent from "@/Components/Molecules/QuotationActionsPopperContent.vue";
  import { router } from "@inertiajs/vue3";
  const emit = defineEmits(["toggle-selected-all"]);
  const props = defineProps({
    selectedAll: Boolean,
    payments: {
      required: true,
    },
    togglePaymentSelection: Function,
  });

//   console.log(props.payments);

  const handleCheckboxChange = () => {
//    alert('hello')
    props.togglePaymentSelection(props.payments);
    emit("toggle-selected-all");
  };

  </script>
