<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TaskForm from "@/Components/organisms/TaskForm.vue";
import {Task} from "@/types/task";
import {Project} from "@/types/project";
import {User} from "@/types";

const props = defineProps<{
    task: Task,
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
                :task="task"
                :projects="projects"
                :users="users"
                :statuses="statuses"
                :cancel-url="route('tasks.index')"
                :submit-url="route('tasks.update', task.id)"
                method="put"
            />
        </div>
    </AuthenticatedLayout>
</template>
