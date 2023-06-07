<template>
    <div>
        <button class="rounded-lg bg-primary p-3 text-white" @click="confirmRoleupdate">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </button>

        <Modal :show="roleUpdateModal" @close="closeModal">
            <div class="w-full p-6 flex flex-col space-y-2">
                <div class="mt-6">
                    <DefaultInput :required="true" name="roleName" v-model="form.roleName" :error="form.errors.roleName"
                        label="Nom du role" placeholder="Nom du role" :modelValue="roleName" />
                </div>

                <li v-for="permission in permissions" :key="permission.id" class="flex gap-x-6 py-5">
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
                                    <input type="checkbox" @change="selectPermissions($event, permission.name)"
                                        class="sr-only peer" :checked="form.permissions.includes(permission.name)"/>
                                    <div
                                        class="w-11 h-6 bg-secondary peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-none after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </li>

                <div class="mt-6 flex justify-end space-x-4">
                    <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
                    <DefaultButton @click="updateRole" class="w-32" buttontext="Modifier" />
                </div>
            </div>
        </Modal>
    </div>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";

const props = defineProps({
    permissions: Array,
    role: Object
});

const roleUpdateModal = ref(false);
const rolePermissions = ref([]);

const form = useForm({
    roleName: props.role.name,
    permissions: [],
});

onMounted(() => {
    axios.get(route("6dem.manage.role.getPermissionsById", props.role.id))
        .then(response => {
            rolePermissions.value = response.data.map(permission => permission.name);
        })
        .catch(error => {
            // Handle the error
            console.error(error);
        });  
})

const confirmRoleupdate = () => {
    form.permissions = rolePermissions.value;
    roleUpdateModal.value = true;
};

const updateRole = () => {
    form.put(route("6dem.manage.role.update", props.role.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => console.log("An orror occured"),
    });
    form.permissions = [...new Set(form.permissions)];
};

const closeModal = () => {
    roleUpdateModal.value = false;
};

const selectPermissions = (e, permission) => {
    if (e.target.checked && !form.permissions.includes(permission)) {
        form.permissions.push(permission);
    } else {
        form.permissions = form.permissions.filter((i) => i !== permission);
    }
};
</script>