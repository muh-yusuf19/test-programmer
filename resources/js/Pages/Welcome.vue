<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
            </template>
        </div>

        <div class="flex-1 flex flex-col justify-center">
            <div
                class="container mx-auto p-6 text-center transition transform hover:-translate-y-5 hover:cursor-pointer duration-200"
            >
                <h1
                    class="text-indigo-600 text-5xl font-bold leading-none md:text-[4rem]"
                >
                    Test <span class="text-rumput">Programmer</span>
                </h1>
                <h2
                    class="mt-6 text-lg md:text-[1.5rem] text-indigo-500 font-bold"
                >
                    Menggunakan Front-end VUE dan Back-end Laravel Dengan
                    Bantuan Inertiajs
                </h2>
                <p class="mt-6">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Sunt, ratione.Lorem ipsum dolor sit amet consectetur,
                    adipisicing elit. Sunt, ratione.
                </p>
            </div>
        </div>
    </div>
</template>
