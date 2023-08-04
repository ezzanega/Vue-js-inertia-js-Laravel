<template>
  <div class="overflow-hidden m-5">
    <IconButton @click="openCreateMailTemplateModal" class="p-2" text="Ajouter un modèle de mail">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"
        aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
      </svg>
    </IconButton>
    <CreateMailTemplateModal :openModal="inviteUserModal" @closeModal="closeModal" />

    <table
      class="w-full mt-2 border-collapse bg-white text-left text-sm text-gray-500 border border-gray-200 shadow-md rounded-lg">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nom</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">
            Objet du mail
          </th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">
            Contenu du mail
          </th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100">

        <tr v-for="(mail, index) in templates" :key="index" class="hover:bg-gray-50">
          <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
            <div class="text-sm">
              <div class="font-medium text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="mr-3 h-6 w-6 shrink-0">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
              </div>
            </div>
          </th>
          <td class="px-6 py-4">
            <div class="truncate w-56">
              {{ mail.name }}
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="truncate w-56">
              {{ mail.subject }}
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="truncate w-56">
              {{ mail.body }}
            </div>
          </td>
          <td>
            <div class="truncate">
              <div class="flex justify-end gap-4"></div>

              <Dropdown placement="bottom-end">
                <svg class="h-6 w-6 cursor-pointer" viewBox="0 0 28 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M13.9449 6.06482C15.6474 6.06482 17.0276 4.70716 17.0276 3.03241C17.0276 1.35766 15.6474 0 13.9449 0C12.2424 0 10.8623 1.35766 10.8623 3.03241C10.8623 4.70716 12.2424 6.06482 13.9449 6.06482Z"
                    fill="currentColor" />
                  <path
                    d="M24.8082 6.06482C26.5107 6.06482 27.8909 4.70716 27.8909 3.03241C27.8909 1.35766 26.5107 0 24.8082 0C23.1057 0 21.7256 1.35766 21.7256 3.03241C21.7256 4.70716 23.1057 6.06482 24.8082 6.06482Z"
                    fill="currentColor" />
                  <path
                    d="M3.08263 6.06482C4.78513 6.06482 6.16527 4.70716 6.16527 3.03241C6.16527 1.35766 4.78513 0 3.08263 0C1.38014 0 0 1.35766 0 3.03241C0 4.70716 1.38014 6.06482 3.08263 6.06482Z"
                    fill="currentColor" />
                </svg>
                <template #popper>
                  <!-- <MailActionsPopperContent /> -->
                  <div class="w-auto">
                    <div class="space-y-0.5">

                      <PopperItem item="Modifier le Mail" @click="openUpModal(mail)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor"
                          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </PopperItem>
                      <PopperItem item="Supprimer le Mail" @click.prevent="deleteMail(mail.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor"
                          class="mr-2 h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                      </PopperItem>
                    </div>
                  </div>
                </template>
              </Dropdown>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <UpdateMailTemplateModal v-if="isModalUpOpen && selectedMail" :openUpModal="isModalUpOpen"
      @closeUpModal="closeUpModal" :mailData="selectedMail" />
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Dropdown } from "floating-vue";
import PopperItem from "@/Components/Atoms/PopperItem.vue";

import MailActionsPopperContent from "@/Components/Molecules/MailActionsPopperContent.vue";

import UpdateMailTemplateModal from "@/Components/Templates/UpdateMailTemplateModal.vue";

import CreateMailTemplateModal from "@/Components/Templates/CreateMailTemplateModal.vue";

import IconButton from "@/Components/Atoms/IconButton.vue";
import { usePage, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
  templates: Object,
});

const inviteUserModal = ref(false);

const openCreateMailTemplateModal = () => {
  inviteUserModal.value = true;
};

const closeModal = () => {
  inviteUserModal.value = false;
};

const isModalUpOpen = ref(false);

// const openUpModal = () => {
//     isModalUpOpen.value = true;
// };
const selectedMail = ref(null);

const openUpModal = (mail) => {
  isModalUpOpen.value = true;
  selectedMail.value = mail;
  // console.log(selectedMail.value);
};

const closeUpModal = () => {
  isModalUpOpen.value = false;
};


function deleteMail(id) {
  axios.delete(route("6dem.mail.templates.delete", id))
    .then(response => {
      console.log(response)
    })
    .catch(error => {
      // Handle the error
      console.error(error);
    }
    );

}

</script>



