<template>
  <Head title="Dashboard" />
  <DemLayout>
    <div class="py-6">
      <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:py-4">
          <div class="">
            <div class="mb-4 flex justify-end lg:hidden">
              <span class="mx-3 h-navbar border-l border-neutral-200 dark:border-neutral-600 lg:mx-6 hidden lg:block" /><div class="flex items-center space-x-3 lg:space-x-6">
                <div class="v-popper v-popper--theme-dropdown">
                  <button
                    class="flex items-center rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-100 text-neutral-500 hover:text-neutral-700 focus:ring-primary-500 dark:text-white dark:hover:text-neutral-300"
                    type="button"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      aria-hidden="true"
                      class="pointer-events-none w-5 h-5"
                    ><path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"
                    /></svg>
                  </button>
                </div><div class="v-popper min-w-0 max-w-full sm:max-w-xs v-popper--theme-dropdown">
                  <button
                    type="button"
                    class="btn btn-white btn-md rounded-md w-full"
                  >
                    <!----><!----><span class="truncate">Application Dashboard</span><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      aria-hidden="true"
                      class="-mr-1 ml-2 h-5 w-5"
                    ><path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                    /></svg>
                  </button>
                </div>
              </div>
            </div>
            <div class="before:box-inherit after:box-inherit columns-1 gap-x-6 lg:columns-2">
              <DashboardCard title="Rendez-vous" />
              <DashboardCard title="Mes taches" />
              <DashboardCard title="Mes Factures" />
              <DashboardCard title="Mes Devis" />
              <DashboardCard title="Agenda" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </DemLayout>
</template>
  
  <script setup>
  import DemLayout from '@/Layouts/DemLayout.vue';
  import DashboardCard from '@/Components/Molecules/DashboardCard.vue';
  import { Head } from '@inertiajs/vue3';
  </script>