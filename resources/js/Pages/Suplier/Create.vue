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
    kodespl: "",
    namaspl: "",
});

const toast = useToast();

const submit = () => {
    form.post(route("suplier.store"), {
        onFinish: () => form.reset(),
        onSuccess: () =>
            toast.add({
                severity: ToastSeverity.SUCCESS,
                summary: "Success",
                detail: "Suplier data telah disimpan database",
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
                Create Suplier
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <!-- Content -->
                    <Link :href="route('suplier.index')">
                        <PrimaryButton> Back </PrimaryButton>
                    </Link>

                    <form @submit.prevent="submit" class="mt-6 space-y-4">
                        <div>
                            <InputLabel for="kodespl" value="Kode Suplier" />
                            <TextInput
                                id="kodespl"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.kodespl"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.kodespl"
                            />
                        </div>

                        <div>
                            <InputLabel for="namaspl" value="Nama Suplier" />
                            <TextInput
                                id="namaspl"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.namaspl"
                                required
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.namaspl"
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
