<template>
    <Head title="Details lettre de voiture" />
    <DemLayout>
      <div class="flex flex-col space-y-2 mb-4 text-sm text-gray-600">
        <div class="relative z-20 flex h-navbar shrink-0 bg-secondary shadow">
          <span class="h-navbar border-r border-neutral-200 lg:block" />
          <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
            <div class="w-full flex justify-between">
              <div class="mx-8 max-w-xs py-5 lg:block">
                <h1 class="text-primary truncate font-semibold">
                  Lettre de voiture N° {{ waybill.number }}
                </h1>
              </div>
              <span class="h-navbar border-l border-neutral-200 hidden xl:block">
              </span>
  
              <div class="mx-5 hidden xl:flex items-center">
                <SecondaryButton @click="updateWaybill"> Modifier </SecondaryButton>
              </div>
  
              <div class="mx-5 hidden xl:flex items-center">
                <SecondaryButton> Créer une lettre de voiture </SecondaryButton>
              </div>
  
              <div class="mx-5 hidden xl:flex items-center">
                <SecondaryButton>Télécharger</SecondaryButton>
              </div>
  
              <div class="mx-5 hidden xl:flex items-center">
                <SecondaryButton>Envoyer par mail</SecondaryButton>
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
                    <WaybillActionsPopperContent :id="waybill.id" />
                  </template>
                </Dropdown>
              </div>
            </div>
          </div>
        </div>
        <iframe :src="`/6dem/documents/waybill/pdf/${waybill.id}`" width="100%" height="600px"></iframe>
      </div>
    </DemLayout>
  </template>
        
    <script setup>
  import DemLayout from "@/Layouts/DemLayout.vue";
  import { Dropdown } from "floating-vue";
  import WaybillActionsPopperContent from "@/Components/Molecules/WaybillActionsPopperContent.vue";
  import SecondaryButton from "@/Components/SecondaryButton.vue";
  import { Head, usePage, router } from "@inertiajs/vue3";
  
  const waybill = usePage().props.waybill;


  const updateWaybill = () => {
  router.visit(route("6dem.documents.waybill", [waybill.moving_job.id, waybill.moving_job.client.id, waybill.id]), {
    method: "get",
  });
};
  </script>