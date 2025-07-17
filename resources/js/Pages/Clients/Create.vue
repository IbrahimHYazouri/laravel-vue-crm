<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ClientForm from "@/Components/organisms/ClientForm.vue";
</script>

<template>
    <Head title="Create Client"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <ClientForm
                :cancel-url="route('clients.index')"
                :submit-url="route('clients.store')"
            />
        </div>
    </AuthenticatedLayout>
</template>
