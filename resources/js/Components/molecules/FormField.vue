<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

defineProps<{
    id: string;
    value: string
    error?: string;
}>()
</script>

<template>
    <div>
        <InputLabel :for="id" :value="value"/>

        <slot />

        <InputError
            :message="error"
            class="mt-2"
        />
    </div>
</template>
