<template>
    <Head title="Details Facture" />
    <DemLayout>
      <div class="flex flex-col space-y-2 mb-4 text-sm text-gray-600">
        <div class="relative z-20 flex h-navbar shrink-0 bg-secondary shadow">
          <span class="h-navbar border-r border-neutral-200 lg:block" />
          <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
            <div class="w-full flex justify-between">
              <div class="mx-8 max-w-xs py-5 lg:block">
                <h1 class="text-primary truncate font-semibold">
                  Facture N° {{ invoice.number }}
                </h1>
              </div>
              <span class="h-navbar border-l border-neutral-200 hidden xl:block">
              </span>
  
              <div class="mx-5 hidden xl:flex items-center">
                <SecondaryButton> Modifier </SecondaryButton>
              </div>
  
              <div class="mx-5 hidden xl:flex items-center">
                <SecondaryButton> Créer une facture </SecondaryButton>
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
                    <InvoiceActionsPopperContent :id="invoice.id" />
                  </template>
                </Dropdown>
              </div>
            </div>
          </div>
        </div>
        <InvoiceDocument :document="invoice" />
      </div>
    </DemLayout>
  </template>
        
<script setup>
  import DemLayout from "@/Layouts/DemLayout.vue";
  import { Dropdown } from "floating-vue";
  import InvoiceActionsPopperContent from "@/Components/Molecules/InvoiceActionsPopperContent.vue";
  import InvoiceDocument from "@/Components/Organisms/InvoiceDocument.vue";
  import SecondaryButton from "@/Components/SecondaryButton.vue";
  import { Head, usePage } from "@inertiajs/vue3";
  
  const invoice = usePage().props.invoice;
</script>