<template>
  <div class="relative inline-block px-3 text-left">
    <div class="w-full">
      <button
        type="button"
        class="group mt-3 w-full rounded-md bg-secondary px-2.5 py-1.5 text-left text-sm font-medium text-neutral-700 focus:outline-none focus:ring-none hover:bg-secondary"
      >
        <span class="flex w-full items-center justify-between"
          ><span class="flex min-w-0 items-center justify-between space-x-3"
            ><img
              class="inline-block rounded-full h-8 w-8"
              src="https://www.gravatar.com/avatar/895f41a72665bbb3ed93a26410b67abf?s=40"
              :title="fullName"
            /><span class="flex min-w-0 flex-1 flex-col"
              ><span class="truncate text-xs font-medium text-neutral-800">{{
                fullName
              }}</span
              ><span class="truncate text-xs text-neutral-600">{{
                email
              }}</span></span
            ></span
          ><svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            aria-hidden="true"
            class="h-5 w-5 shrink-0 text-neutral-500 group-hover:text-neutral-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
            ></path>
          </svg>
        </span>
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  fullName: {
    type: String,
    default: "",
  },
  email: {
    type: String,
    default: "",
  },
});
</script>