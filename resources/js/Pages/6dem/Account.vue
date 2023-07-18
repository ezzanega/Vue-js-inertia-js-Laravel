<template>
  <Head title="Mon Compte" />
  <DemLayout>
    <main class="relative flex-1 focus:outline-none overflow-y-auto" id="main">
      <div class="py-6">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
          <div class="sm:py-4">
            <div class="">
              <div class="m-auto max-w-7xl">
                <UpdateAccountFrom />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdatePassword />

                <div class="hidden sm:block" aria-hidden="true">
                  <div class="py-5">
                    <div class="border-t border-neutral-200"></div>
                  </div>
                </div>

                <UpdateOrganization />
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </DemLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import DemLayout from "@/Layouts/DemLayout.vue";
import UpdateAccountFrom from "@/Components/Organisms/UpdateAccountFrom.vue";
import UpdatePassword from "@/Components/Organisms/UpdatePassword.vue";
import UpdateOrganization from "@/Components/Organisms/UpdateOrganization.vue";
</script>