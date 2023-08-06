<template>
    <div class="flex px-6 py-4 rounded-xl border border-gray-300 bg-white">
      <div class="w-1/12 my-auto">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6 cursor-pointer"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
          />
        </svg>
      </div>
      <div class="text-left w-3/12 my-auto">{{ document.number }}</div>
      <div class="text-left w-3/12 my-auto">{{ document.moving_job.loading_date }}</div>
      <div class="text-left w-2/12 my-auto">{{ document.status }}</div>
      <div class="text-left w-2/12 my-auto">{{ document.amount_ht }}</div>
      <div class="text-left w-2/12 my-auto"></div>
      <div class="w-1/12 my-auto">
        <div class="flex justify-end gap-4">
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
              <InvoiceActionsPopperContent :moving_job_id="document.moving_job.id" :client_id="document.moving_job.client.id"  :id="document.id" />
            </template>
          </Dropdown>
        </div>
      </div>
    </div>
  </template>
    
    <script setup>
  import { Dropdown } from "floating-vue";
  import InvoiceActionsPopperContent from "@/Components/Molecules/InvoiceActionsPopperContent.vue";
  defineProps({
    document: {
      required: true,
    },
  });
  </script>
    