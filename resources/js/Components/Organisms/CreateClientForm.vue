<template>
  <div class="pt-3 flex flex-col py-10 h-auto">
    <div class="w-full pt-3 flex flex-col space-y-2">
      <div class="w-full pt-3 flex space-x-2">
        <SelectableButton
          text="Particulier"
          value="particulier"
          :selected="clientType === 'particulier'"
          @selected="clientTypeChange"
        />
        <SelectableButton
          text="Professionnel"
          value="professionnel"
          :selected="clientType === 'professionnel'"
          @selected="clientTypeChange"
        />
      </div>

      <div
        v-if="clientType === 'particulier'"
        class="w-full pt-3 flex flex-col space-y-2"
      >
        <div class="w-full pt-3 flex space-x-2">
          <DefaultInput
            class="w-1/2"
            :required="true"
            name="fist_name"
            label="Prénom"
          />
          <DefaultInput
            class="w-1/2"
            :required="false"
            name="last_name"
            label="Nom"
          />
        </div>

        <DefaultInput
          :required="true"
          name="address"
          label="Adresse"
        />

        <DefaultInput
          :required="true"
          name="phone"
          label="Téléphone"
        />

        <DefaultInput
          :required="false"
          name="email"
          label="Email"
        />

        <DefaultInput
          :required="false"
          name="source"
          label="Source"
        />
      </div>

      <div
        v-if="clientType === 'professionnel'"
        class="w-full pt-3 flex flex-col space-y-2"
      >
        <DefaultInput
          :required="true"
          name="siren"
          label="Siren/Siret"
        />

        <DefaultInput
          :required="true"
          name="company_name"
          label="Nom de la societé"
        />

        <DefaultInput
          :required="true"
          name="phone"
          label="Téléphone"
        />

        <DefaultInput
          :required="false"
          name="email"
          label="Email"
        />

        <DefaultInput
          :required="true"
          name="address"
          label="Adresse de Facturation"
        />

        <DefaultInput
          :required="false"
          name="source"
          label="Source"
        />
      </div>
    </div>
  </div>
</template>
<script setup>
  import DefaultInput from '@/Components/Atoms/DefaultInput.vue';
  import SelectableButton from '@/Components/Atoms/SelectableButton.vue';
import { ref } from 'vue';

  const clientType = ref('particulier');

  const clientTypeChange = (value) => {
    clientType.value = value
  }
</script>  