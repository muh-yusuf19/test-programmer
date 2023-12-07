<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { reactive } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { FilterMatchMode } from "primevue/api";
import Toast from "primevue/toast";
import ConfirmDialog from "primevue/confirmdialog";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import { ToastSeverity } from "primevue/api";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    suplier: {
        required: true,
        type: Array,
    },
});

const toast = useToast();
const confirm = useConfirm();
const form = useForm({
    id: "",
});

const filters = reactive({
    global: { value: "", matchMode: FilterMatchMode.CONTAINS },
    kodespl: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    namaspl: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
});

const handleDelete = (id) => {
    confirm.require({
        message: "Are you sure want to delete this record ?" + id,
        header: "Confirmation",
        accept: () => {
            form.delete(route("suplier.delete", id), {
                onSuccess: () => {
                    toast.add({
                        severity: ToastSeverity.SUCCESS,
                        summary: "Success",
                        detail: "Data Suplier berhasil dihapus",
                        life: 2000,
                    });
                },
            });
        },
        reject: () => {
            toast.add({
                severity: ToastSeverity.INFO,
                summary: "Cancelled",
                detail: "Data Suplier Tidak Jadi dihapus",
                life: 2000,
            });
        },
    });
};
</script>

<template>
    <Head title="Suplier" />

    <Toast />

    <ConfirmDialog>
        <template #container="{ message, acceptCallback, rejectCallback }">
            <div class="bg-white p-5 rounded-lg text-gray-700">
                <div class="flex flex-row justify-between items-center">
                    <span class="font-bold text-2xl block">{{
                        message.header
                    }}</span>
                    <button class="p-4" @click="rejectCallback">
                        <span class="pi pi-times"></span>
                    </button>
                </div>
                <p class="py-4">{{ message.message }}</p>
                <div class="flex justify-end gap-2 py-4">
                    <PrimaryButton @click="acceptCallback"
                        >Submit</PrimaryButton
                    >
                    <SecondaryButton @click="rejectCallback"
                        >Cancel</SecondaryButton
                    >
                </div>
            </div>
        </template>
    </ConfirmDialog>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Suplier
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <Link :href="route('suplier.create')">
                        <PrimaryButton> Create Suplier </PrimaryButton>
                    </Link>

                    <DataTable
                        class="mt-6"
                        v-model:filters="filters"
                        :value="suplier"
                        paginator
                        :rows="10"
                        :globalFilterFields="['namabrg', 'kodebrg', 'satuan']"
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
                        <template #empty> Data Suplier Tidak ada </template>
                        <Column
                            field="kodespl"
                            sortable
                            header="Kode Suplier"
                        />
                        <Column
                            field="namaspl"
                            sortable
                            header="Nama Suplier"
                        />
                        <Column header="Actions">
                            <template #body="{ data }">
                                <div class="flex flex-row gap-4">
                                    <Link
                                        :href="route('suplier.edit', data.id)"
                                        method="put"
                                        as="button"
                                        type="button"
                                        class="bg-yellow-400 text-white px-4 py-2 rounded-md"
                                    >
                                        Edit
                                    </Link>

                                    <div>
                                        <button
                                            @click="handleDelete(data.id)"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
