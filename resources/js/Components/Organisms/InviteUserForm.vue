<template>
  <Modal :show="openModal" @close="closeModal">
    <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
      <div class="px-4 sm:px-6">
        <div class="flex items-start justify-between">
          <div class="space-y-1">
            <h2
              id="headlessui-dialog-title-15"
              data-headlessui-state="open"
              class="text-lg font-medium"
            >
              Inviter un collaborateur
            </h2>
            <span class="text-sm">
              Un mail contenant un lien d'invitation sera envoyé à l'utilisateur
              pour qu'il crée un compte. Le lien sera valable pendant 3 jours et
              sera invalidé après la création du compte.
            </span>
          </div>
          <div class="ml-3 flex h-7 items-center">
            <button
              type="button"
              class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
              tabindex="0"
              @click="closeModal"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
                class="h-6 w-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div class="px-4 sm:px-6">
        <div class="w-full py-3 flex flex-col space-y-2">
          <div class="my-6 space-y-5">

            <DefaultInput
              :required="true"
              type="email"
              name="email"
              v-model="form.email"
              :error="form.errors.email"
              label="Email du collaborateur"
              placeholder="Email du collaborateur"
            />
            <DefaultSelectInput
              name="type"
              label="Rôle"
              v-model="form.role"
              :options="rolesOptions"
              :error="form.errors.role"
            />
          </div>

          <div class="mt-6 flex justify-end space-x-4">
            <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
            <DefaultButton
              @click="createRole"
              class="w-32"
              buttontext="Envoyer l'invitation"
            />
          </div>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
import { getRoleLabel } from "@/utils/index";

const props = defineProps({
  roles: Array,
  openModal: Boolean,
});

const rolesOptions = ref([]);
const emit = defineEmits(["closeModal"]);

onMounted(() => {
  props.roles.forEach((role) => {
    rolesOptions.value.push({
      name: getRoleLabel(role.name),
      value: role.name,
    });
  });
});

const form = useForm({
  email: "",
  role: "",
});

const createRole = () => {
  form.post(route("6dem.manage.invite.user"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => console.log("error"),
  });
};

const closeModal = () => {
  form.reset();
  emit("closeModal");
};
</script>
