<template>
  <Head title="Gestion" />
  <DemLayout>
    <Tabs>
      <Tab title="Roles">
        <div v-if="!roles">
          <ListEmptyMessage message-title="Vous n'avez pas de roles créés"
            message-content="Commencez par ajouter un nouveau role">
            <IconButton class="mt-6" text="Ajouter un role">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
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
            <li v-for="role in roles" :key="role.id" class="flex justify-between gap-x-6 py-5">
              <div class="flex gap-x-4">
                <img class="h-12 w-12 flex-none rounded-full bg-gray-50" alt="" />
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
                    <button class="rounded-lg bg-primary p-3 text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>
                    </button>
                  </div>
                  <div class="flex-none">
                    <button class="rounded-lg bg-primary p-3 text-white">
                      <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5"
                        stroke="currentColor" 
                        class="w-4 h-4">
                        <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round"
                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </Tab>
      <Tab title="Permissions">
        <div v-if="!permissions.length">
          <ListEmptyMessage message-title="Vous n'avez pas de permissions créés"
            message-content="Commencez par ajouter une nouvelle permission">
            <IconButton class="mt-6" text="Ajouter une permission">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
            </IconButton>
          </ListEmptyMessage>
        </div>
        <div v-else>
          <div class="flex flex-row my-7 place-content-between">
            <h1 class="font-bold text-primary self-center">
              Gérez vos permissions
            </h1>
            <IconButton class="text-right shrink-0 place-self-end" text="Ajouter une permission">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
                stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
            </IconButton>
          </div>
          <ul role="list" class="divide-y divide-gray-100">
            <li v-for="permission in permissions" :key="permission.id" class="flex justify-between gap-x-6 py-5">
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
                    <button class="rounded-lg bg-primary p-3 text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </Tab>
      <Tab title="Collaborateurs">
        <ListEmptyMessage message-title="Vous n'avez pas de collaborateurs créés"
          message-content="Commencez par ajouter un nouveau collaborateur">
          <IconButton @click="openInviteUserModal" class="mt-6" text="Ajouter un collaborateur">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2"
              stroke="currentColor" aria-hidden="true" class="pointer-events-none shrink-0 w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
          </IconButton>

          <InviteUserForm :roles="roles" :openModal="inviteUserModal" @closeModal="closeModal" />
        </ListEmptyMessage>
      </Tab>
    </Tabs>
  </DemLayout>
</template>

<script setup>
import { ref } from "vue";
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head } from "@inertiajs/vue3";
import Tabs from "@/Components/Molecules/Tabs.vue";
import Tab from "@/Components/Atoms/Tab.vue";
import ListEmptyMessage from "@/Components/Organisms/ListEmptyMessage.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import CreateRoleFrom from "@/Components/Organisms/CreateRoleFrom.vue";
import InviteUserForm from "@/Components/Organisms/InviteUserForm.vue";

defineProps({
  roles: Array,
  permissions: Array,
});

const inviteUserModal = ref(false);

const openInviteUserModal = () => {
  inviteUserModal.value = true;
};

const closeModal = () => {
  inviteUserModal.value = false;
};
</script>