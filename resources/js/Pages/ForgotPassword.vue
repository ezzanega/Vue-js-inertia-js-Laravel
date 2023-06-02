<template>
  <div
    class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen"
  >
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
      <div class="flex flex-col py-4 px-3">
        <h1 class="text-xl xl:text-2xl font-extrabold text-primary text-center">
          Mot de passe oublié ?
        </h1>
        <p class="mt-6 text-xs text-gray-600 text-center px-8">
          Nous vous enverrons un email avec les instructions pour réinitialiser
          votre mot de passe.
        </p>
        <div class="space-y-4 md:space-y-6 sm:p-8">
          <DefaultInput
            class="w-full"
            type="email"
            :required="false"
            label="Email"
            name="email"
          />
          <div class="flex space-x-2 w-full mt-5">
            <Link
              :href="route('6dem.signin')"
              class="flex items-center justify-center w-1/2 text-primary font-semibold"
            >
              Retour à la page de login
            </Link>
            <div class="w-1/2 font-semibold">
              <DefaultButton buttontext="Valider" />
            </div>
          </div>
        </div>
        <p class="mt-6 font-bold text-md text-gray-600 text-center">
          Vous n'avez pas encore de compte ?
          <Link
            :href="route('6dem.signup')"
            class="border-b text-primary border-primary border-dotted"
          >
            S'inscrire
          </Link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import { Link } from "@inertiajs/vue3";
</script>
