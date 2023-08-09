<template>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-neutral-900">
                    Prestataires
                </h3>
                <p class="mt-1 text-sm text-neutral-600">
                    Ajoutez, modifiez, supprimez vos divers prestataires
                </p>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0 flex flex-col space-y-3">
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6">
                    <div v-if="usePage().props.executingCompanies.length" class="space-x-2 xl:flex">
                        <div class="w-full">
                            <ul class="my-4 space-y-3">
                                <li v-for="(executingCompany, index) in usePage().props.executingCompanies" :key="index">
                                    <a href="#"
                                        class="flex items-center p-3 text-sm font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                        <span class="flex-1 ml-3">{{ executingCompany.name }}</span>
                                        <span class="flex-1 text-xs">{{ executingCompany.email }}</span>
                                        <span class="flex-1 text-xs">{{ executingCompany.phone_number }}</span>
                                        <div class="flex justify-end gap-4">
                                            <Dropdown placement="bottom-end">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6 cursor-pointer">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                                </svg>
                                                <template #popper>
                                                    <div class="w-auto">
                                                        <div class="space-y-0.5">
                                                            <PopperItem item="Modifier" @clicked="PopperItemClicked">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                </svg>
                                                            </PopperItem>
                                                            <PopperItem item="Supprimer" @clicked="deleteExecutingCompany(executingCompany.id)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>
                                                            </PopperItem>
                                                        </div>
                                                    </div>
                                                </template>
                                            </Dropdown>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-sm font-normal text-gray-500">Vous n'avez encore aucun prestataire. Rajoutez-en un
                            dès à présent.</p>
                    </div>
                </div>
                <div class="px-4 py-4 sm:px-6">
                    <div class="flex justify-end">
                        <DefaultButton type="submit" buttontext="Ajouter un prestataire" @click="showModal" />
                    </div>
                </div>
            </div>
        </div>
        <ExecutingCompanyModal :showModal="showExecutingCompanyModal" @close="closeModal" />
    </div>
</template>
  
<script setup>
import { Dropdown } from "floating-vue";
import PopperItem from "@/Components/Atoms/PopperItem.vue";
import ExecutingCompaniesPopperContent from "@/Components/Settings/ExecutingCompaniesPopperContent.vue";
import ExecutingCompanyModal from "@/Components/Organisms/ExecutingCompanyModal.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import { usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";

const showExecutingCompanyModal = ref(false);

const showModal = () => {
    showExecutingCompanyModal.value = true;
};

const closeModal = () => {
    showExecutingCompanyModal.value = false;
};

const deleteExecutingCompany = (id) => {
    router.delete(route("6dem.executingCompany.delete", id), {
        preserveScroll: true
    })
};

const getOptionByType = (options, type) => {
    return options.filter((obj) => {
        return obj.type === type;
    });
};
</script>
  