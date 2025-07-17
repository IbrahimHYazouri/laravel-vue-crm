<script setup lang="ts">
import {Task} from "@/types/task";
import {Project} from "@/types/project";
import {User} from "@/types";
import {computed} from "vue";
import {Link, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import FormField from "@/Components/molecules/FormField.vue";

const props = defineProps<{
    task?: Task,
    projects: Project[],
    users: User[],
    statuses: string[],
    cancelUrl: string
    submitUrl: string
    method?: 'post' | 'put'
}>();

const isEdit = computed(() => !!props.task);

const form = useForm({
    title: props.task?.title,
    description: props.task?.description,
    project_id: props.task?.project_id,
    user_id: props.task?.user_id,
    status: props.task?.status,
    deadline: props.task?.deadline_formatted,
})

function submit() {
    form[isEdit.value ? 'put' : 'post'](props.submitUrl)
}
</script>

<template>
    <form @submit.prevent="submit" class="p-6 space-y-6">
        <h3 class="text-lg mb-4">{{ isEdit ? 'Edit' : 'Create' }} Task</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <FormField id="title" value="Title" :error="form.errors.title">
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="title"
                />
            </FormField>

            <FormField id="description" value="Description" :error="form.errors.description">
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="description"
                />
            </FormField>

            <FormField id="project_id" value="Project" :error="form.errors.project_id">
                <select id="project_id" name="project_id"
                        v-model="form.project_id"
                        class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300"
                >
                    <option
                        v-for="project in projects"
                        :value="project.id"
                    >
                        {{project.title}}
                    </option>
                </select>
            </FormField>

            <FormField id="user_id" value="User" :error="form.errors.user_id">
                <select id="user_id" name="user_id"
                        v-model="form.user_id"
                        class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300"
                >
                    <option
                        v-for="user in users"
                        :value="user.id"
                    >
                        {{user.full_name}}
                    </option>
                </select>
            </FormField>

            <FormField id="status" value="Status" :error="form.errors.status">
                <select id="status" name="status"
                        v-model="form.status"
                        class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300"
                >
                    <option
                        v-for="status in statuses"
                        :value="status"
                    >
                        {{status}}
                    </option>
                </select>
            </FormField>

            <FormField id="deadline" value="Deadline" :error="form.errors.deadline">
                <TextInput
                    id="deadline"
                    v-model="form.deadline"
                    type="date"
                    class="mt-1 block w-full"
                    autocomplete="deadline"
                />
            </FormField>
        </div>

        <div class="mt-8 pt-5 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <Link :href="cancelUrl"
                      class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                    Cancel
                </Link>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    {{ isEdit ? 'Save Changes' : 'Create' }}
                </button>
            </div>
        </div>
    </form>
</template>

