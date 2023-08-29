<template>
    <div>
        <button class="rounded-lg bg-primary p-3 text-white" @click="confirmRoleDelete">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </button>
        <Modal :show="roleDeleteModal" @close="closeModal">
            <div class="w-full p-6 flex flex-col space-y-2">
                <div class="mt-6">
                    <DefaultInput :required="true" name="roleName"
                        label="Nom du role" placeholder="Nom du role" :modelValue="role.name" :disabled="true"/>
                </div>

                <div class="mt-6 flex justify-end space-x-6">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                    <DefaultButton @click="DeleteRole" buttontext="Supprimer" />
                </div>
            </div>
        </Modal>
    </div>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";

const props = defineProps({
    role: Object
});

const roleDeleteModal = ref(false);

const confirmRoleDelete = () => {
    roleDeleteModal.value = true;
};

const DeleteRole = () => {
    router.delete(route("6dem.manage.role.delete", props.role.id), { replace: true })
};

const closeModal = () => {
    roleDeleteModal.value = false;
};
</script>