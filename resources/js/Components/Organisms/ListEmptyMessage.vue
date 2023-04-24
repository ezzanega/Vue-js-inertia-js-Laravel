<template>
  <div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="sm:py-4">
        <div class="">
          <div class="mb-4 flex justify-end lg:hidden">
            <span class="mx-3 h-navbar border-l border-neutral-200 lg:mx-6 hidden lg:block" />
            <div class="inline-flex items-center">
              <div class="mr-3 lg:mr-6">
                <div class="v-popper v-popper--theme-dropdown">
                  <button
                    class="flex items-center rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-100 text-neutral-500 hover:text-neutral-700 focus:ring-primary-500"
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
                </div>
              </div><span class="i-button-group relative z-0 inline-flex rounded-md shadow-sm mr-5">
                <button
                  type="button"
                  class="btn btn-white btn-sm rounded only-icon relative bg-neutral-100 focus:z-10 v-popper--has-tooltip"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="pointer-events-none shrink-0 w-4 h-4 text-neutral-700"
                  ><path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                  /></svg>
                </button>
                <button
                  type="button"
                  class="btn btn-white btn-sm rounded only-icon relative focus:z-10 v-popper--has-tooltip"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="pointer-events-none shrink-0 w-4 h-4 text-neutral-500"
                  ><path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z"
                  /></svg>
                </button>
              </span>
              <button
                type="button"
                class="btn bg-primary btn-sm rounded"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  aria-hidden="true"
                  class="pointer-events-none shrink-0 h-4 w-4 -ml-1 mr-2"
                ><path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15"
                />
                </svg>
                Create Deal
              </button>
            </div>
          </div>
          <div class="m-auto mt-8 max-w-5xl">
            <div class="grid place-items-center">
              <svg
                class="mx-auto h-12 w-12 text-neutral-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              ><path
                vector-effect="non-scaling-stroke"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"
              /></svg>
              <h3 class="mt-2 text-sm font-medium text-neutral-800">
                {{ messageTitle }}
              </h3>
              <p class="mt-1 text-sm text-neutral-500">
                {{ messageContent }}
              </p>
              <slot />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  defineProps({
    messageTitle: {
      type: String,
      default: '',
    },
    messageContent: {
      type: String,
      default: '',
    },
  })
</script>