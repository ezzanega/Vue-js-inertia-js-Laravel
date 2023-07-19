<template>
  <Head title="Gestion" />
  <DemLayout>
    <Tabs>
      <Tab title="Équipe">
        <TeamMembersList v-if="teamMembres" :teamMembres="teamMembres" />
        <ListEmptyMessage
          v-else
          message-title="Inviter vos collaborateurs"
          message-content="Commencez par ajouter un nouveau collaborateur"
        >
          <IconButton
            @click="openInviteUserModal"
            class="mt-6"
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
        </ListEmptyMessage>
      </Tab>
      <Tab title="Roles">
        <div v-if="!roles">
          <ListEmptyMessage
            message-title="Vous n'avez pas de roles créés"
            message-content="Commencez par ajouter un nouveau role"
          >
            <IconButton class="mt-6" text="Ajouter un role">
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
          </ListEmptyMessage>
        </div>
        <div v-else>
          <div class="flex flex-row my-7 place-content-between">
            <h1 class="font-bold text-primary self-center">Gérez vos rôles</h1>
            <CreateRoleFrom :permissions="permissions" />
          </div>
          <ul role="list" class="divide-y divide-gray-100">
            <li
              v-for="role in roles"
              :key="role.id"
              class="flex justify-between gap-x-6 py-5"
            >
              <div class="flex gap-x-4">
                <img
                  class="h-12 w-12 flex-none rounded-full bg-gray-50"
                  alt=""
                />
                <div class="min-w-0 flex-auto">
                  <p class="text-sm font-semibold leading-6 text-gray-900">
                    {{ role.name }}
                  </p>
                  <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                    Role
                  </p>
                </div>
              </div>
              <div class="hidden sm:flex sm:flex-col sm:items-end">
                <div class="mt-1 flex items-center gap-x-1.5">
                  <div class="flex-none">
                    <UpdateRoleForm :permissions="permissions" :role="role" />
                  </div>
                  <div class="flex-none">
                    <DeleteRoleForm :role="role" />
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </Tab>
      <Tab title="Permissions">
        <div v-if="!permissions.length">
          <ListEmptyMessage
            message-title="Vous n'avez pas de permissions créés"
            message-content="Commencez par ajouter une nouvelle permission"
          >
            <IconButton class="mt-6" text="Ajouter une permission">
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
          </ListEmptyMessage>
        </div>
        <div v-else>
          <div class="flex flex-row my-7 place-content-between">
            <h1 class="font-bold text-primary self-center">
              Gérez vos permissions
            </h1>
            <IconButton
              class="text-right shrink-0 place-self-end"
              text="Ajouter une permission"
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
          </div>
          <ul role="list" class="divide-y divide-gray-100">
            <li
              v-for="permission in permissions"
              :key="permission.id"
              class="flex justify-between gap-x-6 py-5"
            >
              <div class="flex gap-x-4">
                <img
                  class="h-12 w-12 flex-none rounded-full bg-gray-50"
                  alt=""
                />
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
                    <button class="rounded-lg bg-primary p-3 text-white">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                        />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </Tab>
    </Tabs>
  </DemLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage, Head, router } from "@inertiajs/vue3";
import DemLayout from "@/Layouts/DemLayout.vue";
import Tabs from "@/Components/Molecules/Tabs.vue";
import Tab from "@/Components/Atoms/Tab.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import CreateRoleFrom from "@/Components/Organisms/CreateRoleFrom.vue";
import UpdateRoleForm from "@/Components/Organisms/UpdateRoleForm.vue";
import DeleteRoleForm from "@/Components/Organisms/DeleteRoleForm.vue";
import InviteUserForm from "@/Components/Organisms/InviteUserForm.vue";
import TeamMembersList from "@/Components/Organisms/TeamMembersList.vue";

router.reload({ only: ["teamMembres"] });

defineProps({
  roles: Array,
  permissions: Array,
  teamMembres: Array,
});

const inviteUserModal = ref(false);

const openInviteUserModal = () => {
  inviteUserModal.value = true;
};

const closeModal = () => {
  inviteUserModal.value = false;
};
</script>