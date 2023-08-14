<template>
    <div class="flex flex-col h-auto py-10 pt-3">
      <form
        @submit.prevent="createClient"
        class="flex flex-col w-full pt-3 space-y-2"
      >
        <div class="flex w-full pt-3 space-x-2">
          <SelectableButton
            text="Particulier"
            value="individual"
            :selected="form.clientType === 'individual'"
            @selected="clientTypeChange"
          />
          <SelectableButton
            text="Professionnel"
            value="professional"
            :selected="form.clientType === 'professional'"
            @selected="clientTypeChange"
          />
        </div>

        <div
          v-if="form.clientType === 'individual'"
          class="flex flex-col w-full space-y-2"
        >
          <div class="flex w-full space-x-2">
            <DefaultInput
              class="w-1/2"
              :required="true"
              v-model="form.firstName"
              :error="form.errors.firstName"
              name="fist_name"
              label="Prénom"
            />
            <DefaultInput
              class="w-1/2"
              :required="false"
              v-model="form.lastName"
              :error="form.errors.lastName"
              name="last_name"
              label="Nom"
            />
          </div>

          <LocationAutocomplete
            :required="true"
            v-model="form.address"
            :error="form.errors.address"
            name="address"
            label="Adresse"
            placeholder="Adresse du client"
            @place_changed="setAddressData"
          />

          <div class="flex w-full space-x-2">
            <DefaultInput
              class="w-1/3"
              :required="true"
              v-model="form.city"
              :error="form.errors.city"
              name="city"
              label="Ville"
            />
            <DefaultInput
              class="w-1/3"
              :required="false"
              v-model="form.postalCode"
              :error="form.errors.postalCode"
              name="postalCode"
              label="Code postal"
            />

            <DefaultInput
              class="w-1/3"
              :required="false"
              v-model="form.country"
              :error="form.errors.country"
              name="country"
              label="Pays"
            />
          </div>

          <DefaultInput
            :required="true"
            v-model="form.phoneNumber"
            :error="form.errors.phoneNumber"
            name="phone"
            label="Téléphone"
          />

          <DefaultInput
            :required="false"
            v-model="form.email"
            :error="form.errors.email"
            name="email"
            label="Email"
          />

         <DefaultSelectInput
            name="source"
            label="Source"
            v-model="form.source"
            :options="sourceOptions"
            :error="form.errors.source"
          />
        </div>

        <div
          v-if="form.clientType === 'professional'"
          class="flex flex-col w-full space-y-2"
        >
          <DefaultInput
            :required="true"
            v-model="form.clientOrganizationName"
            :error="form.errors.clientOrganizationName"
            name="company_name"
            label="Nom de la societé"
          />

          <DefaultInput
            :required="true"
            v-model="form.siren"
            :error="form.errors.siren"
            name="siren"
            label="Siren/Siret de la societé"
          />

          <div class="flex w-full space-x-2">
            <DefaultInput
              class="w-1/2"
              :required="true"
              v-model="form.firstName"
              :error="form.errors.firstName"
              name="fist_name"
              label="Prénom"
            />
            <DefaultInput
              class="w-1/2"
              :required="false"
              v-model="form.lastName"
              :error="form.errors.lastName"
              name="last_name"
              label="Nom"
            />
          </div>

          <DefaultInput
            :required="true"
            v-model="form.phoneNumber"
            :error="form.errors.phoneNumber"
            name="phone"
            label="Téléphone"
          />

          <LocationAutocomplete
            :required="true"
            v-model="form.address"
            :error="form.errors.address"
            name="address"
            label="Adresse de Facturation"
            placeholder="Adresse du client"
            @place_changed="setAddressData"
          />

          <div class="flex w-full space-x-2">
            <DefaultInput
              class="w-1/3"
              :required="true"
              v-model="form.city"
              :error="form.errors.city"
              name="city"
              label="Ville"
            />
            <DefaultInput
              class="w-1/3"
              :required="false"
              v-model="form.postalCode"
              :error="form.errors.postalCode"
              name="postalCode"
              label="Code postal"
            />

            <DefaultInput
              class="w-1/3"
              :required="false"
              v-model="form.country"
              :error="form.errors.country"
              name="country"
              label="Pays"
            />
          </div>

          <DefaultInput
            :required="false"
            v-model="form.email"
            :error="form.errors.email"
            name="email"
            label="Email"
          />

          <DefaultSelectInput
            name="source"
            label="Source"
            v-model="form.source"
            :options="sourceOptions"
            :error="form.errors.source"
          />
        </div>
        <div class="py-4 shrink-0">
          <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
            <DefaultButton type="submit" class="w-1/2" buttontext="Modifier les information" />
          </div>
        </div>
      </form>
    </div>
  </template>
  <script setup>
  import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
  import SelectableButton from "@/Components/Atoms/SelectableButton.vue";
  import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
  import LocationAutocomplete from "@/Components/Atoms/LocationAutocomplete.vue";
  import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
  import { useForm } from "@inertiajs/vue3";
  import { onMounted, ref } from "vue";

  const props = defineProps({
    selectedClient: Object,
  });

  const emit = defineEmits(["close","selectedClient"]);
  console.log('Received Selected Client: ', props.selectedClient)


  const form = useForm({
    clientType: props.selectedClient.type,
    firstName: props.selectedClient.first_name,
    lastName: props.selectedClient.last_name,
    phoneNumber: props.selectedClient.phone_number,
    email: props.selectedClient.email,
    source: props.selectedClient.source,
    clientOrganizationName: props.selectedClient.client_organization
    ? props.selectedClient.client_organization.name
    : "",
    siret: props.selectedClient.client_organization
    ? props.selectedClient.client_organization.siret
    : "",
    siren: props.selectedClient.client_organization
    ? props.selectedClient.client_organization.siren
    : "",
    //Adresse
    address: props.selectedClient.address,
    city: "",
    postalCode: "",
    country: "",
    fullAddress: "",
    lat: "",
    lng: "",
    googleMapUrl: "",
  });




  // const clientTypeChange = (value) => {
  //   form.clientType = value;
  //   form.clientOrganizationName = "";
  //   form.firstName = "";
  //   form.lastName = "";
  //   form.phoneNumber = "";
  //   form.email = "";
  //   form.address = "";
  //   form.source = "";
  //   form.siret = "";
  //   form.siren = "";
  //   form.address = "";
  //   form.city = "";
  //   form.postalCode = "";
  //   form.country = "";
  //   form.fullAddress = "";
  //   form.lat = "";
  //   form.lng = "";
  //   form.googleMapUrl = "";
  //   form.clearErrors();
  // };

  const sourceOptions = [
    {
      name: 'Bouche à oreille & Recommandation',
      value: 'Bouche à oreille & Recommandation',
    },
    {
      name: 'Appel entant',
      value: 'Appel entant',
    },
    {
      name: 'Publicité en Ligne(google adwords…)',
      value: 'Publicité en Ligne(google adwords…)',
    },
    {
      name: 'Publicité traditionnelle',
      value: 'Publicité traditionnelle',
    },
    {
      name: "Campagnes d'Emailing",
      value: "Campagnes d'Emailing",
    },

    {
      name: "Site Web et SEO",
      value: "Site Web et SEO",
    }
  ];
  const updateClient = () => {
    // form.post(route("6dem.create.clients"), {
    //   preserveScroll: true,
    //   onSuccess: () => emit("close"),
    // });
    alert('hello from update Client')
  };
  </script>

  <style>
  .pac-container {
    z-index: 10000 !important;
  }
  </style>
