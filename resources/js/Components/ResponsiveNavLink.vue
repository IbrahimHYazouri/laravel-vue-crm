<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() =>
    props.active
        ? 'flex items-center w-full px-4 py-2 border-s-4 border-indigo-500 bg-indigo-100 text-indigo-800 font-medium transition duration-150 ease-in-out'
        : 'flex items-center w-full px-4 py-2 border-s-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 font-medium transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
