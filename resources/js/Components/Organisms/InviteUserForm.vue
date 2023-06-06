<template>
  <Modal :show="openModal" @close="closeModal">
    <div class="w-full p-6 flex flex-col space-y-2">
      <div class="mt-6">
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
          v-model="form.role"
          :options="rolesOptions"
          :error="form.errors.role"
        />
      </div>

      <div class="mt-6 flex justify-end space-x-4">
        <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
        <DefaultButton @click="createRole" class="w-32" buttontext="Valider" />
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

const props = defineProps({
  roles: Array,
  openModal: Boolean,
});

const rolesOptions = ref([]);
const emit = defineEmits(["closeModal"]);

onMounted(() => {
  props.roles.forEach((role) => {
    rolesOptions.value.push({
      name: role.name,
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