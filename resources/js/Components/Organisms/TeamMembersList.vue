<template>
  <div class="overflow-hidden m-5">
    <IconButton
      @click="openInviteUserModal"
      class="p-2"
      text="Inviter un collaborateur"
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
    <InviteUserForm
      :roles="roles"
      :openModal="inviteUserModal"
      @closeModal="closeModal"
    />
    <table
      class="w-full mt-2 border-collapse bg-white text-left text-sm text-gray-500 border border-gray-200 shadow-md rounded-lg"
    >
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nom</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">
            Status
          </th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900">Rôle</th>
          <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100">
        <tr
          v-for="(member, index) in teamMembres"
          :key="index"
          class="hover:bg-gray-50"
        >
          <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
            <div class="text-sm">
              <div class="font-medium text-gray-700">
                {{
                  member.first_name
                    ? member.first_name + " " + member.last_name
                    : ""
                }}
              </div>
              <div class="text-gray-400">{{ member.email }}</div>
            </div>
          </th>
          <td class="px-6 py-4">
            <span
              v-if="member.first_name"
              class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-600"
            >
              <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
              Compte actif
            </span>
            <span
              v-else
              class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600"
            >
              <span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span>
              Invitation en cours
            </span>
          </td>
          <td class="px-6 py-4">
            <span
              v-if="!member.first_name"
              class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700"
            >
              {{ getRoleLabel(member.role) }}
            </span>

            <div v-else class="flex">
              <span
                v-for="(role, index) in member.roles"
                :key="index"
                class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700"
              >
                {{ getRoleLabel(role.name) }}
              </span>
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="flex justify-end gap-4">
                <Dropdown placement="bottom-end">
                    <svg
                      class="h-6 w-6 cursor-pointer"
                      viewBox="0 0 28 7"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M13.9449 6.06482C15.6474 6.06482 17.0276 4.70716 17.0276 3.03241C17.0276 1.35766 15.6474 0 13.9449 0C12.2424 0 10.8623 1.35766 10.8623 3.03241C10.8623 4.70716 12.2424 6.06482 13.9449 6.06482Z"
                        fill="currentColor"
                      />
                      <path
                        d="M24.8082 6.06482C26.5107 6.06482 27.8909 4.70716 27.8909 3.03241C27.8909 1.35766 26.5107 0 24.8082 0C23.1057 0 21.7256 1.35766 21.7256 3.03241C21.7256 4.70716 23.1057 6.06482 24.8082 6.06482Z"
                        fill="currentColor"
                      />
                      <path
                        d="M3.08263 6.06482C4.78513 6.06482 6.16527 4.70716 6.16527 3.03241C6.16527 1.35766 4.78513 0 3.08263 0C1.38014 0 0 1.35766 0 3.03241C0 4.70716 1.38014 6.06482 3.08263 6.06482Z"
                        fill="currentColor"
                      />
                    </svg>
                    <template #popper>
                      <ManageCollaborateurActionsPopperContent />
                    </template>
                </Dropdown>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
    import { Dropdown } from "floating-vue";
    import ManageCollaborateurActionsPopperContent from "@/Components/Molecules/ManageCollaborateurActionsPopperContent.vue";
    import IconButton from "@/Components/Atoms/IconButton.vue";
    import InviteUserForm from "@/Components/Organisms/InviteUserForm.vue";
    import { usePage } from "@inertiajs/vue3";
    import { ref } from "vue";
    import { getRoleLabel } from "@/utils/index";

    defineProps({
    teamMembres: Array,
    });

    const roles = usePage().props.roles;

    const inviteUserModal = ref(false);

    const openInviteUserModal = () => {
    inviteUserModal.value = true;
    };

    const closeModal = () => {
    inviteUserModal.value = false;
    };
</script>
