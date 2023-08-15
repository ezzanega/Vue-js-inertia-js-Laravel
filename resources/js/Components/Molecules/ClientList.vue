<template>
    <div class="space-y-2 overflow-hidden">
      <div class="flex flex-row items-center justify-between mt-5">
        <SearchBar name="client" class="w-1/3 mx-1 mt-1 shrink" v-model="searchQuery" placeholder="Recherchez un nom de client" />
        <div class="flex flex-row items-center space-x-2">
          <IconButton @click="toggleDrawer" class="mt-6" text="Créer un client">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="2.2"
              stroke="currentColor"
              aria-hidden="true"
              class="w-6 h-6 pointer-events-none shrink-0"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15"
              />
            </svg>
          </IconButton>
          <Drawer
            :is-open="isDrawerOpen"
            :speed="500"
            max-width="680px"
            @close="closeDrawer"
          >
            <div>
              <DrawerContent title="Create client" @closeDrawer="closeDrawer()">
                <CreateClientForm @close="closeDrawer()" />
              </DrawerContent>
            </div>
          </Drawer>

          <Drawer v-if="isDrawerUpOpen && selectedClient"
          :is-open="isDrawerUpOpen"
          :speed="500"
          max-width="680px"
          @close="closeDrawer"
          :selectedClient="selectedClient"
          :updateSearch="updateSearch"
        >
          <div>
            <DrawerContent title="Update client" :selectedClient="selectedClient" @closeDrawer="closeDrawer()" :updateSearch="updateSearch">
              <UpdateClientForm :selectedClient="selectedClient" :updateSearch="updateSearch"
              @close="closeDrawer()"/>
            </DrawerContent>
          </div>
            </Drawer>



          <IconButton class="mt-6" :customClass="'text-primary bg-white'" text="Exporter" @click="handleExportClick">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              class="w-5 h-5 pointer-events-none shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
            </svg>

          </IconButton>
        </div>
      </div>

      <div
        class="flex justify-between w-full px-6 py-4 text-sm font-medium text-left text-gray-900 bg-white border-b border-gray-200 rounded-xl">
        <div class="w-1/12"><input name="" type="checkbox"
              class="w-5 h-5 rounded-md form-checkbox text-primary focus:ring-0" :checked="selectedAll" @change="toggleSelectedAll"/></div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Nom
          <div class="flex flex-col items-center ml-2">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.last_name == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('last_name', 'asc')">
                  <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.last_name == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('last_name', 'desc')">
                  <path fill-rule="evenodd"
                    d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>
        </div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Type de client
          <div class="flex flex-col items-center ml-2">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.type == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('type', 'asc')">
                  <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.type == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('type', 'desc')">
                  <path fill-rule="evenodd"
                    d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>
        </div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Email
          <div class="flex flex-col items-center ml-2">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.email == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('email', 'asc')">
                  <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.email == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('email', 'desc')">
                  <path fill-rule="evenodd"
                    d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>
        </div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Télephone
          <div class="flex flex-col items-center ml-2">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.phone_number == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('phone_number', 'asc')">
                  <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.phone_number == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('phone_number', 'desc')">
                  <path fill-rule="evenodd"
                    d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div></div>
        <div class="flex flex-row items-center justify-center w-2/12 text-center">Source
          <div class="flex flex-col items-center ml-2">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.source == 'asc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('source', 'asc')">
                  <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-3 h-3 text-gray-400 hover:text-gray-900"
                  :class="[filters.source == 'desc' ? 'text-gray-900 hover:opacity-80' : '']"
                  @click="sortField('source', 'desc')">
                  <path fill-rule="evenodd"
                    d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>
        </div>
        <div class="w-1/12"></div>
      </div>
      <div v-if="filteredClientsResults.length > 0" class="space-y-2 overflow-auto">
          <ClientListItem v-for="(client, index) in filteredClientsResults" :key="index" :client="client"
          @openMailModal="openMailModal(client)" :deleteClient="deleteClient" :opendelModal="opendelModal" :selected-all="selectedAll" :toggle-client-selection="toggleClientSelection"
          :isDrawerUpOpen="isDrawerUpOpen"
          @openUpdateClient="toggleUpdateDrawer(client)"
          :selectedClient="selectedClient" />
        </div>
      <div v-else-if="searchResults.length > 0" class="space-y-2 overflow-auto">
        <ClientListItem v-for="(client, index) in searchResults" :key="index"       :client="client"
          @openMailModal="openMailModal(client)" :deleteClient="deleteClient" :opendelModal="opendelModal" :selected-all="selectedAll" :toggle-client-selection="toggleClientSelection"
          :isDrawerUpOpen="isDrawerUpOpen"
          @openUpdateClient="toggleUpdateDrawer(client)"
          :selectedClient="selectedClient" :updateSearch="updateSearch" />
      </div>
      <div v-else class="w-auto space-y-2">
        <ClientListItem v-for="(client, index) in $page.props.clients" :key="index" :client="client"
          @openMailModal="openMailModal(client)" :deleteClient="deleteClient" :opendelModal="opendelModal" :selected-all="selectedAll" :toggle-client-selection="toggleClientSelection"
          :isDrawerUpOpen="isDrawerUpOpen"
          @openUpdateClient="toggleUpdateDrawer(client)"
          :selectedClient="selectedClient"/>
      </div>
      <div v-if="!$page.props.clients.length" class="w-full py-2 text-lg text-center">
        Pas de client enregitré ...
      </div>
    </div>
  </template>

  <script setup>
  //import ExcelJS from "exceljs";
  import ClientListItem from "@/Components/Molecules/ClientListItem.vue";
  import IconButton from "@/Components/Atoms/IconButton.vue";
  import Drawer from "@/Components/Organisms/Drawer.vue";
  import DrawerContent from "@/Components/Molecules/DrawerContent.vue";
  import CreateClientForm from "@/Components/Organisms/CreateClientForm.vue";
  import UpdateClientForm from "@/Components/Organisms/UpdateClientForm.vue";

  import SearchBar from "@/Components/Atoms/SearchBar.vue";
  import { usePage } from "@inertiajs/vue3";
  import { ref, watch } from 'vue';
  import debounce from "lodash/debounce";
  import { reactive } from "vue";

  const emit = defineEmits(["openMailModal", "deleteClient"]);
  const props = defineProps({
    openMailModal: Function,
    opendelModal: Function,
    deleteClient: Function,
  });

  const filteredClientsResults = ref([]);
  const searchQuery = ref("");
  const searchResults = ref([]);
  const searching = ref(false);

  let isDrawerOpen = ref(false);
  const isDrawerUpOpen= ref(false);
  const currentClient = ref(null);
  const selectedClient = ref(null);

  const toggleDrawer = () => {
    isDrawerOpen.value = !isDrawerOpen.value;
  };

  const toggleUpdateDrawer = (client) => {
      isDrawerUpOpen.value = !isDrawerUpOpen.value;
      selectedClient.value = client;
      console.log("Selected Client: ", selectedClient.value);
  };

  const closeDrawer = () => {
      if( isDrawerUpOpen.value==true)
      {
          isDrawerUpOpen.value = false;

      }else if (isDrawerOpen.value==true) {
          isDrawerOpen.value = false;
      }
  };

  const filters = reactive({
    last_name: "",
    email: "",
    type: "",
    source: "",
    phone_number: ""
  });

  const selectedAll = ref(false);

  const selectedClients = ref([]);

  const toggleClientSelection = (client) => {
    const index = selectedClients.value.findIndex((clt) => clt.id === client.id);
    if (index !== -1) {
      selectedClients.value.splice(index, 1); // Remove the client if already selected
    } else {
      selectedClients.value.push(client); // Add the client if not selected
    }
    console.log(selectedClients.value);
  };

  const toggleSelectedAll = () => {
    if (selectedAll.value) {
      selectedClients.value = []; // Deselect all clients
    } else {
      selectedClients.value = [...usePage().props.clients]; // Select all clients
    }
    selectedAll.value = !selectedAll.value;
    console.log(selectedClients.value);
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
      console.log('searchResults   : ',searchResults);
    } catch (e) {
      console.log(e);
    }
  };
  const updateSearch = async () => {
  searching.value = true;
  try {
    // Update the client
    const update_result = await axios.put(
      route("6dem.update.clients", { id: selectedClient.value.id })
    );

    // Fetch updated search results
    const result = await axios.get(
      route("6dem.search.clients") + "?search_text=" + searchQuery.value
    );

    searchResults.value = result.data;
    console.log('searchResults   : ', searchResults);
  } catch (e) {
    console.log(e);
  }
};

  const debouncedFetchResults = debounce(search, 300);

  const openMailModal = (client) => {
    emit("openMailModal", client);
  };

  const sortField = async (field, order) => {
    if (filters[field] == order) {
      filters[field] = "";
      const allFieldsEmpty = Object.values(filters).every(value => value === "");

      if (allFieldsEmpty) {
        filteredClientsResults.value = ref([]);
      }
    } else {
      filters[field] = order;
      try {
        const result = await axios.get(
          route("6dem.sort.client") +
          "?source=" + filters.source +
          "&type=" + filters.type +
          "&last_name=" + filters.last_name +
          "&email=" + filters.email +
          "&phone_number=" + filters.phone_number
        );
        filteredClientsResults.value = result.data;
      } catch (e) {
        console.log(e);
      }
    }
  }

  const exportSelectedClients = (selectedClients) => {
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet("Clients");

    const columns = [
      "Nom",
      "Type de client",
      "Email",
      "Téléphone",
      "Source"
    ];
    worksheet.addRow(columns);

    selectedClients.forEach((client) => {
      const rowData = [
        client.type == "professional" ? client.client_organization.name + " (" + client.client_organization.siren + ")" : client.first_name + " " + client.last_name,
        client.type == "professional" ? "Professionnel" : "Particulier",
        client.email,
        client.phone_number,
        client.source
      ];
      worksheet.addRow(rowData);
    });

    const fileName = "Liste des clients.xlsx";
    workbook.xlsx.writeBuffer().then((buffer) => {
      const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = fileName;
      link.click();
    });
  };

  const handleExportClick = () => {
    exportSelectedClients(selectedClients.value);
  };
  </script>


