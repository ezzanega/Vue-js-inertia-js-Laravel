<template>
    <Head title="Fiche client" />
    <DemLayout>
      <Tabs>
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
  import { Head } from "@inertiajs/vue3";
  import Tabs from "@/Components/Molecules/Tabs.vue";
  import Tab from "@/Components/Atoms/Tab.vue"; 
  import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
  import ClientInformations from "@/Components/ClientDetails/ClientInformations.vue";
  import ClientQuotations from "@/Components/ClientDetails/ClientQuotations.vue";
  </script>
  