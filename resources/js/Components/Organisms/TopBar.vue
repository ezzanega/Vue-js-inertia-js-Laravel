<template>
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
</template>

<script setup>
import { Dropdown } from 'floating-vue'
import AddButton from '@/Components/Atoms/AddButton.vue';
import IconButton from '@/Components/Atoms/IconButton.vue';
import TopSearchBar from '@/Components/Atoms/TopSearchBar.vue';
import TopAddButtonPopperContent from '@/Components/Atoms/TopAddButtonPopperContent.vue';
import NotificationIcon from '@/Components/Atoms/NotificationIcon.vue';
</script>