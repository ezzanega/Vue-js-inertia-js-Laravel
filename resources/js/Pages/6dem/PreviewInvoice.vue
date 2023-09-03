<template>
  <Head title="Details Facture" />
  <DemLayout>
    <div class="flex flex-col space-y-2 mb-4 text-sm text-gray-600">
      <div class="relative z-20 flex h-navbar shrink-0 bg-white rounded-md shadow border border-gray-300">
        <span class="h-navbar border-r border-neutral-200 lg:block" />
        <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
          <div class="w-full flex justify-between">
            <div class="mx-8 max-w-xs py-5 lg:block">
              <h1 class="truncate font-semibold">
                Facture N° {{ invoice.number }}
              </h1>
            </div>
            <span class="h-navbar border-l border-neutral-200 hidden lg:block">
            </span>

            <div class="mx-5 hidden lg:flex items-center">
              <SecondaryButton @click="downloadInvoice">
                <div class="flex space-x-2 py-1.5 my-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                  </svg>
                  <span class="my-auto">
                    Télécharger
                  </span>
                </div>
              </SecondaryButton>
            </div>

            <div class="mx-5 hidden lg:flex items-center">
              <SecondaryButton @click="updateInvoice"> 
                <div class="flex space-x-2 py-1.5 my-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                  </svg>
                  <span class="my-auto">
                    Modifier
                  </span>
                </div>
              </SecondaryButton>
            </div>

            <div class="mx-5 hidden lg:flex items-center">
              <SecondaryButton>
                <div class="flex space-x-2 py-1.5 my-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                  </svg>
                  <span class="my-auto">
                    Envoyer au client
                  </span>
                </div>
              </SecondaryButton>
            </div>

            <div class="mx-1 flex items-center justify-end">
              <Menu placement="bottom-end">
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
                  <div class="w-auto">
                    <div class="space-y-0.5">
                      <PopperItem item="Télécharger" @clicked="downloadInvoice">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                      </PopperItem>
                      <PopperItem item="Modifier" @clicked="updateInvoice">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </PopperItem>
                      <PopperItem item="Envoyer au client" @clicked="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                      </PopperItem>
                    </div>
                  </div>
                </template>
              </Menu>
            </div>
          </div>
        </div>
      </div>

      <div v-if="loading" class="grid place-items-center"  style="height: 600px;">
        <svg class="w-12 h-12 text-primary animate-spin" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <circle class="opacity-5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" fill="currentColor"></path>
        </svg>
      </div>

      <iframe :src="`/6dem/documents/invoice/pdf/${invoice.id}`" @load="onIframeLoad" width="100%" height="600px"></iframe>
    </div>
  </DemLayout>
</template>
        
<script setup>
  import DemLayout from "@/Layouts/DemLayout.vue";
  import { Menu } from "floating-vue";
  import PopperItem from "@/Components/Atoms/PopperItem.vue";
  import SecondaryButton from "@/Components/SecondaryButton.vue";
  import { Head, usePage } from "@inertiajs/vue3";
  import { ref } from "vue";

  const invoice = usePage().props.invoice;
  const loading = ref(true)

  const downloadInvoice = () => {
    window.location.href = route("6dem.invoice.download", [invoice.id])
  };

  const onIframeLoad = () => {
    loading.value = false;
  }
  const updateInvoice = () => {};
</script>