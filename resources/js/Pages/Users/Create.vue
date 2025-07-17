<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Role} from "@/types/role";
import UserForm from "@/Components/organisms/UserForm.vue";

defineProps<{
    roles: Role[]
}>();
</script>

<template>
    <Head title="Create User"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <UserForm
                :roles="roles"
                :cancel-url="route('users.index')"
                :submit-url="route('users.store')"
            />
        </div>
    </AuthenticatedLayout>
</template>
