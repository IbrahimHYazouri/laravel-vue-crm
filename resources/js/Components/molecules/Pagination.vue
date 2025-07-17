<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps<{
    links: Array<{
        url: string | null
        label: string
        active: boolean
    }>
}>()
</script>

<template>
    <nav class="flex items-center justify-center space-x-1" aria-label="Pagination">
        <template v-for="(link, index) in links" :key="index">
            <!-- Previous/Next links and page number links -->
            <Link
                v-if="link.url"
                :href="link.url"
                preserve-scroll
                class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200"
                :class="[
          link.active
            ? 'bg-blue-600 text-white border border-blue-600'
            : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-gray-900'
        ]"
                v-html="link.label"
            />

            <span
                v-else
                class="px-3 py-2 text-sm font-medium rounded-md text-gray-400 bg-gray-100 border border-gray-200 cursor-not-allowed"
                v-html="link.label"
            />
        </template>
    </nav>
</template>
