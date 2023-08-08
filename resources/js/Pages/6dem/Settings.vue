<template>
  <Head title="Réglages" />
  <DemLayout>
    <main class="relative flex-1 focus:outline-none overflow-y-auto" id="main">
      <div class="py-6">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
          <div class="sm:py-4">
            <div class="">
              <div class="m-auto max-w-7xl">
                <UpdateSettingsFrom />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdateFormulas />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdateInsurances />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdateExecutingCompanies />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </DemLayout>
</template>
        
<script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import UpdateSettingsFrom from "@/Components/Settings/UpdateSettingsFrom.vue";
import UpdateFormulas from "@/Components/Settings/UpdateFormulas.vue";
import UpdateInsurances from "@/Components/Settings/UpdateInsurances.vue";
import UpdateExecutingCompanies from "@/Components/Settings/UpdateExecutingCompanies.vue";


</script>