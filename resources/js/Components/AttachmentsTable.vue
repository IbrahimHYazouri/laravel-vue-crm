<script setup lang="ts">
const props = defineProps<{
    attachments: Array,
    project: Object
}>()

const getFileTypeClass = (mimeType) => {
    if (mimeType.includes('pdf')) return 'bg-red-100 text-red-800'
    if (mimeType.includes('image')) return 'bg-blue-100 text-blue-800'
    if (mimeType.includes('word') || mimeType.includes('document')) return 'bg-green-100 text-green-800'
    return 'bg-gray-100 text-gray-800'
}

const getFileTypeLabel = (mimeType) => {
    if (mimeType.includes('pdf')) return 'PDF'
    if (mimeType.includes('image')) return 'Image'
    if (mimeType.includes('word') || mimeType.includes('document')) return 'Document'
    return 'File'
}

const formatFileSize = (bytes: number, decimals = 2): string => {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));
    const size = parseFloat((bytes / Math.pow(k, i)).toFixed(dm));

    return `${size} ${sizes[i]}`;
}

</script>

<template>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                File name
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Size
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Type
            </th>
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 ">
        <tr
            v-for="attachment in attachments"
            class="hover:bg-gray-50 ">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <div class="flex items-center">
                    <!-- File icon based on mime type -->
                    <svg v-if="attachment.mime_type.includes('pdf')" class="h-5 w-5 text-red-500 mr-2"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                              clip-rule="evenodd"/>
                    </svg>
                    <svg v-else-if="attachment.mime_type.includes('image')" class="h-5 w-5 text-blue-500 mr-2"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                              clip-rule="evenodd"/>
                    </svg>
                    <svg v-else class="h-5 w-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                              clip-rule="evenodd"/>
                    </svg>
                    {{ attachment.name || attachment.file_name }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ formatFileSize(attachment.size) }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                      <span
                          class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                          :class="getFileTypeClass(attachment.mime_type)">
                        {{ getFileTypeLabel(attachment.mime_type) }}
                      </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <span class="inline-flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download
                </span>
            </td>
        </tr>
        </tbody>
    </table>
</template>
