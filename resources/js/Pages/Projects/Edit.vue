<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Attachment} from "@/types/Attachment";
import {Project} from "@/types/project";
import {Client} from "@/types/client";
import {User} from "@/types";
import ProjectForm from "@/Components/organisms/ProjectForm.vue";

defineProps<{
    users: User[];
    clients: Client[];
    statuses: string[];
    project: Project;
    attachments: Attachment[];
}>();

</script>

<template>
    <Head title="Edit Project"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <ProjectForm
                :project="project"
                :attachments="attachments"
                :users="users"
                :clients="clients"
                :statuses="statuses"
                :cancel-url="route('projects.index')"
                :submit-url="route('projects.update', project.id)"
                method="put"
            />
        </div>
    </AuthenticatedLayout>
</template>
