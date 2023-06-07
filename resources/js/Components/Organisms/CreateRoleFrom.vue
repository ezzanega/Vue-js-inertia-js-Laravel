<template>
  <div>
    <IconButton
      @click="confirmRoleCreation"
      class="text-right shrink-0 place-self-end"
      text="Ajouter un role"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="2.2"
        stroke="currentColor"
        aria-hidden="true"
        class="pointer-events-none shrink-0 w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M12 4.5v15m7.5-7.5h-15"
        />
      </svg>
    </IconButton>

    <Modal :show="roleCreationModal" @close="closeModal">
      <div class="w-full p-6 flex flex-col space-y-2">
        <div class="mt-6">
          <DefaultInput
            :required="true"
            name="roleName"
            v-model="form.roleName"
            :error="form.errors.roleName"
            label="Nom du role"
            placeholder="Nom du role"
          />
        </div>

        <li
          v-for="permission in permissions"
          :key="permission.id"
          class="flex gap-x-6 py-5"
        >
          <div class="flex gap-x-4">
            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" alt="" />
            <div class="min-w-0 flex-auto">
              <p class="text-sm font-semibold leading-6 text-gray-900">
                {{ permission.name }}
              </p>
              <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                Permission
              </p>
            </div>
          </div>
          <div class="hidden sm:flex sm:flex-col sm:items-end">
            <div class="mt-1 flex items-center gap-x-1.5">
              <div class="flex-none">
                <label class="relative inline-flex items-center cursor-pointer">
                  <input
                    type="checkbox"
                    @change="selectPermissions($event, permission.name)"
                    class="sr-only peer"
                  />
                  <div
                    class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"
                  ></div>
                </label>
              </div>
            </div>
          </div>
        </li>

        <div class="mt-6 flex justify-end space-x-4">
          <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
          <DefaultButton
            @click="createRole"
            class="w-32"
            buttontext="Valider"
          />
        </div>
      </div>
    </Modal>
  </div>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";

defineProps({
  permissions: Array,
});

const roleCreationModal = ref(false);

const form = useForm({
  roleName: "",
  permissions: [],
});

const confirmRoleCreation = () => {
  roleCreationModal.value = true;
};

const createRole = () => {
  form.post(route("6dem.manage.role"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => console.log("error"),
  });
};

const closeModal = () => {
  roleCreationModal.value = false;
  form.reset();
};

const selectPermissions = (e, permission) => {
  if (e.target.checked && !form.permissions.includes(permission)) {
    form.permissions.push(permission);
  } else {
    form.permissions = form.permissions.filter((i) => i !== permission);
  }
  console.log(form.permissions)
};
</script>