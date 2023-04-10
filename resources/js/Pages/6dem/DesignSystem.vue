<template>
  <Head title="Design System" />
  <div class="grid grid-cols-4 font-inter font-normal custom-text-sm mb-80">
    <div class="border border-secondary item-col flex items-center justify-center p-10">
      <div>
        <Dropdown placement="bottom-end">
          <AddButton />
          <template #popper>
            <TopAddButtonPopperContent />
          </template>
        </Dropdown>
      </div>
    </div>

    <div class="border border-secondary item-col flex items-center justify-center p-10">
      <div>
        <IconButton />
      </div>
    </div>

    <div class="border border-secondary item-col flex items-center justify-center p-10">
      <div>
        <TopSearchBar />
      </div>
    </div>

    <div class="border border-secondary item-col flex items-center justify-center p-2">
      <div>
        <TopAddButtonPopperContent />
      </div>
    </div>


    <div class="border border-secondary item-col flex items-center justify-center p-10">
      <div>
        <NotificationIcon />
      </div>
    </div>

    <div class="border border-secondary item-col flex items-center justify-center p-2">
      <SideBarMenu />
    </div>

    <div class="border border-secondary item-col flex items-center justify-center p-2">
      <DefaultInput
        :required="true"
        name="Nom"
        label="Nom"
      />
    </div>
  </div>
</template>

<script setup>
import { Dropdown } from 'floating-vue'
import AddButton from '@/Components/Atoms/AddButton.vue';
import SideBarMenu from '@/Components/Atoms/SideBarMenu.vue';
import IconButton from '@/Components/Atoms/IconButton.vue';
import TopSearchBar from '@/Components/Atoms/TopSearchBar.vue';
import TopAddButtonPopperContent from '@/Components/Atoms/TopAddButtonPopperContent.vue';
import DefaultInput from '@/Components/Atoms/DefaultInput.vue';
import NotificationIcon from '@/Components/Atoms/NotificationIcon.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
});
</script>