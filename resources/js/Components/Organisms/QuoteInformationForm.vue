<template>
  <div class="2xl:px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-2 px-8 mt-24">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations de la société de déménagement</h1>
      </div>
      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput :value="'DEVIS N° ' + currentQuotation.number" placeholder="N° du devis"
              :font-bold="true" />
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
            <DocumentFieldInput :value="currentOrganisation.licence" placeholder="Licence N°" />
          </DocumentFieldFrame>
        </div>
      </div>
      <div>
        <DocumentFieldFrame>
          <DocumentFieldInput placeholder="Adresse de la société"
            :value="currentOrganisation.billing_address.full_address" />
        </DocumentFieldFrame>
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
        <div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Nom complet de l'entreprise"
              :value="currentClient.client_organization?.name" />
          </DocumentFieldFrame>
        </div>
      </div>
    </div>
    <div class="flex flex-col space-y-2 px-8 mt-16">
      <div class="text-center text-4xl font-bold pb-5">
        <h1>Informations à remplir sur le déménagement</h1>
      </div>
      <DocumentLabel name="Devis" color="#438A7A" />
      <div>
        <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Validité devis (7 jours, 1 mois ..)" :value="movingjob.validity_duratation"  v-model="movingjob.validity_duratation"
                @savingValue="saveField('validity_duratation')" />
            </DocumentFieldFrame>
          </div>
          <div>
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Volume(en m³)" :value="movingjob.capacity"  v-model="movingjob.capacity"
                @savingValue="saveField('capacity')" />
            </DocumentFieldFrame>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Chargement" color="#438A7A" />
          <ToggleButton v-model:checked="sameAddressAsClient" name="same-address" label="Adresse de chargement identique à l'adresse du client ?" />
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :value="movingjob.loading_address" name="loading_address" placeholder="Adresse de chargement"
              @place_changed="setLoadingAddressData" />
          </DocumentFieldFrame>
          <div v-if="movingjobLocationUrl.loading_google_map_url">
            <a :href="movingjobLocationUrl.loading_google_map_url" target="_blank" class="border-b text-primary border-primary border-dotted text-xs">
              Voir l'adresse sur Google street map
            </a>
          </div>
          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de chargement" v-model="movingjob.loading_date"
              @savingValue="saveField('loading_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.loading_floor"
                @savingValue="saveField('loading_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.loading_elevator"
                @savingValue="saveField('loading_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.loading_portaging"
                @savingValue="saveField('loading_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.loading_details"
                @savingValue="saveField('loading_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'loading'" />
        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Livraison" color="#438A7A" />
          <div class="pt-6"></div>
          <DocumentFieldFrame>
            <DocumentFieldInputAddress :value="movingjob.shipping_address" name="shipping_address" placeholder="Adresse de livraison"
              @place_changed="setShippingAddressData" />
          </DocumentFieldFrame>
          <div v-if="movingjobLocationUrl.shipping_google_map_url">
            <a :href="movingjobLocationUrl.shipping_google_map_url" target="_blank" class="border-b text-primary border-primary border-dotted text-xs">
              Voir l'adresse sur Google street map
            </a>
          </div>

          <DocumentFieldFrame>
            <DocumentFieldInput placeholder="Date de livraison" v-model="movingjob.shipping_date"
              @savingValue="saveField('shipping_date')" />
          </DocumentFieldFrame>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Étage" v-model="movingjob.shipping_floor"
                @savingValue="saveField('shipping_floor')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Ascenseur" v-model="movingjob.shipping_elevator"
                @savingValue="saveField('shipping_elevator')" />
            </DocumentFieldFrame>
          </div>

          <div class="flex space-x-2">
            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Portage" v-model="movingjob.shipping_portaging"
                @savingValue="saveField('shipping_portaging')" />
            </DocumentFieldFrame>

            <DocumentFieldFrame>
              <DocumentFieldInput placeholder="Détails" v-model="movingjob.shipping_details"
                @savingValue="saveField('shipping_details')" />
            </DocumentFieldFrame>
          </div>

          <DynamicQuoteFields :movingjob="currentMovingJob.id" :position="'shipping'" />
        </div>
      </div>
      <div class="text-center text-2xl font-bold pb-5 flex justify-center">
        <h1>Distance: </h1>
        <DocumentFieldInput placeholder="distance" :value="movingjob.distance" v-model="movingjob.distance" @savingValue="saveField('distance')" />
      </div>
    </div>

    <div  v-if="currentClient.type == 'individual'" class="flex flex-col space-y-2 px-8 mt-8">
      <div class="flex flex-col mt-4 space-y-2">
        <DocumentLabel name="Formule de déménagement (Particulier)" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DocumentSelectInput v-model="movingjob.formula" :value="movingjob.formula" @change="saveFormula" :options="formulaOptaions" default-text="Formule de déménagament"/>
      </div>
      <div v-if="currentFormula">
        <div class="space-x-2 lg:flex p-2">
          <div class="w-auto lg:w-1/2">
            <p class="text-sm text-gray-500 underline font-bold">À notre charge</p>
            <ul class="my-2 space-y-1">
              <li
                v-for="(option, index) in getOptionByType(currentFormula?.options,'organization-side')"
                :key="index">
                <a
                  href="#"
                  class="flex items-center p-1.5 text-xs font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>

                  <span class="flex-1 ml-3">{{ option.text }}</span>
                  <div class="flex justify-end gap-4"></div>
                </a>
              </li>
            </ul>
          </div>
          <div class="w-auto lg:w-1/2">
            <p class="text-sm text-gray-500 underline font-bold">
              À la charge du client
            </p>
            <ul class="my-2 space-y-1">
              <li
                v-for="(option, index) in getOptionByType(currentFormula?.options, 'client-side')"
                :key="index">
                <a
                  href="#"
                  class="flex items-center p-1.5 text-xs font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                  </svg>
                  <span class="flex-1 ml-3">{{ option.text }}</span>
                  <div class="flex justify-end gap-4"></div>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="text-xs text-center text-gray-500">Pour modifier les formules de déménagement, rendez-vous dans la section <span class="font-bold text-primary">Réglages</span></div>
      </div>
      <div v-else class="text-xs text-red-500 text-center">Veuillez selectionner une formule de déménagement</div>
    </div>

    <div class="flex flex-col space-y-2 px-8 mt-8">
      <div class="flex flex-col mt-4 space-y-2">
        <DocumentLabel name="Prestations" color="#438A7A" />
      </div>
      <div class="flex flex-col space-y-2">
        <DynamicFields :movingjob="currentMovingJob.id" />
      </div>
    </div>

    <div class="flex flex-col space-y-2 px-8 pb-10 mt-10">
      <DocumentLabel name="Tarification" color="#438A7A" />
      <div class="flex flex-col space-y-2 ">
        <ToggleButton class="my-auto  w-1/2" v-model:checked="applyDiscount" name="apply-discount" label="Appliquer une remise" />
        <DefaultInput v-if="applyDiscount" class="my-auto w-1/2" type="number" @savingValue="saveField('discount')" v-model="movingjob.discount" name="discount" placeholder="Remise (en %)" label="Remise (en %)"/>
      </div>
      <div class="grid grid-cols-3 gap-4 justify-between">
        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Total HT {{ applyDiscount ? '(-'+movingjob.discount+'%)' : '' }} :
            </span>
            <span class="w-1/2">
              {{ '14650 €' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              TVA (20%) :
            </span>
            <span class="w-1/2">
              {{ '2350 €' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="font-bold p-0.5 flex justify-start">
            <span class="w-1/2">
              Total TTC : 
            </span>
            <span class="w-1/2">
              {{ '16980 €' }}
            </span>
          </div>
        </DocumentFieldFrame>
      </div>


      <div class="grid grid-cols-3 gap-4 justify-between">
        <DocumentSelectInput v-model="movingjob.payment_process" :value="movingjob.payment_process" @change="saveField('payment_process')" :options="processPaymentOptions" default-text="Modalités de règlement"/>
        
        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Accompte (30%) :
            </span>
            <span class="w-1/2">
              {{ '2350 €' }}
            </span>
          </div>
        </DocumentFieldFrame>

        <DocumentFieldFrame>
          <div class="p-0.5 flex justify-start">
            <span class="w-1/2">
              Slode (70%) :
            </span>
            <span class="w-1/2">
              {{ '2350 €' }}
            </span>
          </div>
        </DocumentFieldFrame>
      </div>
    </div>
    <div class="flex flex-row w-1/3 pb-10 mt-10 mx-auto">
      <DefaultButton @click="previewQuotation" buttontext="Générer le document" />
    </div>
  </div>
</template>

<script setup>
import { usePage, useForm, router } from "@inertiajs/vue3";
import UploadFile from "@/Components/Atoms/UploadFile.vue";
import DocumentFieldFrame from "@/Components/Atoms/DocumentFieldFrame.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import ToggleButton from "@/Components/Atoms/ToggleButton.vue";
import DocumentFieldInput from "@/Components/Atoms/DocumentFieldInput.vue";
import DocumentFieldInputAddress from "@/Components/Atoms/DocumentFieldInputAddress.vue";
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import DynamicFields from "@/Components/Organisms/DynamicFields.vue";
import DynamicQuoteFields from "@/Components/Organisms/DynamicQuoteFields.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import "vue-select/dist/vue-select.css";
import { reactive, ref, computed } from "vue";
import { watch } from "vue";
import { reformatLocation, paymentProcessOptions } from "@/utils";


const currentSettings = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentQuotation = usePage().props.quotation;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const currentInsuranceContractual = usePage().props.insurances.find(insurance => insurance.type === "contractual");
const currentInsuranceAdValorem = usePage().props.insurances.find(insurance => insurance.type === "ad_valorem");
const movingJobFormulas = usePage().props.movingJobFormulas;

const formulaOptaions = movingJobFormulas.map(item => ({
  name: item.name,
  value: item.slug
}));

const insuranceContractual = useForm({
  max_value: currentInsuranceContractual ? currentInsuranceContractual.max_value : "",
  franchise: currentInsuranceContractual ? currentInsuranceContractual.franchise : "",
  amount_ht: currentInsuranceContractual ? currentInsuranceContractual.amount_ht : 0,
  amount_ttc: currentInsuranceContractual ? currentInsuranceContractual.amount_ht + (currentInsuranceContractual.amount_ht*currentSettings.vat)/100 : ""
});

const insuranceAdValorem = useForm({
  max_value: currentInsuranceAdValorem ? currentInsuranceAdValorem.max_value : "",
  franchise: currentInsuranceAdValorem ? currentInsuranceAdValorem.franchise : "",
  amount_ht: currentInsuranceAdValorem ? currentInsuranceAdValorem.amount_ht : 0,
  amount_ttc: currentInsuranceContractual ? currentInsuranceAdValorem.amount_ht + (currentInsuranceAdValorem.amount_ht*currentSettings.vat)/100 : ""
});

const movingjob = useForm({
  validity_duratation: currentQuotation.validity_duratation ? currentQuotation.validity_duratation : currentSettings.quotation_validity_duratation,
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
  discount: currentMovingJob.discount ? currentMovingJob.discount : "",
  amount_ht: currentMovingJob.amount_ht ? currentMovingJob.amount_ht : 0,
  advance: currentMovingJob.advance ? currentMovingJob.advance : "",
  balance: currentMovingJob.balance ? currentMovingJob.balance : "",
  distance: currentMovingJob.distance ? currentMovingJob.distance : "",
  payment_process: currentMovingJob.payment_process ? currentMovingJob.payment_process : ""
});

const sameAddressAsClient = ref( movingjob.loading_address == currentClient.address.full_address);
const applyDiscount = ref(currentMovingJob.discount ? true : false);
const processPaymentOptions = paymentProcessOptions();
const movingjobLocationUrl = ref( {
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


watch(sameAddressAsClient, (value) => {
  if (value) {
    setLoadingAddressData(reformatLocation(currentClient.address))
  } else {
    movingjob.loading_address = "";
  }
});

watch(
  () => insuranceContractual.amount_ht,
  (newValue) => {
    insuranceContractual.amount_ttc = (newValue * currentSettings.vat)/100
  }
);

const saveField = (field) => {
  movingjob.put(route("6dem.quotation.update", { id: currentQuotation.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("quotation.update"),
    onError: (errors) => console.log(errors)
  });
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

const saveInsurance = (id, field, type) => {
  if (type === 'contractual') {
    insuranceContractual.put(route("6dem.insurance.update", { id: id, field: field }), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => console.log("saved"),
    });
  } else {
    insuranceAdValorem.put(route("6dem.insurance.update", { id: id, field: field }), {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => console.log("saved"),
      onError: (errors) => console.log(errors)
    });
  }
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

const previewQuotation = () => {
  router.visit(route("6dem.documents.quotation.preview", currentQuotation.id), {
    method: "get",
  });
};

const getFromulaByName = (name) => {
  return movingJobFormulas.find((obj) => {
    return obj.slug === name;
  });
};

const getOptionByType = (options, type) => {
  if (!options) return null;
  return options.filter((obj) => {
    return obj.type === type;
  });
};
</script>