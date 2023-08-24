<template>
    <Head title="Fiche client" />
    <DemLayout>
      <Tabs :routePath="route('6dem.clients.details', currentClient.id)">
        <Tab title="Informations client">
            <div class="mt-5 py-5">
                <ClientInformations />
            </div>
        </Tab>
        <Tab title="Devis">
            <ClientQuotations v-if="$page.props.quotations.length" />
            <ListEmptyMessage
                v-if="!$page.props.quotations.length"
                message-title="Pas de devis enregistré"
                message-content="Pas de devis enregistré pour ce client"
                >
                <IconButton @click="initQuatation" class="mt-6" text="Céer un devis" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </IconButton>
            </ListEmptyMessage>
        </Tab>
        <Tab title="Paiements">
            <ListEmptyMessage
                v-if="!$page.props.payments.length"
                message-title="Pas de paiements effectués"
                message-content="Pas de paiements effectués pour ce client"
                >
            </ListEmptyMessage>
        </Tab>
        <Tab title="Factures">
            <ListEmptyMessage
                v-if="!$page.props.invoices.length"
                message-title="Pas de factures enregistré"
                message-content="Pas de factures enregistré pour ce client"
                >
            </ListEmptyMessage>
        </Tab>
        <Tab title="Lettres de voiture">
            <ListEmptyMessage
                v-if="!$page.props.waybills.length"
                message-title="Pas de lettres de voiture enregistré"
                message-content="Pas de Lettres de voiture enregistré pour ce client"
                >
            </ListEmptyMessage> 
        </Tab>
      </Tabs>
    </DemLayout>
  </template>
  
  <script setup>
  import DemLayout from "@/Layouts/DemLayout.vue";
  import { Head, router, usePage } from "@inertiajs/vue3";
  import Tabs from "@/Components/Molecules/Tabs.vue";
  import Tab from "@/Components/Atoms/Tab.vue"; 
  import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
  import ClientInformations from "@/Components/ClientDetails/ClientInformations.vue";
  import ClientQuotations from "@/Components/ClientDetails/ClientQuotations.vue";
  import IconButton from "@/Components/Atoms/IconButton.vue";

  const currentClient = usePage().props.client


  const initQuatation = () => {
    router.visit(
      route("6dem.documents.quotation.init", currentClient.id),
      {
        method: "post",
      }
    );
  };
  </script>
  