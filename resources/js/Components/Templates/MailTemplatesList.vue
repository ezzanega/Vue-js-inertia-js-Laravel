<template>
  <div class="overflow-hidden m-5">
    <IconButton
      @click="openCreateMailTemplateModal"
      class="p-2"
      text="Ajouter un modèle de mail"
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
    <CreateMailTemplateModal
      :openModal="inviteUserModal"
      @closeModal="closeModal"
    />
    <table
      class="w-full mt-2 border-collapse bg-white text-left text-sm text-gray-500 border border-gray-200 shadow-md rounded-lg"
    >
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
        <tr
          v-for="(mail, index) in templates"
          :key="index"
          class="hover:bg-gray-50"
        >
          <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
            <div class="text-sm">
              <div class="font-medium text-gray-700">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="mr-3 h-6 w-6 shrink-0"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"
                  />
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
          <td class="px-6 py-4">
            <div class="truncate">
              <div class="flex justify-end gap-4"></div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6"
                x-tooltip="tooltip"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                />
              </svg>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
  
  <script setup>
import CreateMailTemplateModal from "@/Components/Templates/CreateMailTemplateModal.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
  templates: Array,
});

const inviteUserModal = ref(false);

const openCreateMailTemplateModal = () => {
  inviteUserModal.value = true;
};

const closeModal = () => {
  inviteUserModal.value = false;
};
</script>