<template>
  <div>
    <ul class="flex flex-wrap border-b border-gray-200 divide-x">
      <li
        v-for="title in tabTitles"
        :key="title"
        @click="selectedTitle = title"
        class="mr-4 text-primary hover:font-bold hover:underline hover:border-t-2"
        :class="[
          selectedTitle == title
            ? 'font-bold underline border-t-2'
            : 'font-medium',
        ]"
      >
        <a
          href="#"
          aria-current="page"
          class="inline-block bg-gray-100 rounded-t-lg py-4 px-4 text-sm text-center active"
          >{{ title }}</a
        >
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