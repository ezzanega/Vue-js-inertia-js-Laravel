<template>
  <div class="relative z-20 flex h-navbar shrink-0 bg-white shadow">
    <span class="h-navbar border-r border-neutral-200 lg:block" />
    <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
      <div class="flex flex-1">
        <div class="mx-8 max-w-xs py-5 lg:block">
          <h1 class="truncate font-semibold text-neutral-800">
            {{ $page.component.replace("6dem/", "") }}
          </h1>
        </div>
        <span class="h-navbar border-l border-neutral-200 lg:block">
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
        <div id="navbar-actions" class="hidden items-center lg:flex">
          <span
            class="mx-3 h-navbar border-l border-neutral-200 lg:mx-6 hidden lg:block"
          />
          <div class="inline-flex items-center">
            <!--  -->
            <a
              :href="route('6dem.account')"
              type="button"
              class="flex space-x-2 border shadow-sm rounded-md px-5 py-2 focus:outline-none hover:bg-opacity-90 text-white bg-primary"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="pointer-events-none shrink-0 w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                />
              </svg>
              <span class="font-inter">Mon compte</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Dropdown } from "floating-vue";
import AddButton from "@/Components/Atoms/AddButton.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import TopSearchBar from "@/Components/Atoms/TopSearchBar.vue";
import TopAddButtonPopperContent from "@/Components/Atoms/TopAddButtonPopperContent.vue";
import NotificationIcon from "@/Components/Atoms/NotificationIcon.vue";
</script>