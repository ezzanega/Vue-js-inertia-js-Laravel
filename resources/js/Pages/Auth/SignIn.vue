<template>
  <Head title="Sign In" />
  <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="w-screen m-0 bg-white flex justify-center flex-1">
      <div class="lg:w-1/2 xl:w-7/12 p-6 sm:p-12">
        <div class="mt-12 flex flex-col items-center">
          <h1 class="text-2xl xl:text-3xl font-extrabold text-primary">
            Se connecter
          </h1>
          <div class="w-full flex-1 mt-8">
            <div class="flex flex-col items-center">
              <button
                class="w-full max-w-xl font-bold shadow-sm rounded-lg py-2.5 bg-secondary text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline"
              >
                <GoogleIcon />
                <span class="ml-4">Se connecter avec Google </span>
              </button>
            </div>

            <div class="my-12 border-b text-center">
              <div
                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2"
              >
                Ou se connecter avec Email
              </div>
            </div>

            <form @submit.prevent="submit" class="mx-auto max-w-xl">
              <DefaultInput
                class="w-full pb-3"
                type="email"
                :required="false"
                label="Email"
                name="email"
                v-model="form.email"
                :error="form.errors.email"
              />
              <DefaultInput
                class="w-full pb-3"
                type="password"
                :required="false"
                label="Mot de passe"
                name="password"
                v-model="form.password"
                :error="form.errors.password"
              />
              <Link
                :href="route('6dem.forgot-password')"
                class="border-b text-primary border-primary border-dotted"
              >
                Mot de passe oublié ?
              </Link>
              <DefaultButton
                class="mt-5 font-semibold"
                type="submit"
                buttontext="Se connecter"
                :disabled="form.processing"
              />

              <p class="mt-6 font-bold text-md text-gray-600 text-center">
                Vous n'avez pas encore de compte ?
                <Link
                  :href="route('6dem.signup')"
                  class="border-b text-primary border-primary border-dotted"
                >
                  S'inscrire
                </Link>
              </p>

              <p class="mt-6 text-xs text-gray-600 text-center">
                Consultez à tout moment notre
                <a href="#" class="border-b border-gray-500 border-dotted">
                  Politique de confidentialité
                </a>
                et nos
                <a href="#" class="border-b border-gray-500 border-dotted">
                  CGV
                </a>
              </p>
            </form>
          </div>
        </div>
      </div>
      <div class="flex-1 bg-secondary text-center hidden lg:flex">
        <div
          class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
          style="
            background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg');
          "
        ></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import GoogleIcon from "@/Components/Atoms/GoogleIcon.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("6dem.signin"), {
    onFinish: () => form.reset("password"),
    replace: true
  });
};
</script>