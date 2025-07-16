<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

interface Task {
    title: string;
    description: string;
    project_id: string;
    user_id: string;
    status: string;
    deadline: string;
}

const props = defineProps<{
    task: Task,
    projects: Object,
    users: Object,
    statuses: Object
}>()

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    project_id: props.task.project_id,
    user_id: props.task.user_id,
    status: props.task.status,
    deadline: props.task.deadline_formatted,
})

const updateTask = () => {
    form.put(route("tasks.update", props.task.id))
}
</script>

<template>
    <Head title="Create Task"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4"
        >
            <div class="p-6">
                <form @submit.prevent="updateTask" class="mt-6 space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="col-span-1 lg:col-span-2">
                            <h3 class="text-lg font-medium text-gray-800 border-b border-gray-200 pb-2">
                                Edit Task
                            </h3>
                        </div>

                        <div>
                            <InputLabel for="title" value="Title"/>

                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="title"
                            />

                            <InputError
                                :message="form.errors.title"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="description" value="Description"/>

                            <TextInput
                                id="description"
                                v-model="form.description"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="description"
                            />

                            <InputError
                                :message="form.errors.description"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="project_id" value="Project"/>

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

                            <InputError
                                :message="form.errors.project_id"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="user_id" value="User"/>

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

                            <InputError
                                :message="form.errors.user_id"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="status" value="Status"/>

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

                            <InputError
                                :message="form.errors.status"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="deadline" value="Deadline"/>

                            <TextInput
                                id="deadline"
                                v-model="form.deadline"
                                type="date"
                                class="mt-1 block w-full"
                                autocomplete="deadline"
                            />

                            <InputError
                                :message="form.errors.deadline"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="mt-8 pt-5 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <Link :href="route('users.index')"
                                  class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                                Cancel
                            </Link>
                            <button
                                :disabled="form.processing"
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Edit Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
