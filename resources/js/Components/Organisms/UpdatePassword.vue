<template>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-neutral-900">
          Mettre à jour le mot de passe
        </h3>
        <p class="mt-1 text-sm text-neutral-600">
          Veillez à ce que votre compte utilise un mot de passe long et
          aléatoire pour rester sécurisé.
        </p>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="updatePassword">
          <div class="">
            <div
              class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden"
            >
              <div class="px-4 py-5 sm:p-6">
                <Message
                  v-show="$page.props.status === 'password-updated'"
                  status="success"
                  message="Votre mot de passe bien a été mis à jour"
                />
                <div class="w-full pt-3 flex flex-col space-y-2">
                  <DefaultInput
                    class="w-full"
                    type="password"
                    label="Mot de passe actuel"
                    v-model="form.current_password"
                    :error="form.errors.current_password"
                  />
                  <!-- v-model="form.password"
                    :error="form.errors.password" -->
                  <DefaultInput
                    class="w-full"
                    type="password"
                    label="Nouveau mot de passe"
                    v-model="form.password"
                    :error="form.errors.password"
                  />
                  <DefaultInput
                    class="w-full"
                    type="password"
                    label="Confirmer le mot de passe"
                    v-model="form.password_confirmation"
                    :error="form.errors.password_confirmation"
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
import Message from "@/Components/Atoms/Message.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const updatePassword = () => {
  form.put(route("6dem.password.update"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset("password", "password_confirmation");
        passwordInput.value.focus();
      }
      if (form.errors.current_password) {
        form.reset("current_password");
        currentPasswordInput.value.focus();
      }
    },
  });
};
</script>