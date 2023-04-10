<template>
  <div class="relative w-full text-neutral-400 focus-within:text-neutral-600">
    <div class="pointer-events-none absolute inset-y-0 left-6 flex items-center">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        fill="currentColor"
        aria-hidden="true"
        class="h-5 w-5"
      >
        <path
          fill-rule="evenodd"
          d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
          clip-rule="evenodd"
        />
      </svg>
    </div>
    <input
      id="nav-search"
      autocomplete="off"
      class="peer block h-full w-full appearance-none border-transparent py-2 pl-14 pr-3 text-neutral-900 placeholder-neutral-500 focus:border-transparent focus:placeholder-neutral-400 focus:outline-none focus:ring-0"
      placeholder="Search..."
      type="search"
      name="search"
    >
  </div>
</template>
