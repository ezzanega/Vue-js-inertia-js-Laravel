<template>
  <Modal :show="showModal" @close="$emit('close')">
    <form
      @submit.prevent="updateOrganization"
      class="w-full p-6 flex flex-col space-y-2"
    >
      <div class="mt-2 border-b border-gray-200 divide-x">
        <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
          Compléter les information de votre société
        </p>
      </div>
      <div class="w-full flex flex-col space-y-2">
        <DefaultInput
          :required="true"
          v-model="form.organizationName"
          :error="form.errors.organizationName"
          name="organizationName"
          label="Nom de la société"
        />

        <div class="w-full flex space-x-2">
          <DefaultInput
            :required="true"
            class="w-1/2"
            v-model="form.siren"
            :error="form.errors.siren"
            @update:modelValue="getCompanyInformations"
            name="siren"
            label="N° siren (Remplissage automatique)"
          />

          <DefaultInput
            :required="true"
            class="w-1/2"
            v-model="form.siret"
            :error="form.errors.siret"
            @update:modelValue="getCompanyInformations"
            name="siret"
            label="N° siret (Remplissage automatique)"
          />
        </div>

        <LocationAutocomplete
          :required="true"
          :value="form.address"
          :error="form.errors.address"
          name="address"
          label="Adresse"
          placeholder="Adresse du client"
          @place_changed="setAddressData"
        />

        <div class="w-full flex space-x-2">
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

        <div class="w-full flex space-x-2">
          <DefaultInput
            :required="true"
            class="w-1/2"
            v-model="form.phoneNumber"
            :error="form.errors.phoneNumber"
            name="phone"
            label="Téléphone"
          />
          <DefaultInput
            :required="true"
            class="w-1/2"
            v-model="form.email"
            :error="form.errors.email"
            name="email"
            label="Email"
          />
        </div>
      </div>
      <div class="shrink-0 py-4">
        <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
          <DefaultButton type="submit" buttontext="Enregistrer" />
        </div>
      </div>
    </form>
  </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import LocationAutocomplete from "@/Components/Atoms/LocationAutocomplete.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import axios from "axios";
import { parseCompanyInformations } from "@/utils/index";

const emit = defineEmits(["close"]);

defineProps({
  showModal: Boolean,
});

const organization = usePage().props.organization;

const form = useForm({
  email: "",
  phoneNumber: "",
  organizationName: "",
  siret: "",
  siren: "",
  address: "",
  city: "",
  postalCode: "",
  country: "",
  fullAddress: "",
  lat: "",
  lng: "",
  googleMapUrl: "",
});

form.organizationName = organization.name;
form.phoneNumber = organization.phone_number;
form.email = organization.email;
form.siret = organization.siret;
form.siren = organization.siren;
if (organization.billing_address) {
  form.address = organization.billing_address.address;
  form.city = organization.billing_address.city;
  form.postalCode = organization.billing_address.postal_code;
  form.country = organization.billing_address.country;
  form.fullAddress = organization.billing_address.full_address;
  form.lat = organization.billing_address.lat;
  form.lng = organization.billing_address.lng;
  form.googleMapUrl = organization.billing_address.google_map_url;
}

const setAddressData = (location) => {
  form.address = location.address;
  form.city = location.city;
  form.postalCode = location.postalCode;
  form.country = location.country;
  form.fullAddress = location.fullAddress;
  form.lat = location.lat;
  form.lng = location.lng;
  form.googleMapUrl = location.googleMapUrl;
};

const setOrganizationData = (organization) => {
  form.organizationName = organization.organizationName;
  form.siren = organization.siren;
  form.siret = organization.siret;
  form.codeNaf = organization.codeNaf;
  form.address = organization.address;
  form.city = organization.city;
  form.postalCode = organization.postalCode;
  form.country = organization.country;
  form.fullAddress = organization.fullAddress;
};

const updateOrganization = () => {
  form.put(route("6dem.organization.update"), {
    preserveScroll: true,
    onSuccess: () => emit("close"),
  });
};

const getCompanyInformations = async (value) => {
  if (value.length >= 9) {
    try {
      const result = await axios.get(
        "https://suggestions.pappers.fr/v2/?q=" +
          value.replace(/\s/g, "") +
          "&cibles=siren,siret"
      );
      setOrganizationData(
        parseCompanyInformations(result.data.resultats_siren[0])
      );
    } catch (e) {
      console.log(e);
    }
  }
};
</script>