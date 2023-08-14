<template>
  <Head title="Details devis" />
  <DemLayout>
    <div class="flex flex-col space-y-2 mb-4 text-sm text-gray-600">
      <div class="relative z-20 flex h-navbar shrink-0 bg-secondary shadow">
        <span class="h-navbar border-r border-neutral-200 lg:block" />
        <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
          <div class="w-full flex justify-between">
            <div class="mx-8 max-w-xs py-5 lg:block">
              <h1 class="text-primary truncate font-semibold">
                Devis N° {{ quotation.number }}
              </h1>
            </div>
            <span class="h-navbar border-l border-neutral-200 hidden xl:block">
            </span>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton @click="updateQuotation"> Modifier </SecondaryButton>
            </div>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton @click="download">Télécharger</SecondaryButton>
            </div>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton>Envoyer au client</SecondaryButton>
            </div>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton>Supprimer</SecondaryButton>
            </div>

            <div class="mx-1 flex items-center justify-end">
              <Dropdown placement="bottom-end">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-6 w-6 cursor-pointer"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                  />
                </svg>
                <template #popper>
                  <QuotationActionsPopperContent :id="quotation.id" />
                </template>
              </Dropdown>
            </div>
          </div>
        </div>
      </div>
      <iframe :src="`/6dem/documents/quotation/pdf/${quotation.id}`" width="100%" height="600px"></iframe>
    </div>
  </DemLayout>
</template>
      
  <script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import QuotationActionsPopperContent from "@/Components/Molecules/QuotationActionsPopperContent.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Dropdown } from "floating-vue";
import { Head, usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
const quotation = usePage().props.quotation;

const updateQuotation = () => {
  router.visit(route("6dem.documents.quotation", [quotation.moving_job.id, quotation.moving_job.client.id, quotation.id]), {
    method: "get",
  });
};
</script>