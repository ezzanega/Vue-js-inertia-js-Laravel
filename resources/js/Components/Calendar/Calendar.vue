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
        <EventModal :openModal="openModal" :event="eventData" @closeModal="openModal=!openModal" @createEvent="createEvent" />
    </div>
</template>

<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import frLocale from '@fullcalendar/core/locales/fr';
import { INITIAL_EVENTS, createEventId } from '@/utils/event-utils'
import EventModal from "@/Components/Calendar/EventModal.vue";
import { onMounted, ref } from 'vue';

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
    initialEvents: INITIAL_EVENTS,
    weekends: true,
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    locale: frLocale,
    timeZone: 'Europe/Paris', 
    datesSet: function(dateInfo) {
        const start = dateInfo.startStr;
        const end = dateInfo.endStr;
        const calendarApi = dateInfo.view.calendar;
        axios.get(route("6dem.calendar.events"), {
            params: { start, end }
        }).then(response => {
            console.log(response)
            calendarApi.removeAllEvents();
            response.data.forEach(event => {
                calendarApi.addEvent({
                    id: event.id,
                    title: event.title,
                    start: event.start,
                    end: event.end,
                    allDay: event.all_day,
                    details: event.details
                });
            });
        });
    },
})
const currentEvents = ref([]);
const openModal = ref(false);
const eventData = ref(null);

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
        initialEvents: INITIAL_EVENTS,
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
    let calendarApi = selectInfo.view.calendar;
    calendarApi.unselect();

    eventData.value = {
        start: selectInfo.startStr,
        end: selectInfo.endStr,
        all_day: selectInfo.allDay
    };

    // console.log(eventData.value)

    openModal.value = true;

    // let title = prompt('Please enter a new title for your event');
    // let details = prompt('Please enter details for your event');

    // if (title) {
    //     const eventData = {
    //         title,
    //         details,
    //         start: selectInfo.startStr,
    //         end: selectInfo.endStr,
    //         all_day: selectInfo.allDay
    //     };
    //     axios.post(route("6dem.calendar.create.events"), eventData).then(response => {
    //         calendarApi.addEvent({
    //             id: response.data.id,
    //             title: response.data.title,
    //             details: response.data.details,
    //             start: response.data.start,
    //             end: response.data.end,
    //             allDay: response.data.all_day
    //         });
    //     });
    // }
}

const createEvent = (event) => {
    calendarApi.addEvent(event);
}

const handleEventClick = (clickInfo) => {
  const popover = document.getElementById('eventPopover');
  const titleElement = document.getElementById('popoverTitle');
  const bodyElement = document.getElementById('popoverBody');
  titleElement.textContent = clickInfo.event.title;
  const details = clickInfo.event.extendedProps.details;
  bodyElement.textContent = `Détails: ${details}`;
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