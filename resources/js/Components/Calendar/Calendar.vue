<template>
    <div class="bg-secondary">
        <FullCalendar ref="calendarRef" class="flex h-screen w-full font-sans text-sm" :options='calendarOptions' />
        <EventCreationForm 
            :openModal="showEventCreationModal"
            :event="eventData"
            @createEvent="createEvent"
            @closeModal="closeEventCreationModal"
        />
        <EventDetails 
            :openModal="showEventDeatilsModal"
            :event="eventData"
            @createEvent="createEvent"
            @closeModal="closeEventDetailsModal"
        />
    </div>
</template>

<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale from '@fullcalendar/core/locales/fr';
import EventCreationForm from "@/Components/Calendar/EventCreationForm.vue";
import EventDetails from "@/Components/Calendar/EventDetails.vue";
import { ref } from 'vue';

const calendarRef = ref(null);
const currentEvents = ref([]);
const showEventCreationModal = ref(false);
const showEventDeatilsModal = ref(false);
const eventData = ref(null);
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
    initialView: 'timeGridWeek',
    eventColor: '#438A7A',
    weekends: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    locale: frLocale,
    timeZone: 'Europe/Paris', 
    datesSet: (dateInfo) => {
        const start = dateInfo.startStr;
        const end = dateInfo.endStr;
        const calendarApi = dateInfo.view.calendar;
        axios.get(route("6dem.calendar.events"), {
            params: { start, end }
        }).then(response => {
            calendarApi.removeAllEvents();
            response.data.forEach(event => {
                calendarApi.addEvent({
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    allDay: event.all_day,
                    details: event.details,
                    backgroundColor: event.color,
                });
            });
        });
    },
    select: (selectInfo) => {
        let calendarApi = selectInfo.view.calendar;
        calendarApi.unselect();

        eventData.value = {
            start: selectInfo.startStr,
            end: selectInfo.endStr,
            all_day: selectInfo.allDay
        };

        showEventCreationModal.value = true;
    },
    eventClick:  (clickInfo) => {
        eventData.value = {
            title: clickInfo.event.title,
            details: clickInfo.event.extendedProps.details,
            start: clickInfo.event.startStr,
            end: clickInfo.event.endStr,
            color: clickInfo.event.backgroundColor,
            all_day: clickInfo.event.allDay
        };
        showEventDeatilsModal.value = true;
    },
    eventsSet: (events) => {
        currentEvents.value = events
    }
})

const createEvent = (event) => {
    const calendarApi = calendarRef.value.getApi();
    calendarApi.addEvent({
        id: event.id,
        title: event.title,
        details: event.details,
        start: event.start,
        end: event.end,
        allDay: event.all_day,
        backgroundColor: event.color,
    });
    closeEventCreationModal();
}

const closeEventCreationModal = () => {
    showEventCreationModal.value =!showEventCreationModal.value;
}

const closeEventDetailsModal = () => {
    showEventDeatilsModal.value =!showEventDeatilsModal.value;
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