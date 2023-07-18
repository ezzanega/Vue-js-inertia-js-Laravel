<template>
  <div
    class="bg-gray-100 mx-auto border-gray-500 border rounded-sm text-gray-700 mb-0.5 h-30"
  >
    <div
      class="flex p-3 border-l-8"
      :class="[
        status === 'En cours' ? 'border-yellow-600' : '',
        status === 'Accepté' ? 'border-green-600' : '',
        status === 'Refusé' ? 'border-red-600' : '',
      ]"
    >
      <div class="space-y-1 border-r-2 pr-3">
        <div class="text-sm leading-5 font-semibold">
          <span class="text-xs leading-4 font-normal text-gray-500">
            Devis N°</span
          >
          {{ number }}
        </div>
        <div class="text-sm leading-5 font-semibold">
          <span class="text-xs leading-4 font-normal text-gray-500 pr">
            BOL #</span
          >
          {{ number }}
        </div>
        <div class="text-sm leading-5 font-semibold">{{ date }}</div>
      </div>
      <div class="flex-1">
        <div class="ml-3 space-y-1 border-r-2 pr-3">
          <div class="text-base leading-6 font-normal">
            <span class="text-xs leading-4 font-normal text-gray-500">
              Client:</span
            >
            {{ client }}
          </div>
          <div class="text-sm leading-4 font-normal">
            <span class="text-xs leading-4 font-normal text-gray-500">
              Prix HT</span
            >
            {{ prixHT }}
          </div>
          <div class="text-sm leading-4 font-normal">
            <span class="text-xs leading-4 font-normal text-gray-500">
              Prix TTC</span
            >
            {{ prixTTC }}
          </div>
        </div>
      </div>
      <div class="border-r-2 pr-3">
        <div>
          <div class="ml-3 my-3 border-gray-200 border-2 p-1">
            <div class="uppercase text-xs leading-4 font-medium">Devis</div>
            <div
              class="text-center text-sm leading-4 font-semibold text-gray-800"
            >
              {{ prixTTC }}
            </div>
          </div>
        </div>
      </div>
      <div>
        <div
          class="ml-3 my-5 p-1 w-20"
          :class="[
            status === 'En cours' ? 'bg-yellow-600' : '',
            status === 'Accepté' ? 'bg-green-600' : '',
            status === 'Refusé' ? 'bg-red-600' : '',
          ]"
        >
          <div
            class="uppercase text-xs leading-4 font-semibold text-center text-yellow-100"
          >
            {{ status }}
          </div>
        </div>
      </div>
      <div>
        <button
          class="text-gray-100 rounded-sm my-5 ml-2 focus:outline-none bg-gray-500 px-1"
        >
          <svg
            class="h-6 w-6"
            style="enable-background: new 0 0 16 16"
            version="1.1"
            viewBox="0 0 16 16"
            xml:space="preserve"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
          >
            <path
              fill="currentColor"
              d="M2,6C0.896,6,0,6.896,0,8s0.896,2,2,2s2-0.896,2-2S3.104,6,2,6z M8,6C6.896,6,6,6.896,6,8s0.896,2,2,2s2-0.896,2-2  S9.104,6,8,6z M14,6c-1.104,0-2,0.896-2,2s0.896,2,2,2s2-0.896,2-2S15.104,6,14,6z"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  client: {
    type: String,
    default: "",
  },

  number: {
    type: String,
    default: "",
  },

  date: {
    type: String,
    default: "",
  },

  prixHT: {
    type: String,
    default: "",
  },

  prixTTC: {
    type: String,
    default: "",
  },

  status: {
    type: String,
    default: "",
  },
});
</script>