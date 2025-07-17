<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Project} from "@/types/project";
import {User} from "@/types";
import TaskForm from "@/Components/organisms/TaskForm.vue";

defineProps<{
    projects: Project[],
    users: User[],
    statuses: string[]
}>()
</script>

<template>
    <Head title="Create Task"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4"
        >
            <TaskForm
                :projects="projects"
                :users="users"
                :statuses="statuses"
                :cancel-url="route('tasks.index')"
                :submit-url="route('tasks.store')"
            />
        </div>
    </AuthenticatedLayout>
</template>
