<template>
  <div class="px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-10 pb-5 mt-24">
      <div class="text-center text-4xl font-bold pb-2">
        <h1>Informations pré-remplies</h1>
      </div>
      <DocumentLabel name="Informations de la société de déménagement" color="#438A7A" />
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput :value="'Facture N° ' + currentInvoice.number" placeholder="N° de la lettre de voiture"
            :font-bold="true" disabled />
        </DocumentFieldFrame>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.siren" placeholder="SIREN" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.ape_code" placeholder="Code APE" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.licence_number" placeholder="Licence N°" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.phone_number" placeholder="Téléphone" />
          </DocumentFieldFrame>
        </div>
        <div class="col-span-2">
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Email" :value="currentOrganisation.email" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="pb-8">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse de la société"
            :value="currentOrganisation.billing_address.full_address" />
        </DocumentFieldFrame>
      </div>
      <DocumentLabel name="Informations du client" color="#438A7A" />
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Prénom" :value="currentClient.first_name" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Nom" :value="currentClient.last_name" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Téléphone" :value="currentClient.phone_number" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div v-if="currentClient.type == 'professional'">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Nom complet de l'entreprise"
            :value="currentClient.client_organization?.name" />
        </DocumentFieldFrame>
      </div>
      <div class="pb-8">
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse du client" :value="currentClient.address.full_address" />
        </DocumentFieldFrame>
      </div>
      <DocumentLabel name="Chargement et Livraison" color="#438A7A" />
      <div class="grid grid-cols-2 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput v-model="movingjob.loading_date" placeholder="Date de chargement"
              :value="currentMovingJob.loading_date" :fontBold="true" @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date"
              :value="currentMovingJob.shipping_date" :fontBold="true" @savingValue="saveField('shipping_date')" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-6 pb-8 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" name="loading_address" :value="currentMovingJob.loading_address"
              placeholder="Adresse de chargement" @place_changed="setLoadingAddressData" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" :value="currentMovingJob.shipping_address" name="shipping_address"
              placeholder="Adresse de livraison" @place_changed="setShippingAddressData" />
          </DocumentFieldFrame>
        </div>
      </div>
      <DocumentLabel name="Désignation" color="#438A7A" />
      <div v-if="currentClient.type == 'individual'">
        <DocumentSelectInput v-model="movingjob.formula" :value="movingjob.formula" @change="saveFormula" :options="formulaOptions" default-text="Formule de déménagament"/>
      </div>
      <div class="flex flex-col space-y-2 pb-8">
        <DynamicFields :movingjob="currentMovingJob.id" />
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-10 pb-8 mt-16">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations à remplir</h1>
      </div>
      <DocumentLabel name="Facture" color="#438A7A" />
      <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
        <div>
          <DocumentSelectInput v-model="invoice.type" :value="invoice.type" @change="saveInvoiceType" :options="invoiceTypeOptions" default-text="Type de facture"/>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentMovingJob.capacity + ' m³'" placeholder="Volume(en m³)"
              v-model="movingjob.capacity" :fontBold="true" @savingValue="saveField('capacity')" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Distance" />
          </DocumentFieldFrame>
        </div>
      </div>
      <DocumentLabel name="Prix total" color="#438A7A" />
      <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput v-model="invoice.amount_ht" :value="invoice.amount_ht + ' €'"
              placeholder="Montant HT" :fontBold="true" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Montant TTC" :value="total_ttc + ' €'" :fontBold="true"/>
          </DocumentFieldFrame>
        </div>
      </div>
    </div>
    <div class="flex flex-row w-1/6 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewInvoice" buttontext="Générer le document" />
    </div>
  </div>
</template>
  
<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentFieldInputAddress from "@/Components/Atoms/DocumentFieldInputAddress.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import SelectInvoiceType from "@/Components/Atoms/SelectInvoiceType.vue";
import 'vue-select/dist/vue-select.css';
import { reactive, ref, onMounted, computed, watch } from "vue";


const user = usePage().props.auth.user;
const currentSettings = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentInvoice = usePage().props.invoice;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const movingJobFormulas = usePage().props.movingJobFormulas;
const vat = (currentSettings.vat/100) + 1

const formulaOptions = movingJobFormulas.map(item => ({
  name: item.name,
  value: item.slug
}));

const invoiceTypeOptions = [
    {
      name :"Acompte",
      value : "acompte"
    },
    {
      name : "Solde",
      value : "solde"
    }
  ];

const movingjob = useForm({
  capacity: currentMovingJob.capacity,
  formula: currentMovingJob.formula,
  loading_address: currentMovingJob.loading_address,
  loading_date: currentMovingJob.loading_date,
  loading_floor: currentMovingJob.loading_floor,
  loading_elevator: currentMovingJob.loading_elevator,
  loading_portaging: currentMovingJob.loading_portaging,
  loading_details: currentMovingJob.loading_details,
  shipping_address: currentMovingJob.shipping_address,
  shipping_date: currentMovingJob.shipping_date,
  shipping_floor: currentMovingJob.shipping_floor,
  shipping_elevator: currentMovingJob.shipping_elevator,
  shipping_portaging: currentMovingJob.shipping_portaging,
  shipping_details: currentMovingJob.shipping_details,
  discount_percentage: currentMovingJob.discount_percentage,
  discount_amount_ht: currentMovingJob.discount_amount_ht,
  advance: currentMovingJob.advance,
  balance: currentMovingJob.balance
});

const invoice = useForm({
  type: currentInvoice.type ? currentInvoice.type : "",
  amount_ht: currentInvoice.amount_ht ? parseFloat( currentInvoice.amount_ht).toFixed(2) : 0.00
});

const total_ttc = invoice.amount_ht ? ref(parseFloat(invoice.amount_ht * vat).toFixed(2)) : ref(0.00);

const watchOptions = watch(
  () => usePage().props.options,
  (newOptions) => {
    invoice.amount_ht = newOptions.reduce((sum, item) => sum + parseFloat(item.unit_price_ht) * parseFloat(item.quantity), 0.00).toFixed(2);
    movingjob.discount_amount_ht = invoice.amount_ht;
    total_ttc.value = parseFloat(invoice.amount_ht * vat).toFixed(2);
    console.log(movingjob.discount_amount_ht);
    saveAmount();
  },
  { deep: true }
);

const saveField = (field) => {
  movingjob.put(route("6dem.invoice.update", { id: currentInvoice.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
  watchOptions();
};

const saveAmount = () => {
  invoice.put(route("6dem.invoice.update", { id: currentInvoice.id, field: 'amount_ht' }), {
    preserveScroll: true,
    preserveState: true,
    onError: (errors) => console.log(errors)
  });
  saveField('discount_amount_ht');
};

const saveInvoiceType = () => {
  invoice.put(route("6dem.invoice.update", { id: currentInvoice.id, field: 'type' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const saveFormula = () => {
  movingjob.put(route("6dem.invoice.update", { id: currentInvoice.id, field: 'formula' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const setLoadingAddressData = (location) => {
  movingjob.loading_address = location.fullAddress;
  saveField('loading_address');
};

const setShippingAddressData = (location) => {
  movingjob.shipping_address = location.fullAddress;
  saveField('shipping_address');
};

const previewInvoice = () => {
  router.visit(route("6dem.documents.invoice.preview", currentInvoice.id), {
    method: "get",
  });
};
</script>