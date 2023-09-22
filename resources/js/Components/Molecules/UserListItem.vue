<template>
<div class="flex flex-grow flex-nowrap px-6 py-4 rounded-xl border border-gray-300 bg-white text-sm md:text-xs hover:bg-secondary">
        <div class="lg:w-1/12 min-w-1/12 my-auto">
          <input
            name=""
            type="checkbox"
            class="form-checkbox rounded-md text-primary h-5 w-5 focus:ring-0"
          />
        </div>
        <div class="flex gap-3 text-left justify-center w-2/12 my-auto">
          <div class="text-sm">
            <div class="text-center">
                <span class="font-bold text-primary cursor-pointer underline">
                {{props.users.first_name }} {{  props.users.last_name }}
                </span>
            </div>

          </div>
        </div>

        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="text-center">
                <div class="font-medium text-gray-700 w-full">
                  {{
                    props.users.email
                  }}
                </div>
                <div class="text-gray-400">Tél:
                    {{props.users.phone_number }}
                </div>
            </div>
        </div>
        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="flex gap-2 justify-center">
                <div class="text-center">
                    <span
                        v-for="(role, index) in props.users.roles"
                        :key="index"
                        class="text-left rounded-full text-white w-fit px-2.5 py-1 my-auto"
                        :class="[
                            role.name === 'admin' ? 'bg-green-600' : '',
                            role.name === 'sales' ? 'bg-red-300' : '',
                            role.name === 'lead-operator' ? 'bg-gray-400' : '',
                            role.name === 'operator' ? 'bg-fuchsia-600' : '',
                            ]">
                        {{ role.name }}
                    </span>
                </div>

            </div>
        </div>
        <div class="flex text-left w-2/12 justify-center my-auto">
            <div class="text-center">
                {{props.users.organization.name}}
            </div>
        </div>
        <!-- <div class="flex text-left w-2/12 justify-center my-auto">
          <span
            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
          >
            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
            source
          </span>
        </div> -->
        <!-- <div class="w-1/12 my-auto">
          <div class="flex justify-end gap-4">

          </div>
        </div> -->
      </div>
  </template>

    <script setup>
  import { Dropdown } from "floating-vue";
  import { router } from "@inertiajs/vue3";
  import { formatDate } from "@/utils";
  import { ref } from "vue";
  const emit = defineEmits(["toggle-selected-all"]);
  const props = defineProps({
    users: {
      required: true,
    },
  });


  </script>

  <style scoped>
  .truncate-off {
    white-space: normal !important;
    overflow: visible !important;
    width: auto !important;
    text-overflow: clip !important;
  }

  /* Optional: You might want to add a background and some padding when hovering */
  .hover-group:hover .truncate-off {
    background-color: rgba(0, 0, 0, 0.8);
    padding: 0.5rem;
    border-radius: 0.25rem;
  }
  </style>
