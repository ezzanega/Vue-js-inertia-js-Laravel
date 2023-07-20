<template>
  <div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="sm:py-4">
        <div class="">
          <div class="m-auto mt-8 max-w-5xl">
            <div class="grid place-items-center">
              <svg
                class="mx-auto h-12 w-12 text-neutral-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  vector-effect="non-scaling-stroke"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"
                />
              </svg>
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
    default: "",
  },
  messageContent: {
    type: String,
    default: "",
  },
});
</script>