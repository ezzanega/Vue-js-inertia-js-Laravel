<template>
  <div class="flex flex-col space-y-2 text-sm">
    <div
      v-for="(appointment, index) in nextMeetings"
      :key="index"
      class="flex p-2 border-l-4 border-primary"
    >
      <div class="space-y-1">
        <div class="text-sm leading-5 w-72">
          {{ appointment.title }} - {{  formatDate(appointment.start) + ' ' +  formatTime(appointment.start) + ' à ' + formatTime(appointment.end) }}
        </div>
      </div>
    </div>
    <div class="mx-auto">
      <IconButton customClass="m" @click="router.visit('/6dem/calendar', { replace: true })"  text="Voir dans l'agenda"> </IconButton>
    </div>
  </div>
</template>

<script setup>
import IconButton from "@/Components/Atoms/IconButton.vue";
import { router, usePage } from "@inertiajs/vue3";
import { formatTime, formatDate } from "@/utils/index";

const nextMeetings = usePage().props.nextMeetings
</script>