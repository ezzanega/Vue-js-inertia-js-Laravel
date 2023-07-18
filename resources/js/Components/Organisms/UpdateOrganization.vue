<template>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-neutral-900">Société</h3>
        <p class="mt-1 text-sm text-neutral-600">
          Informations de l'entreprise
        </p>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="updatePassword">
          <div class="">
            <div
              class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden"
            >
              <div class="px-4 py-5 sm:p-6">
                <div class="w-full pt-3 flex flex-col space-y-2">
                  <DefaultInput
                    class="w-full"
                    label="Adresse de Facturation"
                    v-model="form.address"
                    :error="form.errors.address"
                  />

                  <DefaultInput
                    class="w-full"
                    label="Ville"
                    v-model="form.city"
                    :error="form.errors.city"
                  />

                  <DefaultInput
                    class="w-full"
                    label="Pays"
                    v-model="form.country"
                    :error="form.errors.country"
                  />
                </div>
              </div>
              <div class="bg-neutral-50 px-4 py-4 sm:px-6">
                <div class="flex justify-end">
                  <div>
                    <DefaultButton type="submit" buttontext="Modifier" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
  address: "",
  city: "",
  country: "",
});

const updateBillingAddress = () => {
  form.put(route("6dem.organization.update"), {
    preserveScroll: true,
    onSuccess: () => console.log(),
  });
};
</script>