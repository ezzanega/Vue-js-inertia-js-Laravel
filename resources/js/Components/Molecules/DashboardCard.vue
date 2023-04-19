<template>
  <div
    class="mb-5 break-inside-avoid"
    data-draggable="true"
    draggable="false"
  >
    <div class="relative">
      <div class="dashboard-drag-handle absolute top-5 left-2 z-10 block">
        <button
          class="cursor-move flex items-center rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-100 text-neutral-500 hover:text-neutral-700 focus:ring-primary-500"
          type="button"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            aria-hidden="true"
            class="pointer-events-none w-4 h-4"
          ><path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
          /></svg>
        </button>
      </div><div class="">
        <div class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow h-56 md:h-52">
          <!---->
          <div class="flex flex-col items-center text-lg md:flex-row">
            <div class="group truncate md:grow">
              <div class="flex items-center px-7 pt-4 md:pb-4">
                <div class="truncate">
                  <h3 class="whitespace-nowrap text-lg font-medium leading-6 text-neutral-800 truncate">
                    {{ title }}
                  </h3>
                </div><div>
                  <div class="v-popper w-auto v-popper--theme-popover">
                    <span class="mt-px ml-2 block md:hidden md:group-hover:block"><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      aria-hidden="true"
                      class="h-4 w-4 text-neutral-500 hover:text-neutral-700"
                    ><path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                    /></svg></span>
                  </div>
                </div>
              </div>
            </div><div class="flex shrink-0 space-x-2 py-2 px-3 sm:py-4 sm:px-7">
              <!----><div class="v-popper v-popper--theme-dropdown">
                <button
                  type="button"
                  class="flex w-full items-center rounded-md px-1 text-sm text-neutral-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-neutral-300 disabled:pointer-events-none disabled:opacity-60 hover:text-neutral-500"
                >
                  Filtrer<svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="ml-1 h-5 w-5"
                  ><path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                  /></svg>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div
          class="absolute inset-0 z-10"
          style="display: none;"
        >
          <div class="absolute inset-0 rounded-md bg-neutral-100 opacity-60" /><div
            class="absolute z-20"
            style="top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);"
          >
            <svg
              class="animate-spin h-5 w-5 text-primary-500"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            ><circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            /><path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            /></svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
  defineProps({
    title: {
      type: String,
      default: '',
    },
  });

</script>