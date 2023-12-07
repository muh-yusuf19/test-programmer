<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Toast from "primevue/toast";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import TextInput from "@/Components/TextInput.vue";
import { reactive } from "vue";
import { FilterMatchMode } from "primevue/api";

defineProps({
    transaksi: {
        required: true,
        type: Array,
    },
});

const filters = reactive({
    global: { value: "", matchMode: FilterMatchMode.CONTAINS },
    notransaksi: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    kodebrg: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    qyt: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    diskon: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    diskonrp: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    totalrp: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
});
</script>

<template>
    <Head title="Transaksi" />

    <Toast />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Transaksi
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <Link :href="route('transaksi.create')">
                        <PrimaryButton> Create Transaksi </PrimaryButton>
                    </Link>

                    <DataTable
                        class="mt-6"
                        v-model:filters="filters"
                        :value="transaksi"
                        paginator
                        :rows="10"
                        :globalFilterFields="[
                            'notransaksi',
                            'kodebrg',
                            'qyt',
                            'diskon',
                            'diskonrp',
                            'totalrp',
                        ]"
                    >
                        <template #header>
                            <div class="flex justify-content-end">
                                <TextInput
                                    type="text"
                                    class="mt-1 block w-1/4"
                                    v-model="filters.global.value"
                                    placeholder="Keyword Search"
                                />
                            </div>
                        </template>
                        <template #empty> Data Transaksi Tidak ada </template>
                        <Column
                            field="notransaksi"
                            sortable
                            header="Nomor Transaksi"
                        />
                        <Column field="kodebrg" sortable header="Kode Barang" />
                        <Column field="qyt" sortable header="Quantity" />
                        <Column field="diskon" sortable header="Diskon" />
                        <Column field="diskonrp" sortable header="Diskon Rp" />
                        <Column field="totalrp" sortable header="Total Rp" />
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
