<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useToast } from "primevue/usetoast";
import { ToastSeverity } from "primevue/api";

const form = useForm({
    namabrg: "",
    kodebrg: "",
    satuan: "",
    hargabeli: "",
});

const toast = useToast();

const submit = () => {
    form.post(route("barang.store"), {
        onFinish: () => form.reset(),
        onSuccess: () =>
            toast.add({
                severity: ToastSeverity.SUCCESS,
                summary: "Di Buat",
                detail: "Barang telah disimpan database",
                life: 2000,
            }),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Barang
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <!-- Content -->
                    <Link :href="route('barang.index')">
                        <PrimaryButton> Back </PrimaryButton>
                    </Link>

                    <form @submit.prevent="submit" class="mt-6 space-y-4">
                        <div>
                            <InputLabel for="namabrg" value="Nama barang" />
                            <TextInput
                                id="namabrg"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.namabrg"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.namabrg"
                            />
                        </div>

                        <div>
                            <InputLabel for="kodebrg" value="Kode Barang" />
                            <TextInput
                                id="kodebrg"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.kodebrg"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.kodebrg"
                            />
                        </div>

                        <div>
                            <InputLabel for="satuan" value="Satuan Barang" />
                            <TextInput
                                id="satuan"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.satuan"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.satuan"
                            />
                        </div>

                        <div>
                            <InputLabel for="hargabeli" value="Harga Beli" />
                            <TextInput
                                id="hargabeli"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.hargabeli"
                                required
                                autofocus
                                autocomplete="hargabeli"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.hargabeli"
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
