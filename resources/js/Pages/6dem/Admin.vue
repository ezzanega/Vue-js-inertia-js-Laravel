<template>
    <Head title="Admin" />
    <DemLayout>
        <div class="overflow-hidden space-y-2">
            <div class="flex flex-row items-center justify-between mt-5">
                <SearchBar name="client" class="w-1/3 mx-1 mt-1 shrink"  placeholder="Recherchez un nom d'utilisateur" />
                <div class="flex flex-row items-center space-x-2">
                  <IconButton  class="mt-6" text="Créer un utilisateur">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="2.2"
                      stroke="currentColor"
                      aria-hidden="true"
                      class="w-6 h-6 pointer-events-none shrink-0"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                      />
                    </svg>
                  </IconButton>

                  <IconButton class="mt-6" :customClass="'text-primary bg-white'" text="Exporter">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                      class="w-5 h-5 pointer-events-none shrink-0">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                    </svg>

                  </IconButton>
                </div>
            </div>

            <div
            class="flex  w-full px-6 py-4 text-sm font-medium text-left text-gray-900 bg-white border-b border-gray-200 rounded-xl">
            <div class="w-1/12">
                <input name="" type="checkbox"
                  class="w-5 h-5 rounded-md form-checkbox text-primary focus:ring-0"/>
            </div>
            <div class="flex flex-row items-center justify-center w-2/12 text-center">Nom
            </div>
            <div class="flex flex-row items-center justify-center w-2/12 text-center">Email
            </div>
            <div class="flex flex-row items-center justify-center w-2/12 text-center">Role
            </div>
            <div class="flex flex-row items-center justify-center w-2/12 text-center">Organisation
            </div>
            <!-- <div class="flex flex-row items-center justify-center w-2/12 text-center">Source
            </div> -->
            <!-- <div class="w-1/12"></div> -->
        </div>

            <div class="space-y-2 w-auto">
                <UserListItem v-for="(users, index) in usePage().props.usersWithOrganizations" :key="index" :users="users" />
            </div>
        </div>
    </DemLayout>
  </template>

  <script setup>

  import DemLayout from "@/Layouts/DemLayout.vue";
  import UserListItem from "@/Components/Molecules/UserListItem.vue";
  import SearchBar from "@/Components/Atoms/SearchBar.vue";
  import IconButton from "@/Components/Atoms/IconButton.vue";
  import { Head, usePage } from "@inertiajs/vue3";
  import { ref } from "vue";
  import { router } from '@inertiajs/vue3';
  </script>
