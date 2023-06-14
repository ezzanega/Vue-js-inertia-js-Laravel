<template>
  <div class="relative z-20 flex h-navbar shrink-0 bg-secondary shadow">
    <span class="h-navbar border-r border-neutral-200 lg:block" />
    <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
      <div class="flex flex-1">
        <div class="mx-8 max-w-xs py-5 lg:block">
          <h1 class="text-primary truncate font-semibold text-neutral-800">
            Personnalisation du devis
          </h1>
        </div>
        <span class="h-navbar border-l border-neutral-200 lg:block">
          <!--  -->
        </span>
        <div class="mx-5 flex items-center">
          <h1 class="text-primary truncate font-semibold mx-2 text-neutral-800">
            Couleur Primaire :
          </h1>
          <ColorPicker />
        </div>
        <div class="mx-5 flex items-center">
          <h1 class="text-primary truncate font-semibold mx-2 text-neutral-800">
            Couleur Secondaire :
          </h1>
          <ColorPicker />
        </div>
      </div>
      <div class="ml-3 flex items-center lg:ml-6">
        <span class="mx-3 h-navbar border-l border-neutral-200 lg:mx-6" />
        <div class="mr-1 lg:mr-3"></div>
        <div class="mr-1 lg:mr-3">
          <Dropdown placement="bottom-end">
            <button
              type="button"
              class="text-secondary bg-primary border flex items-center rounded-md p-2 m-3 hover:bg-primary hover:bg-opacity-20 hover:text-primary"
            >
              <span class="mr-1">Templates</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
            </button>
            <template #popper>
              <div class="flex flex-col m-4">
                <button>Nord</button>
                <button>Sud</button>
              </div>
            </template>
          </Dropdown>
        </div>
        <div id="navbar-actions" class="hidden items-center lg:flex">
          <span
            class="mx-3 h-navbar border-l border-neutral-200 lg:mx-6 hidden lg:block"
          />
          <div class="inline-flex items-center"></div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import { Dropdown } from "floating-vue";
import ColorPicker from "@/Components/Atoms/ColorPicker.vue";
</script>