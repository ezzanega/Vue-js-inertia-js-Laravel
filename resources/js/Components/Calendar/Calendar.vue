<template>
    <div class="bg-secondary">
        <FullCalendar  class="flex h-screen w-full font-sans text-sm" :options='calendarOptions' />
        <div id="eventPopover" class="popover">
            <div class="popover-header flex justify-between text-xs">
                <span id="popoverTitle" class="text-xs"></span>
                <button class="text-blue-400 font-normal underline" @click="closePopover">Fermer</button>
            </div>
            <div class="popover-body text-sm" id="popoverBody">
            </div>
        </div>
    </div>
</template>

<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale from '@fullcalendar/core/locales/fr';
import { INITIAL_EVENTS, createEventId } from '@/utils/event-utils'
import { computed, onMounted, onUnmounted, ref } from 'vue';

const calendarOptions = ref({
    plugins: [
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin // needed for dateClick
    ],
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    initialView: 'dayGridMonth',
    eventColor: '#438A7A',
    initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
    weekends: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    locale: frLocale,
    timeZone: 'Europe/Paris', 
})
const currentEvents = ref([]);

onMounted(() => {
    calendarOptions.value = {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin // needed for dateClick
        ],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        eventColor: '#438A7A',
        initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
        weekends: true,
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        locale: frLocale,
        timeZone: 'Europe/Paris', 
        select: handleDateSelect,
        eventClick: handleEventClick,
        eventsSet: handleEvents
    };
});


const handleDateSelect = (selectInfo) => {
    let title = prompt('Please enter a new title for your event')
    let calendarApi = selectInfo.view.calendar

    calendarApi.unselect() // clear date selection

    if (title) {
        calendarApi.addEvent({
            id: createEventId(),
            title,
            start: selectInfo.startStr,
            end: selectInfo.endStr,
            allDay: selectInfo.allDay
        })
    }
}

const handleEventClick = (clickInfo) => {
  const popover = document.getElementById('eventPopover');
  const titleElement = document.getElementById('popoverTitle');
  const bodyElement = document.getElementById('popoverBody');
  titleElement.textContent = clickInfo.event.title;
  bodyElement.textContent = `Starts: ${clickInfo.event.start}`;
  const rect = clickInfo.el.getBoundingClientRect();
  popover.style.left = rect.left + 'px';
  popover.style.top = (rect.top - popover.offsetHeight) + 'px';
  popover.style.display = 'block';
}

const handleEvents = (events) => {
    currentEvents.value = events
}

const closePopover = () => {
  const popover = document.getElementById('eventPopover');
  popover.style.display = 'none';
}
</script>

<style scoped>
.popover {
  position: absolute;
  display: none;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  z-index: 1000;
}

.popover-header {
  background-color: #f2f2f2;
  padding: 8px;
  border-radius: 10px 10px 0 0;
}

.popover-body {
  padding: 8px;
}

</style>