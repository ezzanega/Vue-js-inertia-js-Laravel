<template>
  <div class="2xl:px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-24">
      <div class="text-center text-3xl font-bold pb-5">
        <h1>Informations de la société de déménagement</h1>
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

      <div class="text-center text-3xl font-bold py-5">
        <h1>Informations clients</h1>
      </div>

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
          <DocumentFieldInput placeholder="Nom complet du client/de l'entreprise"
            :value="currentClient.client_organization?.name" />
        </DocumentFieldFrame>
      </div>
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse du client" :value="currentClient.address.full_address" />
        </DocumentFieldFrame>
      </div>
    </div>
    <div class="flex flex-col space-y-5 px-8 mt-16">
      <div class="text-center text-3xl font-bold pb-5">
        <h1>Informations à remplir sur le déménagement</h1>
      </div>
      <DocumentLabel name="Lettre de voiture" color="#438A7A" />
      <DocumentSelectExecutingInput v-model="newWaybill.executing_company_id" :value="newWaybill.executing_company_id" @change="saveExecutingCompany" :options="executingCompanies" default-text="Société exécutante"/>
      <div v-if="currentClient.type == 'individual'">
        <div class="grid grid-cols-3 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput :value="movingjob.distance" v-model="movingjob.distance" placeholder="Distance" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput :value="currentMovingJob.capacity" placeholder="Volume(en m³)" :fontBold="true" />
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
        <DocumentLabel name="Prestations" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <HandleOptionsFields :movingjob="currentMovingJob.id" @options:updated="optionsUpdated" />
      </div>
    </div>


    <div class="flex flex-col space-y-2 px-8 pb-10 mt-10">
      <DocumentLabel name="Tarification" color="#438A7A" />
      <div class="flex flex-col space-y-2 ">
        <ToggleButton class="my-auto  w-1/2" v-model:checked="applyDiscount" name="apply-discount" label="Appliquer une remise" />
        <DefaultInput v-if="applyDiscount" class="my-auto w-1/2" type="number" @savingValue="updateDiscount" v-model="movingjob.discount" name="discount" placeholder="Remise (en %)" label="Remise (en %)"/>
      </div>
      <div class="grid grid-cols-3 gap-4 justify-between">
        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Total HT {{ applyDiscount ? '(-'+movingjob.discount+'%)' : '' }} :
            </span>
            <span class="w-1/2">
              {{  movingjob.amount_ht ? movingjob.amount_ht + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              TVA ({{ currentSettings.vat }}%) :
            </span>
            <span class="w-1/2">
              {{  movingjob.amount_tva ? movingjob.amount_tva + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="font-bold p-0.5 flex justify-start">
            <span class="w-1/2">
              Total TTC : 
            </span>
            <span class="w-1/2">
              {{  movingjob.amount_ttc ? movingjob.amount_ttc + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>
      </div>


      <div class="grid grid-cols-3 gap-4 justify-between">
        <DocumentSelectInput v-model="movingjob.payment_process" :value="movingjob.payment_process" @change="updatePaymentProcess" :options="processPaymentOptions" default-text="Modalités de règlement"/>
        
        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Accompte ({{ getAdvanceOrBalance(movingjob.payment_process, 'advance') ?? '-' }}%) :
            </span>
            <span class="w-1/2">
              {{  movingjob.advance ? movingjob.advance + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Solde ({{ getAdvanceOrBalance(movingjob.payment_process, 'balance') ?? '-' }}%) :
            </span>
            <span class="w-1/2">
              {{  movingjob.balance ? movingjob.balance + ' €' : '' }}
            </span>
          </div>
        </DocumentFieldFrame>
      </div>
    </div>
    <div class="flex flex-row w-1/3 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewWaybill" buttontext="Générer une lettre de voiture" />
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
import HandleOptionsFields from "@/Components/Organisms/HandleOptionsFields.vue";
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import ToggleButton from "@/Components/Atoms/ToggleButton.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import DocumentSelectExecutingInput from "@/Components/Atoms/DocumentSelectExecutingInput.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import 'vue-select/dist/vue-select.css';
import { reactive, ref, watch, computed } from "vue";
import { reformatLocation, paymentProcessOptions, calculateTotalHT, calculatePercentage, calculateTTC, getAdvanceOrBalance } from "@/utils";


const user = usePage().props.auth.user;
const currentSettings = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentWaybill = usePage().props.waybill;
const currentMovingJob = usePage().props.movingjob;
const currentClient = usePage().props.client;
const movingJobFormulas = usePage().props.movingJobFormulas;
const executingCompanies = usePage().props.executingCompanies;

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
  discount: currentMovingJob.discount ? currentMovingJob.discount : 0,
  amount_ht: currentMovingJob.amount_ht ? currentMovingJob.amount_ht : 0,
  amount_tva: currentMovingJob.amount_tva ? currentMovingJob.amount_tva : 0,
  amount_ttc: currentMovingJob.amount_ttc ? currentMovingJob.amount_ttc : 0,
  advance: currentMovingJob.advance ? currentMovingJob.advance : "",
  balance: currentMovingJob.balance ? currentMovingJob.balance : "",
  distance: currentMovingJob.distance ? currentMovingJob.distance : "",
  payment_process: currentMovingJob.payment_process ? currentMovingJob.payment_process : ""
});


const sameAddressAsClient = ref(movingjob.loading_address == currentClient.address.full_address);
const servicesOptions = ref(
  usePage().props.options.map(function(option){
    return { 
      id: option.id, 
      description: option.designation, 
      qty: option.quantity,
      priceHT: option.unit_price_ht, 
      totalPriceHT: option.unit_price_ht ? parseFloat(option.unit_price_ht*option.quantity).toFixed(2) : 0.00,
      selectedMeasurement: option.unit 
    }
  })
);

const applyDiscount = ref(currentMovingJob.discount ? true : false);
const processPaymentOptions = paymentProcessOptions();
const movingjobLocationUrl = ref({
  loading_google_map_url: currentMovingJob.loading_location ? currentMovingJob.loading_location?.google_map_url : "",
  shipping_google_map_url: currentMovingJob.shipping_location ? currentMovingJob.shipping_location?.google_map_url : "",
});
const currentFormula = ref(movingJobFormulas.find((obj) => {
  return obj.slug === currentMovingJob.formula;
}));

const client = reactive({
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

const shippingLocation = useForm({
  type: '',
  address: '',
  city: '',
  postalCode: '',
  country: '',
  fullAddress: '',
  lat: '',
  lng: '',
  googleMapUrl: ''
});

const loadingLocation = useForm({
  type: '',
  address: '',
  city: '',
  postalCode: '',
  country: '',
  fullAddress: '',
  lat: '',
  lng: '',
  googleMapUrl: ''
});

watch(applyDiscount, (value) => {
  optionsUpdated(servicesOptions.value);
});

watch(sameAddressAsClient, (value) => {
  if (value) {
    setLoadingAddressData(reformatLocation(currentClient.address))
  } else {
    movingjob.loading_address = "";
  }
});

const newWaybill = useForm({
  executing_company_id: currentWaybill.executing_company ? currentWaybill.executing_company.id : ""
});


const saveField = (field) => {
  console.log(movingjob[field]);
  movingjob.put(route("6dem.waybill.update", { id: currentWaybill.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
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

const updateMovingJob = () => {
  movingjob.put(route("6dem.movingJob.update", { id: currentMovingJob.id }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("movingJob.update"),
    onError: (errors) => console.log(errors)
  });
};

const updateDiscount = () => {
  optionsUpdated(servicesOptions.value);
};

const updatePaymentProcess = () => {
  optionsUpdated(servicesOptions.value);
};

const saveFormula = () => {
  currentFormula.value = getFromulaByName(movingjob.formula);
  movingjob.put(route("6dem.quotation.update", { id: currentQuotation.id, field: 'formula' }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("saved"),
    onError: (errors) => console.log(errors)
  });
};

const setLoadingAddressData = (location) => {
  movingjob.loading_address = location.fullAddress;
  loadingLocation.type = "loading";
  loadingLocation.address = location.address;
  loadingLocation.city = location.city;
  loadingLocation.postalCode = location.postalCode;
  loadingLocation.country = location.country;
  loadingLocation.fullAddress = location.fullAddress;
  loadingLocation.lat = location.lat;
  loadingLocation.lng = location.lng;
  loadingLocation.googleMapUrl = location.googleMapUrl;

  loadingLocation.put(route("6dem.quotation.location", { id: currentQuotation.id, from: 'quotation' }), {
    preserveScroll: true,
    onSuccess: updateDistance,
    onError: (errors) => console.log(errors)
  });
};

const setShippingAddressData = (location) => {
  movingjob.shipping_address = location.fullAddress;
  shippingLocation.type = "shipping";
  shippingLocation.address = location.address;
  shippingLocation.city = location.city;
  shippingLocation.postalCode = location.postalCode;
  shippingLocation.country = location.country;
  shippingLocation.fullAddress = location.fullAddress;
  shippingLocation.lat = location.lat;
  shippingLocation.lng = location.lng;
  shippingLocation.googleMapUrl = location.googleMapUrl;
  shippingLocation.put(route("6dem.quotation.location", { id: currentQuotation.id, from: 'quotation' }), {
    preserveScroll: true,
    onSuccess: updateDistance,
    onError: (errors) => console.log(errors)
  });
};

const updateDistance = (response) => {
  movingjobLocationUrl.value.loading_google_map_url = response.props.movingJob.loading_location?.google_map_url;
  movingjobLocationUrl.value.shipping_google_map_url = response.props.movingJob.shipping_location?.google_map_url; 
  movingjob.distance = response.props.movingJob.distance;
};

const optionsUpdated = (options) => {
  servicesOptions.value = options;
  if(options.length > 0) {
    let currentDiscount = applyDiscount.value ? movingjob.discount : 0;
    movingjob.amount_ht = calculateTotalHT(options, currentDiscount)
    movingjob.amount_tva = calculatePercentage(movingjob.amount_ht, currentSettings.vat)
    movingjob.amount_ttc = calculateTTC(movingjob.amount_ht, movingjob.amount_tva)
    movingjob.advance = calculatePercentage(movingjob.amount_ttc, getAdvanceOrBalance(movingjob.payment_process, 'advance'))
    movingjob.balance = calculatePercentage(movingjob.amount_ttc, getAdvanceOrBalance(movingjob.payment_process, 'balance'))
    setTimeout(() => {
      updateMovingJob();
    }, 1000);
  }
}


const previewWaybill = () => {
  router.visit(route("6dem.documents.waybill.preview", currentWaybill.id), {
    method: "get",
    replace: true
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