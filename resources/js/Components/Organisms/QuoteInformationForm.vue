<template>
  <div class="2xl:px-28">
    <div class="pt-14 grid justify-items-center">
      <UploadFile class="w-1/6" :logo="currentSettings.logo" label="Déposez ou cliquez si vous souhaitez ajouter votre logo" />
    </div>
    <div class="flex flex-col space-y-2 px-8 mt-24">


      <div class="text-center text-3xl font-bold py-5">
        <h1>Informations clients</h1>
      </div>

      <div class="grid grid-cols-3 gap-6 justify-between">
        <div>
          <DefaultInput class="w-full my-auto" type="text" v-model="currentClient.first_name" label="Prénom du client" name="client_first_name" placeholder="Prénom du client" />
        </div>
        <div>
          <DefaultInput class="w-full my-auto" type="text" v-model="currentClient.last_name" label="Nom du client" name="client_last_name" placeholder="Nom du client" />
        </div>
        <div>
          <DefaultInput class="w-full my-auto" type="text" v-model="currentClient.phone_number" label="Nom du client" name="client_phone_number" placeholder="Téléphone" />
        </div>
      </div>

      <div v-if="currentClient.type == 'professional'">
        <DefaultInput class="w-full my-auto" type="text" v-model="currentClient.client_organization.name" label="Nom complet de l'entreprise" name="client_organization_name" placeholder="Nom complet de l'entreprise" />
      </div>
      <div>
        <DefaultInput class="w-full my-auto" type="text" v-model="currentClient.address.full_address" label="Adresse du client" name="client_full_address" placeholder="Adresse du client" />
      </div>
    </div>
    <div class="flex flex-col space-y-2 px-8 mt-16">
      <div class="text-center text-3xl font-bold pb-5">
        <h1>Informations à remplir sur le déménagement</h1>
      </div>
      <DocumentLabel name="Devis" color="#438A7A" />
      <div>
        <div class="grid grid-cols-2 gap-6 pb-5 justify-between">
          <div>
            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.validity_duratation"  @savingValue="saveField('validity_duratation')" label="Validité devis" name="validity_duratation" placeholder="Validité devis (7 jours, 1 mois ..)" />
          </div>
          <div>
            <DefaultInput class="w-full my-auto" type="number" v-model="movingjob.capacity"  @savingValue="saveField('capacity')" label="Volume (en m³)" name="capacity" placeholder="Volume(en m³)" />
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-20 justify-between">
        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Chargement" color="#438A7A" />
          <ToggleButton v-model:checked="sameAddressAsClient" name="same-address" label="Adresse de chargement identique à l'adresse du client ?" />
          <LocationAutocomplete :value="movingjob.loading_address" v-model="movingjob.loading_address" name="loading_address" label="Adresse de chargement" placeholder="Adresse de chargement" @place_changed="setLoadingAddressData" />
          <div v-if="movingjobLocationUrl.loading_google_map_url">
            <a :href="movingjobLocationUrl.loading_google_map_url" target="_blank" class="border-b text-primary border-primary border-dotted text-xs font-bold">
              Voir l'adresse sur Google street map
            </a>
          </div>
          <DefaultInput class="w-full my-auto" type="date" v-model="movingjob.loading_date"  @savingValue="saveField('loading_date')" label="Date de chargement" name="loading_date" placeholder="Date de chargement" />

          <div class="flex space-x-2">
            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.loading_floor"  @savingValue="saveField('loading_floor')" label="Étage" name="loading_floor" placeholder="Étage" />

            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.loading_elevator"  @savingValue="saveField('loading_elevator')" label="Ascenseur" name="loading_elevator" placeholder="Ascenseur" />
          </div>

          <div class="flex space-x-2">
            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.loading_portaging"  @savingValue="saveField('loading_portaging')" label="Portage" name="loading_portaging" placeholder="Portage" />

            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.loading_details"  @savingValue="saveField('loading_details')" label="Détails" name="loading_details" placeholder="Détails" />
          </div>

        </div>

        <div class="flex flex-col space-y-2">
          <DocumentLabel name="Livraison" color="#438A7A" />
          <div class="pt-6"></div>
          <LocationAutocomplete :value="movingjob.shipping_address" v-model="movingjob.shipping_address" name="shipping_address" label="Adresse de livraison" placeholder="Adresse de livraison" @place_changed="setShippingAddressData" />
          <div v-if="movingjobLocationUrl.shipping_google_map_url">
            <a :href="movingjobLocationUrl.shipping_google_map_url" target="_blank" class="border-b text-primary border-primary border-dotted text-xs font-bold">
              Voir l'adresse sur Google street map
            </a>
          </div>
          <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.shipping_date"  @savingValue="saveField('shipping_date')" label='Date de livraison (ou mention "Au suivant")' name="shipping_date" placeholder="Date de livraison" />
          <div class="flex space-x-2">
            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.shipping_floor"  @savingValue="saveField('shipping_floor')" label="Étage" name="shipping_floor" placeholder="Étage" />

            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.shipping_elevator"  @savingValue="saveField('shipping_elevator')" label="Ascenseur" name="shipping_elevator" placeholder="Ascenseur" />
          </div>

          <div class="flex space-x-2">
            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.shipping_portaging"  @savingValue="saveField('shipping_portaging')" label="Portage" name="shipping_portaging" placeholder="Portage" />

            <DefaultInput class="w-full my-auto" type="text" v-model="movingjob.shipping_details"  @savingValue="saveField('shipping_details')" label="Détails" name="shipping_details" placeholder="Détails" />
          </div>
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
import DocumentLabel from "@/Components/Atoms/DocumentLabel.vue";
import HandleOptionsFields from "@/Components/Organisms/HandleOptionsFields.vue";
import DocumentSelectInput from "@/Components/Atoms/DocumentSelectInput.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import LocationAutocomplete from "@/Components/Atoms/LocationAutocomplete.vue";
import "vue-select/dist/vue-select.css";
import { reactive, ref } from "vue";
import { watch } from "vue";
import { reformatLocation, paymentProcessOptions, calculateTotalHT, calculatePercentage, calculateTTC, getAdvanceOrBalance } from "@/utils";
import { onMounted } from "vue";


const currentSettings = usePage().props.settings;
const currentOrganisation = usePage().props.organization;
const currentQuotation = usePage().props.quotation;
const currentMovingJob = usePage().props.movingJob;
const currentClient = usePage().props.client;
const movingJobFormulas = usePage().props.movingJobFormulas;

const formulaOptaions = movingJobFormulas.map(item => ({
  name: item.name,
  value: item.slug
}));


const movingjob = useForm({
  validity_duratation: currentQuotation.validity_duratation ?? currentSettings.quotation_validity_duratation,
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

const applyDiscount = ref(currentMovingJob.discount > 0 ? true : false);
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

onMounted(() => {
  if (!currentQuotation.validity_duratation) {
    saveField('validity_duratation')
  }
});

const saveField = (field) => {
  movingjob.put(route("6dem.quotation.update", { id: currentQuotation.id, field: field }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => console.log("quotation.update"),
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

const previewQuotation = () => {
  router.visit(route("6dem.documents.quotation.preview", currentQuotation.id), {
    method: "get",
    replace: true
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