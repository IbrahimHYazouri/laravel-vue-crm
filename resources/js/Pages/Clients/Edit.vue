<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ClientForm from "@/Components/organisms/ClientForm.vue";
import {Client} from "@/types/client";

defineProps<{
    client: Client
}>();

</script>

<template>
    <Head title="Update Client"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <ClientForm
              :client="client"
              :cancel-url="route('clients.index')"
              :submit-url="route('clients.update', client.id)"
              method="put"
            />
        </div>
    </AuthenticatedLayout>
</template>
