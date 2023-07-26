<template>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <h3 class="text-lg font-medium leading-6 text-neutral-900">
          Formules de déménagement
        </h3>
        <p class="mt-1 text-sm text-neutral-600">
          Paramètrage des formules de déménagement.
        </p>
      </div>
      <div class="mt-5 md:col-span-2 md:mt-0 flex flex-col space-y-3">
        <div
          v-for="(formula, index) in formulas"
          :key="index"
          class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6"
        >
          <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl">
            {{ formula.name }}
          </h5>
          <p class="text-sm font-normal text-gray-500">À notre charge</p>
          <ul class="my-4 space-y-3">
            <li
              v-for="(option, index) in getOptionByType(
                formula.options,
                'organization-side'
              )"
              :key="index"
            >
              <a
                href="#"
                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>

                <span class="flex-1 ml-3 whitespace-nowrap">{{
                  option.text
                }}</span>
              </a>
            </li>
          </ul>

          <p class="text-sm font-normal text-gray-500">À la charge du client</p>
          <ul class="my-4 space-y-3">
            <li
              v-for="(option, index) in getOptionByType(
                formula.options,
                'client-side'
              )"
              :key="index"
            >
              <a
                href="#"
                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>

                <span class="flex-1 ml-3 whitespace-nowrap">{{
                  option.text
                }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";

const formulas = usePage().props.formulas;

const getOptionByType = (options, type) => {
  return options.filter((obj) => {
    return obj.type === type;
  });
};
</script>
