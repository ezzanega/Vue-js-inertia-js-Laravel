<template>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-neutral-900">
          Mon compte
        </h3>
        <p class="mt-1 text-sm text-neutral-600">
          Mettez à jour les informations de profil et l'adresse email de votre
          compte.
        </p>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="updateAccount">
          <div class="">
            <div
              class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden"
            >
              <div class="px-4 py-5 sm:p-6">
                <div class="w-full pt-3 flex flex-col space-y-2">
                  <div class="w-full pt-3 flex space-x-2">
                    <DefaultInput
                      class="w-1/2"
                      name="fist_name"
                      label="Prénom"
                      v-model="form.first_name"
                      :error="form.errors.first_name"
                    />
                    <DefaultInput
                      class="w-1/2"
                      name="last_name"
                      label="Nom"
                      v-model="form.last_name"
                      :error="form.errors.last_name"
                    />
                  </div>
                  <DefaultInput
                    name="email"
                    label="Email"
                    v-model="form.email"
                    :error="form.errors.email"
                  />
                  <DefaultInput
                    name="phone"
                    label="Téléphone"
                    v-model="form.phone_number"
                    :error="form.errors.phone_number"
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
import { usePage, useForm } from "@inertiajs/vue3";

const user = usePage().props.auth.user;

const form = useForm({
  first_name: "",
  last_name: "",
  phone_number: "",
  email: "",
});

form.first_name = user.first_name;
form.last_name = user.last_name;
form.phone_number = user.phone_number;
form.email = user.email;

const updateAccount = () => {
  form.put(route("6dem.profile.update"), {
    preserveScroll: true,
    onSuccess: (resp) => console.log(resp),
  });
};
</script>