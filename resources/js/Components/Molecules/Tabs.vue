<template>
  <div>
    <ul class="flex flex-wrap border-b border-gray-200 divide-x">
      <li
        v-for="title in tabTitles"
        :key="title"
        @click="selectedTitle = title"
        class="text-primary hover:font-bold hover:underline hover:border-t-2"
        :class="[
          selectedTitle == title
            ? 'font-bold underline border-t-2'
            : 'font-medium',
        ]"
      >
        <div class="flex space-x-1 py-4 px-4 bg-gray-100">
          <svg
            v-if="title === 'Devis'"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6 shrink-0 my-auto"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
            />
          </svg>

          <svg
            v-if="title === 'Lettres de voiture'"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 80 80"
            id="truck"
            class="h-6 w-6 shrink-0 my-auto"
          >
            <path
              fill="currentColor"
              d="M67.138 26.473a1 1 0 0 0-.707-.293H52.705v-9.033a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1v39.017a1 1 0 0 0 1 1h7.105c.493 3.767 3.717 6.689 7.616 6.689s7.123-2.922 7.616-6.689h26.9c.492 3.767 3.716 6.689 7.616 6.689s7.123-2.922 7.615-6.689H74a1 1 0 0 0 1-1V34.75a1 1 0 0 0-.293-.708l-7.57-7.569zM73 35.163v4.395H60.508V28.18h5.509L73 35.164zM50.705 18.148V44.017H7v-25.87h43.705zM7 46.017h43.705v9.147H28.337c-.493-3.767-3.716-6.688-7.616-6.688s-7.123 2.92-7.616 6.688H7v-9.147zm13.721 15.836c-3.137 0-5.688-2.552-5.688-5.689s2.551-5.688 5.688-5.688 5.689 2.551 5.689 5.688-2.552 5.689-5.689 5.689zm42.132 0c-3.137 0-5.689-2.552-5.689-5.689s2.552-5.688 5.689-5.688 5.688 2.551 5.688 5.688-2.552 5.689-5.688 5.689zm7.615-6.689c-.492-3.767-3.716-6.688-7.615-6.688s-7.124 2.92-7.616 6.688h-2.532V28.18h5.803v12.378a1 1 0 0 0 1 1H73v13.606h-2.532z"
            ></path>
            <path
              fill="currentColor"
              d="M62.853 52.26a3.908 3.908 0 0 0-3.904 3.904 3.908 3.908 0 0 0 3.904 3.903 3.907 3.907 0 0 0 3.902-3.903 3.908 3.908 0 0 0-3.902-3.903zm0 5.807c-1.05 0-1.904-.854-1.904-1.903s.854-1.903 1.904-1.903 1.902.854 1.902 1.903-.853 1.903-1.902 1.903zM20.72 52.26a3.908 3.908 0 0 0-3.903 3.903 3.907 3.907 0 0 0 3.903 3.903 3.908 3.908 0 0 0 3.904-3.903 3.908 3.908 0 0 0-3.904-3.903zm0 5.806c-1.05 0-1.903-.854-1.903-1.903s.854-1.903 1.903-1.903 1.904.854 1.904 1.903-.854 1.903-1.904 1.903zM62 44h-4a1 1 0 0 0 0 2h4a1 1 0 0 0 0-2z"
            ></path>
          </svg>

          <svg
            v-if="title === 'Facture'"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            id="bill"
            class="h-6 w-6 shrink-0 my-auto"
          >
            <path
              fill="currentColor"
              d="M13,16H7a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2ZM9,10h2a1,1,0,0,0,0-2H9a1,1,0,0,0,0,2Zm12,2H18V3a1,1,0,0,0-.5-.87,1,1,0,0,0-1,0l-3,1.72-3-1.72a1,1,0,0,0-1,0l-3,1.72-3-1.72a1,1,0,0,0-1,0A1,1,0,0,0,2,3V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM5,20a1,1,0,0,1-1-1V4.73L6,5.87a1.08,1.08,0,0,0,1,0l3-1.72,3,1.72a1.08,1.08,0,0,0,1,0l2-1.14V19a3,3,0,0,0,.18,1Zm15-1a1,1,0,0,1-2,0V14h2Zm-7-7H7a1,1,0,0,0,0,2h6a1,1,0,0,0,0-2Z"
            ></path>
          </svg>
          <a href="#" aria-current="page" class="text-md">{{ title }}</a>
        </div>
      </li>
    </ul>
    <slot />
  </div>
</template>

<script>
import { provide } from "vue";
import { ref } from "vue";
export default {
  setup(props, context) {
    const tabTitles = ref(
      context.slots.default().map((tab) => tab.props.title)
    );
    const selectedTitle = ref(tabTitles.value[0]);
    provide("selectedTitle", selectedTitle);
    return {
      selectedTitle,
      tabTitles,
    };
  },
};
</script>