<template>
  <form
    class="w-full"
  >
    <div class="px-5 flex h-full flex-col divide-y divide-neutral-200">
      <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium"
              >
                {{ title }}
              </h2>
            </div>
            <div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
                @click="$emit('closeDrawer', $event.target.value)"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  aria-hidden="true"
                  class="h-6 w-6"
                ><path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                /></svg>
              </button>
            </div>
          </div>
        </div>
        <div class="px-4 sm:px-6 mt-5">
          <slot />
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
  defineProps({
    title: {
      type: String,
      default: '',
    }
  });

</script>