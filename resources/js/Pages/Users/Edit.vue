<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Role} from "@/types/role";
import {User} from "@/types";
import UserForm from "@/Components/organisms/UserForm.vue";

defineProps<{
    roles: Role[],
    user: User
}>();
</script>

<template>
    <Head title="Update User"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <UserForm
                :user="user"
                :roles="roles"
                :cancel-url="route('users.index')"
                :submit-url="route('users.update', user.id)"
                method="put"
            />
        </div>
    </AuthenticatedLayout>
</template>
