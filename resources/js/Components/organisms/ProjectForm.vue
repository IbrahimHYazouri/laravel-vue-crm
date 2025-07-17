<script setup lang="ts">
import {Project} from "@/types/project";
import {User} from "@/types";
import {Client} from "@/types/client";
import {Link, useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import FormField from "@/Components/molecules/FormField.vue";
import TextInput from "@/Components/TextInput.vue";
import FilePreviewItem from "@/Components/molecules/FilePreviewItem.vue";
import {Attachment} from "@/types/Attachment";
import {formatFileSize} from "@/Composables/formatFileSize";

const props = defineProps<{
    project?: Project
    users: User[],
    clients: Client[]
    statuses: string[]
    attachments?: Attachment[]
    cancelUrl: string
    submitUrl: string
    method?: 'post' | 'put'
}>();

const isEdit = computed(() => !!props.project);
const form = useForm({
    title: props.project?.title || '',
    description: props.project?.description || '',
    deadline: props.project?.deadline_formatted || '',
    status: props.project?.status || '',
    user_id: props.project?.user_id || '',
    client_id: props.project?.client_id || '',
    attachments: [] as FileList | null,
    removed_attachments: [] as number[],
    _method: props.method === 'put' ? 'PUT' : undefined,
});

const selectedFiles = ref<File[]>([]);
const removed = ref(new Set<number>())

function toggleRemove(id: number) {
    if (removed.value.has(id)) {
        removed.value.delete(id)
    } else {
        removed.value.add(id)
    }
    form.removed_attachments = Array.from(removed.value)
}

function handleFileChange(e: Event) {
    const files = (e.target as HTMLInputElement).files
    if (files) selectedFiles.value = Array.from(files)
    form.attachments = selectedFiles.value
}

function removeFile(i: number) {
    selectedFiles.value.splice(i, 1)
    form.attachments = selectedFiles.value
}

function submit() {
    form[isEdit.value ? 'post' : 'post'](props.submitUrl, {forceFormData: true})
}
</script>

<template>
    <form @submit.prevent="submit" class="p-6 space-y-6">
        <h3 class="text-lg mb-4">{{ isEdit ? 'Edit' : 'Create' }} Project</h3>

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

            <FormField id="client_id" value="Client" :error="form.errors.client_id">
                <select id="client_id" v-model="form.client_id"
                        class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300">
                    <option disabled value="">Select client…</option>
                    <option v-for="client in clients" :key="client.id" :value="client.id">
                        {{ client.company_name }}
                    </option>
                </select>
            </FormField>

            <FormField id="user_id" value="User" :error="form.errors.user_id">
                <select id="user_id" v-model="form.user_id"
                        class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300">
                    <option disabled value="">Select user…</option>
                    <option v-for="user in users" :key="user.id" :value="user.id">
                        {{ user.full_name }}
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

            <FormField id="status" value="Status" :error="form.errors.status">
                <select id="status" v-model="form.status"
                        class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300">
                    <option disabled value="">Select status…</option>
                    <option v-for="status in statuses" :key="status" :value="status">
                        {{ status }}
                    </option>
                </select>
            </FormField>

            <!-- EXISTING ATTACHMENTS (edit only) -->
            <div v-if="isEdit && attachments.length"
                 class="col-span-1 lg:col-span-2 space-y-2"
            >
                <h4 class="font-medium text-gray-700">Current Attachments</h4>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        v-for="att in attachments"
                        :key="att.id"
                        class="relative p-3 border rounded shadow-sm transition-all"
                        :class="{
              'bg-gray-50 border-gray-200': !removed.has(att.id),
              'bg-red-50 border-red-200 opacity-60': removed.has(att.id)
            }"
                    >
                        <button
                            type="button"
                            @click="toggleRemove(att.id)"
                            class="absolute top-1 right-1 text-xl leading-none"
                        >
                            {{ removed.has(att.id) ? '↻' : '×' }}
                        </button>
                        <div class="truncate font-medium">{{ att.name }}</div>
                        <div class="text-xs text-gray-500">{{ formatFileSize(att.size) }}</div>
                        <div
                            v-if="removed.has(att.id)"
                            class="text-xs text-red-600 mt-1"
                        >
                            Marked for removal
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEW ATTACHMENTS -->
            <div class="col-space-1 lg:col-span-2">
                <FormField id="attachments" value="Attachments" :error="form.errors.attachments">
                    <input
                        id="attachments"
                        type="file"
                        multiple
                        @change="handleFileChange"
                        class="w-full px-4 py-2 rounded-lg text-gray-700 bg-gray-50 border border-gray-300 file:border-0 file:bg-indigo-600 file:text-white file:px-4 file:py-2 file:rounded-lg file:mr-4 hover:file:bg-indigo-700 transition-colors"
                    />
                </FormField>

                <div v-if="selectedFiles.length" class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                    <FilePreviewItem
                        v-for="(file, index) in selectedFiles"
                        :file="file"
                        @remove="removeFile(index)"
                    />
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-5 border-t">
            <Link :href="cancelUrl"
                  class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                Cancel
            </Link>
            <button
                :disabled="form.processing"
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                {{ isEdit ? 'Save Changes' : 'Create' }}
            </button>
        </div>
    </form>
</template>
