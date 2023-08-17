<template>
  <div class="2xl:px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-24">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations pré-remplies</h1>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="'LETTRE DE VOITURE N° ' + currentWaybill.number"
              placeholder="N° de la lettre de voiture" :font-bold="true" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.phone_number" placeholder="Téléphone" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Adresse mail" :value="currentOrganisation.email" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.siren" placeholder="SIREN" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.code_ape" placeholder="Code APE" />
          </DocumentFieldFrame>
        </div>
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="currentOrganisation.licence_number" placeholder="Licence N°" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div>
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
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-16">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations à remplir</h1>
      </div>
      <DocumentLabel name="Lettre de voiture" color="#438A7A" />
      <DocumentSelectExecutingInput v-model="newWaybill.executing_company_id" :value="newWaybill.executing_company_id" @change="saveExecutingCompany" :options="executingCompanies" default-text="Société exécutante"/>
      <div v-if="currentClient.type == 'individual'">
        <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Distance" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput :value="currentMovingJob.capacity" v-model="movingjob.capacity" @savingValue="saveField('capacity')" placeholder="Volume(en m³)" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentSelectInput v-model="movingjob.formula" :value="movingjob.formula" @change="saveFormula" :options="formulaOptions" default-text="Formule de déménagament"/>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Distance" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput :value="currentMovingJob.capacity" placeholder="Volume(en m³)" :fontBold="true" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Chargement" color="#438A7A" />
          <ToggleButton v-model:checked="sameAddressAsClient" label="Adresse de chargement identique à l'adresse du client ?" />
          <DocumentFieldFrame>
            <DocumentFieldInputAddress name="loading_address" :value="movingjob.loading_address"
              placeholder="Adresse de chargement" @place_changed="setLoadingAddressData" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput v-model="movingjob.loading_date" placeholder="Date de chargement"
              :value="currentMovingJob.loading_date" :fontBold="true" @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_floor" placeholder="Étage"
                :value="currentMovingJob.loading_floor" :fontBold="true" @savingValue="saveField('loading_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_elevator" placeholder="Ascenceur"
                :value="currentMovingJob.loading_elevator" :fontBold="true"
                @savingValue="saveField('loading_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_portaging" placeholder="Portage"
                :value="currentMovingJob.loading_portaging" :fontBold="true"
                @savingValue="saveField('loading_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput v-model="movingjob.loading_details" placeholder="Détails"
                :value="currentMovingJob.loading_details" :fontBold="true"
                @savingValue="saveField('loading_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'loading'" />
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Livraison" color="#438A7A" />
          <div class="pt-6"></div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :required="true" :value="currentMovingJob.shipping_address" name="shipping_address"
              placeholder="Adresse de livraison" @place_changed="setShippingAddressData" />
          </DocumentFieldFrame>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date"
              :value="currentMovingJob.shipping_date" :fontBold="true" @savingValue="saveField('shipping_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.shipping_floor"
                :value="currentMovingJob.shipping_floor" :fontBold="true"
                @savingValue="saveField('shipping_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.shipping_elevator"
                :value="currentMovingJob.shipping_elevator" :fontBold="true"
                @savingValue="saveField('shipping_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.shipping_portaging"
                :value="currentMovingJob.shipping_portaging" :fontBold="true"
                @savingValue="saveField('shipping_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.shipping_details"
                :value="currentMovingJob.shipping_details" :fontBold="true"
                @savingValue="saveField('shipping_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'shipping'" />
        </div>
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-8">
      <div class="flex flex-col mt-4 space-y-5">
        <DocumentLabel name="Options" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields />
      </div>
    </div>
    <div class="flex flex-col px-8 pb-10 mt-10">
      <div class="flex flex-col space-y-5 px-16">
        <DocumentLabel name="Finalisation de la lettre de voiture" color="#438A7A" />
        <div class="grid grid-cols-4 gap-6 justify-between">
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput :value="'Tarification'" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput :value="'Modalités de règlement'" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame :className="'h-full'">
              <DocumentFieldInput :className="'h-full'" placeholder="Remise en %" v-model="movingjob.discount_percentage"
                :value="currentMovingJob.discount_percentage" :fontBold="true"
                @savingValue="saveField('discount_percentage')" />
            </DocumentFieldFrame>
          </div>
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Acompte en %" v-model="movingjob.advance"
                :value="currentMovingJob.advance" :fontBold="true" @savingValue="saveField('advance')" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant HT" v-model="movingjob.discount_amount_ht" :value="movingjob.discount_amount_ht + ' €'"/>
            </DocumentFieldFrame>
          </div>
          <div class="space-y-5">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Solde en %" v-model="movingjob.balance"
                :value="currentMovingJob.balance" :fontBold="true" @savingValue="saveField('balance')" />
            </DocumentFieldFrame>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Montant TTC" :value="total_ttc + ' €'" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-row w-1/6 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewWaybill" buttontext="Générer le document" />
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
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import ToggleButton from "@/Components/Atoms/ToggleButton.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import DocumentSelectExecutingInput from "@/Components/Atoms/DocumentSelectExecutingInput.vue";
import 'vue-select/dist/vue-select.css';
import { reactive, ref, watch, computed } from "vue";


const user = usePage().props.auth.user;
const currentSettings = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentWaybill = usePage().props.waybill;
const currentMovingJob = usePage().props.movingjob;
const currentClient = usePage().props.client;
const movingJobFormulas = usePage().props.movingJobFormulas;
const executingCompanies = usePage().props.executingCompanies;
const vat = (currentSettings.vat/100) + 1

const formulaOptions = movingJobFormulas.map(item => ({
  name: item.name,
  value: item.slug
}));

const organization = reactive({
  name: "",
  siret: "",
  siren: "",
  ape_code: "",
  address: "",
  billing_address: "",
  phone_number: "",
  email: "",
});

const movingjob = useForm({
  capacity: currentMovingJob.capacity ? currentMovingJob.capacity : "",
  formula: currentMovingJob.formula ? currentMovingJob.formula : "",
  loading_address: currentMovingJob.loading_address ? currentMovingJob.loading_address : "",
  loading_date: currentMovingJob.loading_date ? currentMovingJob.loading_date : "",
  loading_floor: currentMovingJob.loading_floor ? currentMovingJob.loading_floor : "",
  loading_elevator: currentMovingJob.loading_elevator ? currentMovingJob.loading_elevator : "",
  loading_portaging: currentMovingJob.loading_portaging ? currentMovingJob.loading_portaging : "",
  loading_details: currentMovingJob.loading_details ? currentMovingJob.loading_details : "",
  shipping_address: currentMovingJob.shipping_address ? currentMovingJob.shipping_address : "",
  shipping_date: currentMovingJob.shipping_date ? currentMovingJob.shipping_date : "",
  shipping_floor: currentMovingJob.shipping_floor ? currentMovingJob.shipping_floor : "",
  shipping_elevator: currentMovingJob.shipping_elevator ? currentMovingJob.shipping_elevator : "",
  shipping_portaging: currentMovingJob.shipping_portaging ? currentMovingJob.shipping_portaging : "",
  shipping_details: currentMovingJob.shipping_details ? currentMovingJob.shipping_details : "",
  discount_percentage: currentMovingJob.discount_percentage ? currentMovingJob.discount_percentage : "",
  discount_amount_ht: currentMovingJob.discount_amount_ht ? currentMovingJob.discount_amount_ht : 0.00,
  advance: currentMovingJob.advance ? currentMovingJob.advance : "",
  balance: currentMovingJob.balance ? currentMovingJob.balance : "",
  distance: currentMovingJob.distance ? currentMovingJob.distance : ""
});

const total_ttc = movingjob.discount_amount_ht ? ref(parseFloat(movingjob.discount_amount_ht * vat).toFixed(2)) : ref(0.00);

const newWaybill = useForm({
  executing_company_id: currentWaybill.executing_company ? currentWaybill.executing_company.id : ""
});

const sameAddressAsClient = ref( movingjob.loading_address == currentClient.address.full_address);

const form = reactive({
  clientType: "individual",
  firstName: "",
  lastName: "",
  phoneNumber: "",
  email: "",
  address: "",
  source: "",
  clientOrganizationName: "",
  siret: "",
  siren: "",
});

const watchOptions = watch(
  () => usePage().props.options,
  (newOptions) => {
    movingjob.discount_amount_ht = newOptions.reduce((sum, item) => sum + parseFloat(item.unit_price_ht) * parseFloat(item.quantity), 0.00).toFixed(2);
    total_ttc.value = parseFloat(movingjob.discount_amount_ht * vat).toFixed(2);
    saveField('discount_amount_ht');
  },
  { deep: true }
);

const saveField = (field) => {
  console.log(movingjob[field]);
  movingjob.put(route("6dem.waybill.update", { id: currentWaybill.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
  });
  watchOptions();
};

const saveFormula = () => {
  movingjob.put(route("6dem.waybill.update", { id: currentWaybill.id, field: 'formula' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const saveExecutingCompany = () => {
  console.log(newWaybill.executing_company_id);
  newWaybill.put(route("6dem.waybill.update", { id: currentWaybill.id, field: 'executing_company_id' }), {
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

const previewWaybill = () => {
  router.visit(route("6dem.documents.waybill.preview", currentWaybill.id), {
    method: "get",
  });
};

watch(sameAddressAsClient, (value) => {
  if (value) {
    movingjob.loading_address = currentClient.address.full_address;
    saveField('loading_address');
  } else {
    movingjob.loading_address = "";
    saveField('loading_address');
  }
});
</script>