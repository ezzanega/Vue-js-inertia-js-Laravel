<template>
  <div
    class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen"
  >
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
      <div class="flex flex-col py-4 px-3">
        <h1 class="text-xl xl:text-2xl font-extrabold text-primary text-center">
          Réinitialiser votre mot de passe
        </h1>
        <div class="space-y-4 md:space-y-6 sm:p-8">
          <DefaultInput
            class="w-full"
            type="password"
            :required="false"
            label="Mot de passe"
            name="password"
          />
          <DefaultInput
            class="w-full"
            type="password"
            :required="false"
            label="Conformation mot de passe"
            name="passwordConformation"
          />
          <DefaultButton class="mt-5" buttontext="Valider" />
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
</script>
  