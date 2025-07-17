<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ProjectForm from "@/Components/organisms/ProjectForm.vue";
import {User} from "@/types";
import {Client} from "@/types/client";

defineProps<{
    users: User[],
    clients: Client[],
    statuses: string[]
}>()
</script>

<template>
    <Head title="Create Project"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <ProjectForm
                :users="users"
                :clients="clients"
                :statuses="statuses"
                :cancel-url="route('projects.index')"
                :submit-url="route('projects.store')"
            />
        </div>
    </AuthenticatedLayout>
</template>
