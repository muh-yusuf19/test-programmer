<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import TextInput from "@/Components/TextInput.vue";
import { reactive } from "vue";
import { FilterMatchMode } from "primevue/api";

defineProps({
    stock: {
        required: true,
        type: Array,
    },
});

const filters = reactive({
    global: { value: "", matchMode: FilterMatchMode.CONTAINS },
    kodebrg: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    qytbeli: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
});
</script>

<template>
    <Head title="Stock" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Stock
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <DataTable
                        class="mt-6"
                        v-model:filters="filters"
                        :value="stock"
                        paginator
                        :rows="10"
                        :globalFilterFields="['kodebrg', 'qytbeli']"
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
                        <Column field="kodebrg" sortable header="Kode Barang" />
                        <Column field="qytbeli" sortable header="Quantity" />
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
