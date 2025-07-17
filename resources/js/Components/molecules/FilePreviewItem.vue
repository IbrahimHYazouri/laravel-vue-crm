<script setup lang="ts">
defineProps<{ file: File }>()
</script>

<template>
    <div class="relative bg-gray-100 border border-gray-300 rounded-lg p-3 shadow-sm">
        <button @click="$emit('remove')" type="button" class="absolute top-1 right-1 text-gray-500 hover:text-red-600 bg-white rounded-full size-5 flex items-center justify-center shadow">&times;</button>
        <div class="truncate">{{ file.name }}</div>
        <div class="text-xs">{{ file.type || 'Unknown' }}</div>
    </div>
</template>
