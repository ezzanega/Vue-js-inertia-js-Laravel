<template>
  <form
    class="w-screen sm:max-w-2xl"
  >
    <!-- <div class="flex h-full flex-col divide-y divide-neutral-200 bg-white shadow-xl">
      <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6">
        <div class="px-4 sm:px-6">
          <div class="flex items-start justify-between">
            <div class="space-y-1">
              <h2
                id="headlessui-dialog-title-15"
                data-headlessui-state="open"
                class="text-lg font-medium text-neutral-700"
              >
                Create Deal
              </h2>
            </div><div class="ml-3 flex h-7 items-center">
              <button
                type="button"
                class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                tabindex="0"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  aria-hidden="true"
                  class="h-6 w-6"
                ><path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                /></svg>
              </button>
            </div>
          </div>
        </div><div class="relative mt-8 flex-1 px-4 sm:px-6">
          <div>
            <div class="">
              <div class="grid grid-cols-12 gap-x-4">
                <div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="name-floating"
                      ><span class="mr-1 text-sm text-danger-600">*</span><span>Deal Name</span></label><div class="relative">
                        <input
                          id="name-floating"
                          type="text"
                          class="form-input rounded-md border-neutral-300"
                        >
                      </div>
                    </div>
                  </div>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="pipeline_id-floating"
                      ><span class="mr-1 text-sm text-danger-600">*</span><span>Pipeline</span></label><div
                        class="v-popper w-full v-popper--theme-dropdown"
                        name="pipeline_id"
                      >
                        <div
                          class="px-3 py-2 border border-neutral-300 rounded-md relative w-full bg-white text-left text-sm shadow-sm cs--single cs--searchable"
                          data-v-e34b7ef6=""
                        >
                          <div
                            class="flex items-center"
                            data-v-e34b7ef6=""
                          >
                            <div
                              id="cs13__combobox"
                              class="flex items-center cursor-text"
                              role="combobox"
                              aria-expanded="false"
                              aria-owns="cs13__listbox"
                              aria-label="Search for an option"
                              data-v-e34b7ef6=""
                            >
                              <div
                                class=""
                                data-v-e34b7ef6=""
                              >
                                <span
                                  class=""
                                  data-v-e34b7ef6=""
                                >Sales Pipeline</span>
                              </div>
                            </div><div
                              class="mr-4 grow"
                              data-v-e34b7ef6=""
                            >
                              <input
                                id="pipeline_id-floating"
                                class="!w-0 max-w-full border-0 p-0 text-sm leading-none focus:border-0 focus:ring-0 disabled:bg-neutral-200 cs__search"
                                aria-autocomplete="list"
                                aria-labelledby="cs13__combobox"
                                aria-controls="cs13__listbox"
                                type="search"
                                autocomplete="off"
                                data-v-e34b7ef6=""
                              >
                            </div><div
                              class="inline-flex"
                              data-v-e34b7ef6=""
                            >
                              <button
                                type="button"
                                class="mr-1 text-neutral-400 hover:text-neutral-600"
                                title="Clear Selected"
                                aria-label="Clear Selected"
                                data-v-e34b7ef6=""
                                style="display: none;"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="shrink-0 text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"
                                /></svg>
                              </button><div data-v-e34b7ef6="">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                /></svg>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="stage_id-floating"
                      ><span class="mr-1 text-sm text-danger-600">*</span><span>Stage</span></label><div
                        class="v-popper w-full v-popper--theme-dropdown"
                        name="stage_id"
                      >
                        <div
                          class="px-3 py-2 border border-neutral-300 rounded-md relative w-full bg-white text-left text-sm shadow-sm cs--single cs--searchable"
                          data-v-e34b7ef6=""
                        >
                          <div
                            class="flex items-center"
                            data-v-e34b7ef6=""
                          >
                            <div
                              id="cs14__combobox"
                              class="flex items-center cursor-text"
                              role="combobox"
                              aria-expanded="false"
                              aria-owns="cs14__listbox"
                              aria-label="Search for an option"
                              data-v-e34b7ef6=""
                            >
                              <div
                                class=""
                                data-v-e34b7ef6=""
                              >
                                <span
                                  class=""
                                  data-v-e34b7ef6=""
                                >Qualified To Buy</span>
                              </div>
                            </div><div
                              class="mr-4 grow"
                              data-v-e34b7ef6=""
                            >
                              <input
                                id="stage_id-floating"
                                class="!w-0 max-w-full border-0 p-0 text-sm leading-none focus:border-0 focus:ring-0 disabled:bg-neutral-200 cs__search"
                                aria-autocomplete="list"
                                aria-labelledby="cs14__combobox"
                                aria-controls="cs14__listbox"
                                type="search"
                                autocomplete="off"
                                data-v-e34b7ef6=""
                              >
                            </div><div
                              class="inline-flex"
                              data-v-e34b7ef6=""
                            >
                              <button
                                type="button"
                                class="mr-1 text-neutral-400 hover:text-neutral-600"
                                title="Clear Selected"
                                aria-label="Clear Selected"
                                data-v-e34b7ef6=""
                                style="display: none;"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="shrink-0 text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"
                                /></svg>
                              </button><div data-v-e34b7ef6="">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                /></svg>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="amount-floating"
                      ><span>Amount</span></label><div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                          <span class="text-sm text-neutral-500">EUR</span>
                        </div><input
                          id="amount-floating"
                          name="amount"
                          type="tel"
                          placeholder="--"
                          class="form-input rounded-md border-neutral-300 pl-14"
                        >
                      </div>
                    </div>
                  </div><span class="-mt-2 block text-right"><a
                    href="#"
                    class="link text-sm"
                  >Add products</a><a
                    href="#"
                    class="link text-sm"
                    style="display: none;"
                  >Don't add products</a></span>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="expected_close_date-floating"
                      ><span>Expected Close Date</span></label><div>
                        <div class="">
                          <div class="rounded-md relative shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                aria-hidden="true"
                                class="h-5 w-5 text-neutral-500"
                              ><path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"
                              /></svg>
                            </div><input
                              id="expected_close_date-floating"
                              type="text"
                              class="form-input border-neutral-300 rounded-md pl-11"
                              autocomplete="off"
                              name="expected_close_date"
                            ><svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                              aria-hidden="true"
                              class="absolute right-3 top-2.5 h-5 w-5 cursor-pointer text-neutral-400 hover:text-neutral-600"
                              style=""
                            ><path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"
                            /></svg>
                          </div>
                        </div><div
                          class="vc-popover-content-wrapper"
                          placement="bottom-start"
                        />
                      </div>
                    </div>
                  </div>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="user_id-floating"
                      ><span>Owner</span></label><div
                        class="v-popper w-full v-popper--theme-dropdown"
                        name="user_id"
                      >
                        <div
                          class="px-3 py-2 border border-neutral-300 rounded-md relative w-full bg-white text-left text-sm shadow-sm cs--single cs--searchable"
                          data-v-e34b7ef6=""
                        >
                          <div
                            class="flex items-center"
                            data-v-e34b7ef6=""
                          >
                            <div
                              id="cs15__combobox"
                              class="flex items-center cursor-text"
                              role="combobox"
                              aria-expanded="false"
                              aria-owns="cs15__listbox"
                              aria-label="Search for an option"
                              data-v-e34b7ef6=""
                            >
                              <div
                                class=""
                                data-v-e34b7ef6=""
                              >
                                <span
                                  class=""
                                  data-v-e34b7ef6=""
                                >Abdoul ZAKARI</span>
                              </div>
                            </div><div
                              class="mr-4 grow"
                              data-v-e34b7ef6=""
                            >
                              <input
                                id="user_id-floating"
                                class="!w-0 max-w-full border-0 p-0 text-sm leading-none focus:border-0 focus:ring-0 disabled:bg-neutral-200 cs__search"
                                aria-autocomplete="list"
                                aria-labelledby="cs15__combobox"
                                aria-controls="cs15__listbox"
                                type="search"
                                autocomplete="off"
                                data-v-e34b7ef6=""
                              >
                            </div><div
                              class="inline-flex"
                              data-v-e34b7ef6=""
                            >
                              <button
                                type="button"
                                class="mr-1 text-neutral-400 hover:text-neutral-600"
                                title="Clear Selected"
                                aria-label="Clear Selected"
                                data-v-e34b7ef6=""
                                style=""
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="shrink-0 text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"
                                /></svg>
                              </button><div data-v-e34b7ef6="">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                /></svg>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><div class="col-span-12">
                  <div class="mt-3 mb-1">
                    <h5 class="text-base font-medium text-neutral-800 inline-flex items-center">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                        class="mr-1.5 h-4 w-4 text-current"
                      ><path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"
                      /></svg><span>Associate with records</span>
                    </h5><p class="text-sm text-neutral-600" />
                  </div>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="companies-floating"
                      ><span>Companies</span></label><div
                        class="v-popper w-full v-popper--theme-dropdown"
                        name="companies"
                      >
                        <div
                          class="px-3 py-2 border border-neutral-300 rounded-md relative w-full bg-white text-left text-sm shadow-sm cs--searchable"
                          data-v-e34b7ef6=""
                        >
                          <div
                            class="flex items-center"
                            data-v-e34b7ef6=""
                          >
                            <div
                              id="cs16__combobox"
                              class="flex items-center cursor-text"
                              role="combobox"
                              aria-expanded="false"
                              aria-owns="cs16__listbox"
                              aria-label="Search for an option"
                              data-v-e34b7ef6=""
                            >
                              <div
                                class=""
                                data-v-e34b7ef6=""
                              />
                            </div><div
                              class="mr-4 grow"
                              data-v-e34b7ef6=""
                            >
                              <input
                                id="companies-floating"
                                class="!w-full max-w-full border-0 p-0 text-sm leading-none focus:border-0 focus:ring-0 disabled:bg-neutral-200 cs__search"
                                placeholder="Type to search..."
                                aria-autocomplete="list"
                                aria-labelledby="cs16__combobox"
                                aria-controls="cs16__listbox"
                                type="search"
                                autocomplete="off"
                                data-v-e34b7ef6=""
                              >
                            </div><div
                              class="inline-flex"
                              data-v-e34b7ef6=""
                            >
                              <button
                                type="button"
                                class="mr-1 text-neutral-400 hover:text-neutral-600"
                                title="Clear Selected"
                                aria-label="Clear Selected"
                                data-v-e34b7ef6=""
                                style="display: none;"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="shrink-0 text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"
                                /></svg>
                              </button><div data-v-e34b7ef6="">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                /></svg>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><div class="col-span-12">
                  <div class="mb-3">
                    <div>
                      <label
                        class="block text-sm font-medium text-neutral-700 mb-1 inline-flex items-center"
                        for="contacts-floating"
                      ><span>Contacts</span></label><div
                        class="v-popper w-full v-popper--theme-dropdown"
                        name="contacts"
                      >
                        <div
                          class="px-3 py-2 border border-neutral-300 rounded-md relative w-full bg-white text-left text-sm shadow-sm cs--searchable"
                          data-v-e34b7ef6=""
                        >
                          <div
                            class="flex items-center"
                            data-v-e34b7ef6=""
                          >
                            <div
                              id="cs17__combobox"
                              class="flex items-center cursor-text"
                              role="combobox"
                              aria-expanded="false"
                              aria-owns="cs17__listbox"
                              aria-label="Search for an option"
                              data-v-e34b7ef6=""
                            >
                              <div
                                class=""
                                data-v-e34b7ef6=""
                              />
                            </div><div
                              class="mr-4 grow"
                              data-v-e34b7ef6=""
                            >
                              <input
                                id="contacts-floating"
                                class="!w-full max-w-full border-0 p-0 text-sm leading-none focus:border-0 focus:ring-0 disabled:bg-neutral-200 cs__search"
                                placeholder="Type to search..."
                                aria-autocomplete="list"
                                aria-labelledby="cs17__combobox"
                                aria-controls="cs17__listbox"
                                type="search"
                                autocomplete="off"
                                data-v-e34b7ef6=""
                              >
                            </div><div
                              class="inline-flex"
                              data-v-e34b7ef6=""
                            >
                              <button
                                type="button"
                                class="mr-1 text-neutral-400 hover:text-neutral-600"
                                title="Clear Selected"
                                aria-label="Clear Selected"
                                data-v-e34b7ef6=""
                                style="display: none;"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="shrink-0 text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"
                                /></svg>
                              </button><div data-v-e34b7ef6="">
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                  aria-hidden="true"
                                  class="text-neutral-400 h-5 w-5"
                                  data-v-e34b7ef6=""
                                ><path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
                                /></svg>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><div class="shrink-0 px-4 py-4">
        <div class="flex flex-wrap justify-end space-x-3 sm:flex-nowrap">
          <button
            type="button"
            class="btn btn-white btn-md rounded-md"
          >
            Cancel
          </button><span class="relative z-0 inline-flex shadow-sm rounded-md"><button
            type="submit"
            class="btn btn-primary btn-md focus:z-10 rounded-l-md -mr-px"
          >Create</button><div class="v-popper w-full v-popper--theme-dropdown"><button
            type="button"
            class="btn btn-primary btn-md focus:z-10 rounded-r-md"
          ><svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            aria-hidden="true"
            class="h-5 w-5"
          ><path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 8.25l-7.5 7.5-7.5-7.5"
          /></svg></button></div></span>
        </div>
      </div>
    </div> -->
  </form>
</template>