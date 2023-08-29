<template>
  <Head title="Sign Up" />
  <div class="h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div
      class="w-screen m-0 bg-white flex justify-center flex-1 flex-row-reverse"
    >
      <div class="lg:w-1/2 xl:w-7/12 p-6 sm:p-12 overflow-auto">
        <div class="mt-12 flex flex-col items-center">
          <h1 class="text-2xl xl:text-3xl font-extrabold text-primary">
            Créez votre compte gratuitement
          </h1>
          <div class="w-full flex-1 mt-8">
            <div class="flex flex-col items-center">
              <button
                class="w-full max-w-2xl font-bold shadow-sm rounded-lg py-2.5 bg-secondary text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline"
              >
                <GoogleIcon />
                <span class="ml-4">S'inscrire avec Google </span>
              </button>
            </div>

            <div class="my-12 border-b text-center">
              <div
                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2"
              >
                Ou
              </div>
            </div>

            <form @submit.prevent="submit" class="mx-auto max-w-2xl">
              <DefaultInput
                class="w-full"
                type="text"
                :required="false"
                label="Nom de votre société"
                name="companyName"
                v-model="form.companyName"
                :error="form.errors.companyName"
              />
              <div class="flex space-x-3">
                <DefaultInput
                  class="w-full"
                  type="text"
                  :required="false"
                  label="Prénom"
                  name="firstName"
                  v-model="form.firstName"
                  :error="form.errors.firstName"
                />
                <DefaultInput
                  class="w-full"
                  type="text"
                  :required="false"
                  label="Nom"
                  name="lastName"
                  v-model="form.lastName"
                  :error="form.errors.lastName"
                />
              </div>
              <DefaultSelectInput
                class="w-full"
                name="position"
                label="Poste occupé"
                placeholder="Sélectionner un poste"
                v-model="form.position"
                :options="positionOptions"
                :error="form.errors.position"
              />
              <DefaultInput
                class="w-full"
                type="text"
                :required="false"
                label="Téléphone"
                name="phoneNumber"
                v-model="form.phoneNumber"
                :error="form.errors.phoneNumber"
              />
              <DefaultInput
                class="w-full"
                type="email"
                :required="false"
                label="Email professionnel"
                name="email"
                v-model="form.email"
                :error="form.errors.email"
              />
              <DefaultInput
                class="w-full"
                type="password"
                :required="false"
                label="Mot de passe"
                name="password"
                v-model="form.password"
                :error="form.errors.password"
              />

              <p class="mt-6 text-xs text-gray-600 text-center">
                En cliquant sur « Créer mon compte », vous acceptez les
                <a href="#" class="border-b border-gray-500 border-dotted">
                  Conditions Générales d'Utilisation </a
                >. Vous pouvez également consulter notre
                <a href="#" class="border-b border-gray-500 border-dotted">
                  Politique de confidentialité
                </a>
              </p>

              <DefaultButton
                class="mt-5 font-semibold"
                type="submit"
                buttontext="Créer mon compte"
                :disabled="form.processing"
              >
                <svg
                  class="w-6 h-6 -ml-2"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                  <circle cx="8.5" cy="7" r="4" />
                  <path d="M20 8v6M23 11h-6" />
                </svg>
              </DefaultButton>

              <p class="mt-6 font-bold text-md text-gray-600 text-center">
                Vous avez déjà un compte ?
                <Link
                  :href="route('6dem.signin')"
                  class="border-b text-primary border-primary border-dotted"
                >
                  Se connecter
                </Link>
              </p>
            </form>
          </div>
        </div>
      </div>
      <div
        class="flex-1 bg-secondary text-center hidden lg:flex overflow-hidden"
      >
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
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import { Head, Link, usePage, useForm } from "@inertiajs/vue3";

const form = useForm({
  companyName: "",
  firstName: "",
  lastName: "",
  position: "",
  phoneNumber: "",
  email: "",
  password: "",
  optin: false,
});

const props = usePage().props;

const positionOptions = [
  {
    name: 'Dirigeant',
    value: 'Dirigeant',
  },
  {
    name: 'Directeur',
    value: 'Directeur',
  },
  {
    name: 'Gérant',
    value: 'Gérant',
  },
  {
    name: "Chef d'exploitation",
    value: "Chef d'exploitation",
  },
  {
    name: 'Directeur commercial',
    value: 'Directeur commercial',
  },
  {
    name: 'Assistant(e) commercial(e)',
    value: 'Assistant(e) commercial(e)',
  },
  {
    name: 'Chauffeur-Déménageur',
    value: 'Chauffeur-Déménageur',
  },
];

form.companyName = props.organization;

const submit = () => {
  form.post(route("6dem.signup"), {
    onFinish: () => form.reset("password"),
    replace: true
  });
};
</script>