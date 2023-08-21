<template>
    <Modal :show="isModal_dup_quot_Open">
        <div class="flex min-h-0 flex-1 flex-col py-6 overflow-y-scroll">
          <div class="px-4 sm:px-6">
            <div class="flex items-start justify-between">
              <div class="space-y-1">
                <h2
                  id="headlessui-dialog-title-15"
                  data-headlessui-state="open"
                  class="text-lg font-medium"
                >
                  Dupliquer dans une autre formule
                </h2>
                <span class="text-sm">
                    dupliquer dans une autre formule
                </span>
              </div>
              <div class="ml-3 flex h-7 items-center">
                <button
                  type="button"
                  class="rounded-md bg-white text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-primary-500"
                  tabindex="0"
                  @click="closeDupQuotModal()"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="h-6 w-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <form>
            <div class="px-4 sm:px-6">
                <div class="w-full py-3 flex flex-col space-y-2">
                    <div class="my-6 space-y-5">
                        <DefaultSelectInput
                            name="formule"
                            label="Formule"
                        />
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                    <SecondaryButton @click="closeDupQuotModal"> Annuler </SecondaryButton>
                    <DefaultButton class="w-32" buttontext="Dupliquer" />
                    </div>
                </div>
            </div>
        </form>

        </div>
    </Modal>
</template>


<script setup>
    import Modal from "@/Components/Modal.vue";
    import DefaultSelectInput from "@/Components/Atoms/DefaultSelectInput.vue";
    import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
    import SecondaryButton from "@/Components/SecondaryButton.vue";

    const props = defineProps({
        isModal_dup_quot_Open : Boolean,
    });
    
    const emit = defineEmits(["closeDupQuotModal"]);

    const closeDupQuotModal = () => {
        emit("closeDupQuotModal");
    };

    if(props.isModal_dup_quot_Open=='true')
    {
        console.log('from props :  '+ props.isModal_dup_quot_Open)
    }else{
        console.log('hello')
    }

</script>
