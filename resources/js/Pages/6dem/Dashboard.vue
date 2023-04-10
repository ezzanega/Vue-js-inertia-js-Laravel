<template>
  <Head title="Dashboard" />
  <body>
    <div
      id="app"
      class="flex h-screen overflow-hidden bg-neutral-100"
    >
      <div class="hidden bg-white md:flex md:shrink-0 shadow">
        <div class="flex w-56 flex-col">
          <div class="flex grow flex-col overflow-y-auto pt-5 pb-4">
            <div class="flex shrink-0 items-center px-4 m-10">
              <a
                href="/"
                class="whitespace-normal"
              ><span class="font-bold text-primary text-xl">6dem CRM</span></a>
            </div>
            <SideBarMenu />
            <div class="group mt-8 px-2">
              <div
                class="mt-1 space-y-1"
                role="group"
                aria-labelledby="highlights-headline"
              >
                <a
                  href="#"
                  class="group flex items-center rounded-md px-3 py-2 text-sm font-medium hover:bg-secondary"
                >
                  <span
                    class="bg-primary mr-4 h-2.5 w-2.5 rounded-full"
                    aria-hidden="true"
                  />
                  <span class="mr-1 truncate">Activités</span> (0) </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex w-0 flex-1 flex-col overflow-hidden">
        <div class="relative z-20 flex h-navbar shrink-0 bg-white shadow">
          <span class="hidden h-navbar border-r border-neutral-200 lg:block" />
          <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
            <div class="flex flex-1">
              <div class="mx-8 hidden max-w-xs py-5 lg:block">
                <h1 class="truncate font-semibold uppercase text-neutral-800 ">
                  Title
                </h1>
              </div>
              <span class="hidden h-navbar border-l border-neutral-200 lg:block">
                <!--  -->
              </span>
              <div class="flex w-full sm:relative">
                <div class="relative flex w-full">
                  <!--  -->
                  <TopSearchBar />
                  <!--  -->
                </div>
              </div>
            </div>
            <div class="ml-3 flex items-center lg:ml-6">
              <span class="mx-3 h-navbar border-l border-neutral-200 lg:mx-6" />
              <div class="mr-1 lg:mr-3">
                <Dropdown placement="bottom-end">
                  <NotificationIcon />
                  <template #popper>
                    <TopAddButtonPopperContent />
                  </template>
                </Dropdown>
              </div>
              <div class="mr-1 lg:mr-3">
                <Dropdown placement="bottom-end">
                  <AddButton />
                  <template #popper>
                    <TopAddButtonPopperContent />
                  </template>
                </Dropdown>
              </div>
              <div
                id="navbar-actions"
                class="hidden items-center lg:flex"
              >
                <span class="mx-3 h-navbar border-l border-neutral-200 lg:mx-6 hidden lg:block" />
                <div class="inline-flex items-center">
                  <!--  -->
                  <IconButton />
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <main
          id="main"
          class="relative flex-1 focus:outline-none overflow-y-auto"
        >
          <div class="py-6">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
              <!-- <div class="sm:py-4" /> -->
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</template>

<script setup>
import { Dropdown } from 'floating-vue'
import AddButton from '@/Components/Atoms/AddButton.vue';
import SideBarMenu from '@/Components/Atoms/SideBarMenu.vue';
import IconButton from '@/Components/Atoms/IconButton.vue';
import TopSearchBar from '@/Components/Atoms/TopSearchBar.vue';
import TopAddButtonPopperContent from '@/Components/Atoms/TopAddButtonPopperContent.vue';
import NotificationIcon from '@/Components/Atoms/NotificationIcon.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
});
</script>