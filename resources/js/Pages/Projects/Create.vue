<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {ref} from "vue";

defineProps<{
    users: Object,
    clients: Object,
    statuses: Object
}>()

const selectedFiles = ref<File[]>([])

const form = useForm({
    title: '',
    description: '',
    deadline: '',
    status: '',
    user_id: '',
    client_id: '',
    attachments: [] as FileList | null,
})

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;

    if (target.files) {
        selectedFiles.value = Array.from(target.files);
        form.attachments = selectedFiles.value;
    }
}

const removeFile = (index: number) => {
    selectedFiles.value.splice(index, 1)
    form.attachments = selectedFiles.value
}

const createProject = () => {
    form.post(route("projects.store"))
}
</script>

<template>
    <Head title="Create Project"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden mb-6">
            <div class="p-6">
                <form @submit.prevent="createProject" class="mt-6 space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="col-span-1 lg:col-span-2">
                            <h3 class="text-lg font-medium text-gray-800 border-b border-gray-200 pb-2">
                                Create Project
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
                            <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                            <select id="client_id" name="client_id"
                                    v-model="form.client_id"
                                    class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300"
                            >
                                <option
                                    v-for="client in clients"
                                    :value="client.id"
                                >
                                    {{client.company_name}}
                                </option>
                            </select>

                            <InputError
                                :message="form.errors.client_id"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User id</label>
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

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
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
                            <InputLabel for="attachments" value="Attachments"/>
                            <input
                                id="attachments"
                                type="file"
                                multiple
                                @change="handleFileChange"
                                class="w-full px-4 py-2 rounded-lg text-gray-700 bg-gray-50 border border-gray-300 file:border-0 file:bg-indigo-600 file:text-white file:px-4 file:py-2 file:rounded-lg file:mr-4 hover:file:bg-indigo-700 transition-colors"
                            />
                            <InputError :message="form.errors.attachments" class="mt-2"/>
                        </div>

                        <!-- File Preview Grid -->
                        <div v-if="selectedFiles.length" class="col-span-1 lg:col-span-2">
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <div
                                    v-for="(file, index) in selectedFiles"
                                    :key="index"
                                    class="relative bg-gray-100 border border-gray-300 rounded-lg p-3 shadow-sm"
                                >
                                    <button
                                        @click="removeFile(index)"
                                        class="absolute top-1 right-1 text-gray-500 hover:text-red-600 bg-white rounded-full size-5 flex items-center justify-center shadow"
                                        title="Remove file"
                                    >
                                        &times;
                                    </button>
                                    <div class="text-sm font-semibold text-gray-800 truncate">{{ file.name }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ file.type || 'Unknown type' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-end space-x-3">
                            <Link :href="route('users.index')"
                                  class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                                Cancel
                            </Link>
                            <button
                                :disabled="form.processing"
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Create Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
