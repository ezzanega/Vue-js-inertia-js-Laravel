<template>
  <div>
    <IconButton
      @click="confirmDevisCreation"
      class="mt-6"
      text="Créer un devis"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="2.2"
        stroke="currentColor"
        aria-hidden="true"
        class="pointer-events-none shrink-0 w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M12 4.5v15m7.5-7.5h-15"
        />
      </svg>
    </IconButton>
    <Modal :show="clientSelectionModal" @close="closeModal">
      <div class="w-full p-6 flex flex-col space-y-2">
        <div class="mt-2 border-b border-gray-200 divide-x">
          <p class="text-lg ml-2 font-semibold leading-6 text-gray-900">
            Créer un devis
          </p>
        </div>

        <div class="w-full">
          <div>
            <Dropdown
              :triggers="[]"
              :shown="searching"
              :autoHide="false"
              placement="bottom"
            >
              <SearchBar
                :required="true"
                name="client"
                v-model="searchQuery"
                class="shrink mt-1"
                placeholder="Recherchez un nom de client"
              />
              <template #popper>
                <div class="w-full" style="width: 624px">
                  <div class="bg-white rounded-md w-full">
                    <ul class="max-h-80 overflow-y-auto" role="listbox">
                      <li
                        v-for="(client, index) in searchResults"
                        role="option"
                        :key="index"
                      >
                        <a
                          href="#"
                          @click="selectClient(client)"
                          class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-secondary hover:text-neutral-900"
                        >
                          <div class="flex flex-col">
                            <span class="">{{
                              client.type == "professional"
                                ? client.client_organization.name +
                                  " (" +
                                  client.client_organization.siren +
                                  ")"
                                : client.first_name + " " + client.last_name
                            }}</span>
                            <span class="">{{ client.email }}</span>
                          </div>
                        </a>
                      </li>
                      <li v-if="!searchResults.length">
                        <span
                          href="#"
                          class="group block px-4 py-2 text-sm text-neutral-700 hover:bg-secondary hover:text-neutral-900"
                        >
                          Aucun client ne correspond à vos critères de recherche
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </template>
            </Dropdown>
          </div>

          <div v-if="selectedClient" class="mt-2">
            <a
              class="group block px-4 py-2 text-sm text-neutral-700 rounded-md bg-secondary hover:text-neutral-900"
            >
              <div class="flex flex-col">
                <span>{{
                  selectedClient.type == "professional"
                    ? selectedClient.client_organization.name +
                      " (" +
                      selectedClient.client_organization.siren +
                      ")"
                    : selectedClient.first_name + " " + selectedClient.last_name
                }}</span>
                <span>{{ selectedClient.email }}</span>
              </div>
            </a>
          </div>

          <div class="mt-5 pt-8 flex justify-end space-x-4">
            <SecondaryButton @click="closeModal"> Annuler </SecondaryButton>
            <DefaultButton
              @click="initQuatation"
              class="w-32"
              :disabled="selectedClient == null"
              buttontext="Valider"
            />
          </div>
        </div>
      </div>
    </Modal>
  </div>
</template>
  
<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import IconButton from "@/Components/Atoms/IconButton.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import SearchBar from "@/Components/Atoms/SearchBar.vue";
import { Dropdown } from "floating-vue";
import { ref, watch } from "vue";
import axios from "axios";
import debounce from "lodash/debounce";

const searchQuery = ref("");
const searchResults = ref([]);
const searching = ref(false);
const selectedClient = ref(null);
const clientSelectionModal = ref(false);

const closeModal = () => {
  clientSelectionModal.value = false;
};

const confirmDevisCreation = () => {
  clientSelectionModal.value = true;
};

watch(searchQuery, (newQuery) => {
  debouncedFetchResults(newQuery);
});

const search = async () => {
  searching.value = true;
  try {
    const result = await axios.get(
      route("6dem.search.clients") + "?search_text=" + searchQuery.value
    );
    searchResults.value = result.data;
  } catch (e) {
    console.log('error');
  }
};

const selectClient = async (client) => {
  selectedClient.value = client;
  searching.value = false;
  searchResults.value = [];
};

const debouncedFetchResults = debounce(search, 300);

const initQuatation = () => {
  router.visit(
    route("6dem.documents.quotation.init", selectedClient.value.id),
    {
      method: "post",
      replace: true
    }
  );
};
</script>