<template>
    <Modal :show="openModal" @close="closeUpRoleModal">
      <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                Modifier le role d'un collaborateur
              </h2>
              <span class="text-sm">
                <!-- Un mail contenant un lien d'invitation sera envoyé à l'utilisateur
                pour qu'il crée un compte. Le lien sera valable pendant 3 jours et
                sera invalidé après la création du compte. -->
                {{ MemberData.email }}
              </span>
            </div>
            <div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
                @click="closeUpRoleModal"
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
            <form>
                <input type="label" disabled v-model="MemberData.role" name="id" />
                <input type="label" disabled :value="getRoleLabel(MemberData.role)" name="id" />
                <div class="px-4 sm:px-6">
                <div class="w-full py-3 flex flex-col space-y-2">
                    <div class="my-6 space-y-5">

                        <!-- <DefaultInput
                            :required="true"
                            type="email"
                            name="email"
                            v-model="form.email"
                            :error="form.errors.email"
                            label="Email du collaborateur"
                            placeholder="Email du collaborateur"
                        /> -->
                        <DefaultSelectInput
                        name="role"
                        label="Rôle"
                        :modelValue="form.role"
                        :selectedValue="form.role"
                        :options="rolesOptions"
                        :error="form.errors.role"
                        />
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                    <SecondaryButton @click="closeUpRoleModal"> Annuler </SecondaryButton>
                    <DefaultButton
                        @click="updateRole"
                        class="w-32"
                        buttontext="Modifier le Role"
                    />
                    </div>
                </div>
                </div>
            </form>
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
  MemberData: Object,
});

const rolesOptions = ref([]);
const emit = defineEmits(["closeUpRoleModal"]);

onMounted(() => {
  props.roles.forEach((role) => {
    rolesOptions.value.push({
      name: getRoleLabel(role.name),
      value: role.name,
    });
  });

  console.log('Roles options:', rolesOptions.value);
});

// Create the form object using useForm
const form = useForm({
  role: props.MemberData.role,
});

const updateRole = () => {
  alert('update function')
};

const closeUpRoleModal = () => {
  form.reset();
  emit("closeUpRoleModal");
};
</script>
