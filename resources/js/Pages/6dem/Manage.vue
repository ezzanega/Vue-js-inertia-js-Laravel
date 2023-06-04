<template>
  <Head title="Gestion" />
  <DemLayout>
	<Tabs>
  	<Tab title="Roles">
      <div v-if="!roles">
        <ListEmptyMessage
        message-title="Vous n'avez pas de roles créés"
        message-content="Commencez par ajouter un nouveau role"
        >
          <IconButton
            class="mt-6"
            text="Créer un role"
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
        </ListEmptyMessage>
      </div>
      <div v-else>
        <ul role="list" class="divide-y divide-gray-100">
          <li v-for="role in roles" :key="role.id" class="flex justify-between gap-x-6 py-5">
            <div class="flex gap-x-4">
              <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-gray-900">{{ role.name }}</p>
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
          <IconButton
            class="mt-6"
            text="Créer une permission"
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
        </ListEmptyMessage>
      </div>
      <div v-else>
        <ul role="list" class="divide-y divide-gray-100">
          <li v-for="permission in permissions" :key="permission.id" class="flex justify-between gap-x-6 py-5">
            <div class="flex gap-x-4">
              <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold leading-6 text-gray-900">{{ permission.name }}</p>
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
  import DemLayout from '@/Layouts/DemLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import Tabs from '@/Components/Molecules/Tabs.vue';
  import Tab from '@/Components/Atoms/Tab.vue';
  import ListEmptyMessage from '@/Components/Organisms/ListEmptyMessage.vue';
  import IconButton from '@/Components/Atoms/IconButton.vue';

  defineProps({ 
    roles: Array, 
    permissions: Array
  })
</script>