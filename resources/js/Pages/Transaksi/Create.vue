<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import Dropdown from "primevue/dropdown";
import { useToast } from "primevue/usetoast";
import { ToastSeverity } from "primevue/api";

const props = defineProps({
    barang: {
        required: true,
        type: Array,
    },
    suplier: {
        required: true,
        type: Array,
    },
});

const toast = useToast();

const selectedBarang = ref();
const selectedSuplier = ref();

const form = useForm({
    qyt: "",
    diskon: "",
    id_barang: "",
    id_suplier: "",
});

const submit = () => {
    // console.log(selectedSuplier.value);
    // console.log(selectedBarang.value);

    form.id_barang = selectedBarang.value.id;
    form.id_suplier = selectedSuplier.value.id;

    form.post(route("transaksi.store"), {
        onFinish: () => form.reset(),
        onSuccess: () =>
            toast.add({
                severity: ToastSeverity.SUCCESS,
                summary: "Success",
                detail: "Transaksi data telah disimpan database",
                life: 2000,
            }),
    });
};
</script>

<template>
    <Head title="Create Transaksi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Membuat Transaksi
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <Link :href="route('transaksi.index')">
                        <PrimaryButton> Back </PrimaryButton>
                    </Link>

                    <form @submit.prevent="submit" class="mt-6 space-y-4">
                        <div>
                            <InputLabel for="supplier" value="Select Suplier" />
                            <Dropdown
                                id="supplier"
                                v-model="selectedSuplier"
                                :options="props.suplier"
                                filter
                                optionLabel="suplier"
                                placeholder="Select Suplier"
                                class="w-full border border-gray-300 md:w-14rem"
                            >
                                <template #value="slotProps">
                                    <div
                                        v-if="slotProps.value"
                                        class="flex align-items-center"
                                    >
                                        <div>{{ slotProps.value.namaspl }}</div>
                                    </div>
                                    <span v-else>
                                        {{ slotProps.placeholder }}
                                    </span>
                                </template>
                                <template #option="slotProps">
                                    <div class="flex align-items-center">
                                        <div>
                                            {{ slotProps.option.namaspl }}
                                        </div>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>

                        <div>
                            <InputLabel for="barang" value="Select Barang" />
                            <Dropdown
                                id="barang"
                                v-model="selectedBarang"
                                :options="props.barang"
                                filter
                                optionLabel="barang"
                                placeholder="Select Barang"
                                class="w-full border border-gray-300 md:w-14rem"
                            >
                                <template #value="slotProps">
                                    <div
                                        v-if="slotProps.value"
                                        class="flex align-items-center"
                                    >
                                        <div>{{ slotProps.value.namabrg }}</div>
                                    </div>
                                    <span v-else>
                                        {{ slotProps.placeholder }}
                                    </span>
                                </template>
                                <template #option="slotProps">
                                    <div class="flex align-items-center">
                                        <div>
                                            {{ slotProps.option.namabrg }}
                                        </div>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>

                        <div>
                            <InputLabel for="qyt" value="Quantity" />
                            <TextInput
                                id="qyt"
                                type="number"
                                v-model="form.qyt"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.qyt"
                            />
                        </div>

                        <div>
                            <InputLabel for="diskon" value="Diskon" />
                            <TextInput
                                id="diskon"
                                type="number"
                                v-model="form.diskon"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.diskon"
                            />
                        </div>

                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Submit
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
