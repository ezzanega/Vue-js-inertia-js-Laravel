<template>
  <div class="flex px-6 py-4 rounded-xl border border-gray-300 bg-white">
    <div class="w-1/12 my-auto">
      <input
        name=""
        type="checkbox"
        class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0"
      />
    </div>
    <div class="flex gap-3 text-left w-3/12 my-auto">
      <div class="text-sm">
        <div class="font-medium text-gray-700">
          {{
            client.type == "professional"
              ? client.client_organization.name +
                " (" +
                client.client_organization.siren +
                ")"
              : client.first_name + " " + client.last_name
          }}
        </div>
        <div class="text-gray-400">{{ client.email }}</div>
      </div>
    </div>
    <div class="text-left w-3/12 my-auto">{{ client.phone_number }}</div>
    <div class="text-left w-3/12 my-auto">
      <div class="flex gap-2">
        <span
          v-if="client.type == 'professional'"
          class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600"
        >
          Profetionnel
        </span>
        <span
          v-else
          class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-2 py-1 text-xs font-semibold text-violet-600"
        >
          Particutier
        </span>
      </div>
    </div>
    <div class="text-left w-1/12 my-auto">
      <span
        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
      >
        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
        {{client.source}}
      </span>
    </div>
    <div class="w-1/12 my-auto">
      <div class="flex justify-end gap-4">
        <Dropdown placement="bottom-end">
          <svg
            class="h-6 w-6 cursor-pointer"
            viewBox="0 0 28 7"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M13.9449 6.06482C15.6474 6.06482 17.0276 4.70716 17.0276 3.03241C17.0276 1.35766 15.6474 0 13.9449 0C12.2424 0 10.8623 1.35766 10.8623 3.03241C10.8623 4.70716 12.2424 6.06482 13.9449 6.06482Z"
              fill="currentColor"
            />
            <path
              d="M24.8082 6.06482C26.5107 6.06482 27.8909 4.70716 27.8909 3.03241C27.8909 1.35766 26.5107 0 24.8082 0C23.1057 0 21.7256 1.35766 21.7256 3.03241C21.7256 4.70716 23.1057 6.06482 24.8082 6.06482Z"
              fill="currentColor"
            />
            <path
              d="M3.08263 6.06482C4.78513 6.06482 6.16527 4.70716 6.16527 3.03241C6.16527 1.35766 4.78513 0 3.08263 0C1.38014 0 0 1.35766 0 3.03241C0 4.70716 1.38014 6.06482 3.08263 6.06482Z"
              fill="currentColor"
            />
          </svg>
          <template #popper>
            <ClientActionsPopperContent @openMailModal="openMailModal"/>
          </template>
        </Dropdown>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Dropdown } from "floating-vue";
import ClientActionsPopperContent from "@/Components/Molecules/ClientActionsPopperContent.vue";
defineProps({
  client: {
    type: Object,
    required: true,
  },
  openMailModal:Function,
});

const emit = defineEmits(["openMailModal"]);

const openMailModal = () => {
  //isMailopen.value = true;
  emit("openMailModal");
  console.log('Client List : ' +isMailopen);
};

</script>
