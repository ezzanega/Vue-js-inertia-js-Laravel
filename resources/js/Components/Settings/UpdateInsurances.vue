<template>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-neutral-900">
                    Assurances
                </h3>
                <p class="mt-1 text-sm text-neutral-600">
                    Configurez la valeur maximale par objet, la franchise et le montant de vos assurances.
                </p>
            </div>
            <div class="mt-5 md:col-span-2 space-y-3 md:mt-0">
                <form @submit.prevent="updateContractual">
                    <div class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden">
                        <div class="px-4 py-5 sm:p-6">
                            <Message v-show="$page.props.contractualStatus === 'settings-updated'" status="success"
                                message="Vos paramètres ont été mis à jour" />
                            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl">
                                Assurance Contractuelle
                            </h5>
                            <div class="w-full pt-3 flex flex-col space-y-2">
                                <DefaultInput name="quotation_validity_duratation" label="Valeur max par objet"
                                    placeholder="Valeur max par objet" v-model="contractual.max_value"
                                    :error="contractual.errors.max_value" />
                            </div>
                            <div class="w-full pt-3 flex flex-col space-y-2">
                                <DefaultInput name="quotation_validity_duratation" label="Franchise" placeholder="Franchise"
                                    v-model="contractual.franchise" :error="contractual.errors.franchise" />
                            </div>
                            <div class="w-full pt-3 flex flex-col space-y-2">
                                <DefaultInput name="quotation_validity_duratation" label="Montant HT"
                                    placeholder="Montant HT" v-model="contractual.amount_ht"
                                    :error="contractual.errors.amount_ht" />
                            </div>
                        </div>
                        <div class="bg-neutral-50 px-4 py-4 sm:px-6">
                            <div class="flex justify-end">
                                <DefaultButton type="submit" buttontext="Enregistrer" />
                            </div>
                        </div>
                    </div>
                </form>
                <form @submit.prevent="updateAdValorem">
                    <div class="card bg-white ring-1 ring-neutral-600 ring-opacity-5 rounded-lg shadow overflow-hidden">
                        <div class="px-4 py-5 sm:p-6">
                            <Message v-show="$page.props.adValoremStatus === 'settings-updated'" status="success"
                                message="Vos paramètres ont été mis à jour" />
                            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl">
                                Assurance Ad Valorem
                            </h5>
                            <div class="w-full pt-3 flex flex-col space-y-2">
                                <DefaultInput name="quotation_validity_duratation" label="Valeur max par objet"
                                    placeholder="Valeur max par objet" v-model="adValorem.max_value"
                                    :error="adValorem.errors.max_value" />
                            </div>
                            <div class="w-full pt-3 flex flex-col space-y-2">
                                <DefaultInput name="quotation_validity_duratation" label="Franchise" placeholder="Franchise"
                                    v-model="adValorem.franchise" :error="adValorem.errors.franchise" />
                            </div>
                            <div class="w-full pt-3 flex flex-col space-y-2">
                                <DefaultInput name="quotation_validity_duratation" label="Montant HT"
                                    placeholder="Montant HT" v-model="adValorem.amount_ht"
                                    :error="adValorem.errors.amount_ht" />
                            </div>
                        </div>
                        <div class="bg-neutral-50 px-4 py-4 sm:px-6">
                            <div class="flex justify-end">
                                <DefaultButton type="submit" buttontext="Enregistrer" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
    
<script setup>
import DefaultInput from "@/Components/Atoms/DefaultInput.vue";
import DefaultButton from "@/Components/Atoms/DefaultButton.vue";
import Message from "@/Components/Atoms/Message.vue";
import { usePage, useForm } from "@inertiajs/vue3";

const currentInsuranceContractual = usePage().props.insurances.find(insurance => insurance.type === "contractual");
const currentInsuranceAdValorem = usePage().props.insurances.find(insurance => insurance.type === "ad_valorem");

const contractual = useForm({
    max_value: currentInsuranceContractual.max_value,
    franchise: currentInsuranceContractual.franchise,
    amount_ht: currentInsuranceContractual.amount_ht,
});

const adValorem = useForm({
    max_value: currentInsuranceAdValorem.max_value,
    franchise: currentInsuranceAdValorem.franchise,
    amount_ht: currentInsuranceAdValorem.amount_ht
});

const updateContractual = () => {
    contractual.put(route("6dem.insurance.contractual"), {
        preserveScroll: true,
        onSuccess: (resp) => console.log(resp),
    });
};

const updateAdValorem = () => {
    adValorem.put(route("6dem.insurance.adValorem"), {
        preserveScroll: true,
        onSuccess: (resp) => console.log(resp),
    });
};
</script>
    