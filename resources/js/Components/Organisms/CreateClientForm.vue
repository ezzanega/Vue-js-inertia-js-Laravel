<template>
  <div class="pt-3 flex flex-col py-10 h-auto justify-between">
    <div class="w-full pt-3 flex flex-col space-y-2">
      <DefaultInput
        :required="true"
        name="Nom"
        label="Nom"
      />

      <DefaultInput
        :required="true"
        name="Nom"
        label="Nom"
      />

      <DefaultInput
        :required="true"
        name="Nom"
        label="Nom"
      />

      <DefaultInput
        :required="true"
        name="Nom"
        label="Nom"
      />

      <DefaultInput
        :required="true"
        name="Nom"
        label="Nom"
      />
    </div>
    <DefaultButton buttontext="Valider" />
  </div>
</template>
<script setup>
  import DefaultInput from '@/Components/Atoms/DefaultInput.vue';
  import DefaultButton from '@/Components/Atoms/DefaultButton.vue';
</script>  