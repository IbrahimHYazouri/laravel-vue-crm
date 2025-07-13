<script setup lang="ts">
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const visible = ref(true);
const page = usePage();
const message = page.props.flash.status;

watch(
    () => page.props.flash.status,
    (val) => {
        visible.value = !!val;
    },
    { immediate: true }
);
</script>

<template>
    <div
        v-if="visible && message"
        class="w-[70%] m-5 bg-green-100 border-l-4 border-green-500 text-green-800 px-4 py-3 mb-4 relative rounded"
        role="alert"
    >
        <span class="block sm:inline">{{ message }}</span>
        <button
            class="absolute top-2 right-3 text-green-800 hover:text-green-900"
            @click="visible = false"
        >
            ×
        </button>
    </div>
</template>
