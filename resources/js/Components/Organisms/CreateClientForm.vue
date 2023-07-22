<template>
  <div class="pt-3 flex flex-col py-10 h-auto">
    <form
      @submit.prevent="createClient"
      class="w-full pt-3 flex flex-col space-y-2"
    >
      <div class="w-full pt-3 flex space-x-2">
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
        class="w-full pt-3 flex flex-col space-y-2"
      >
        <div class="w-full pt-3 flex space-x-2">
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

        <GMapAutocomplete
          placeholder="Adresse du client"
          autocomplete="off"
          value="1 rue de la rep"
          @place_changed="setAddressData"
          class="form-input h-12 w-full rounded-md border-tertiary bg-tertiary border-none focus:outline-none focus:ring-primary focus:border-none"
          :options="{
            componentRestrictions: { country: 'FR' },
          }"
        />

        <DefaultInput
          :required="true"
          v-model="form.address"
          :error="form.errors.address"
          name="address"
          label="Adresse"
        />

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

        <DefaultInput
          :required="false"
          v-model="form.source"
          :error="form.errors.source"
          name="source"
          label="Source"
        />
      </div>

      <div
        v-if="form.clientType === 'professional'"
        class="w-full pt-3 flex flex-col space-y-2"
      >
        <DefaultInput
          :required="true"
          v-model="form.siren"
          :error="form.errors.siren"
          name="siren"
          label="Siren/Siret"
        />

        <DefaultInput
          :required="true"
          v-model="form.clientOrganizationName"
          :error="form.errors.clientOrganizationName"
          name="company_name"
          label="Nom de la societé"
        />

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

        <DefaultInput
          :required="true"
          v-model="form.address"
          :error="form.errors.address"
          name="address"
          label="Adresse de Facturation"
        />

        <DefaultInput
          :required="false"
          v-model="form.source"
          :error="form.errors.source"
          name="source"
          label="Source"
        />
      </div>
      <div class="shrink-0 py-4">
        <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
          <DefaultButton type="submit" class="w-1/2" buttontext="Valider" />
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import SelectableButton from "@/Components/Atoms/SelectableButton.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import { useForm } from "@inertiajs/vue3";
import { parseLocation } from "@/utils/index";
import { onMounted, ref } from "vue";

const emit = defineEmits(["created"]);

const setAddressData = (location) => {
  console.log(parseLocation(location));
};

const form = useForm({
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

const clientTypeChange = (value) => {
  form.clientType = value;
  form.clientOrganizationName = "";
  form.firstName = "";
  form.lastName = "";
  form.phoneNumber = "";
  form.email = "";
  form.address = "";
  form.source = "";
  form.siret = "";
  form.siren = "";
  form.clearErrors();
};

const createClient = () => {
  form.post(route("6dem.create.clients"), {
    preserveScroll: true,
    onSuccess: (resp) => console.log(resp),
    // onSuccess: () => emit("created"),
  });
};
</script>  

<style>
.pac-container {
  z-index: 10000 !important;
}
</style>