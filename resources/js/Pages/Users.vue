<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <div class="m-4 rounded-md bg-gray-200">
            <p class="p-2 border-b">Users</p>
            <div class="p-2 bg-white flex flex-col gap-5">
                <button class="w-fit px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">+ Add User</button>
                <hr />
                <button class="w-fit px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 border-b">Show deleted users</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left text-xs text-zinc-500 font-light uppercase">
                        <th class="p-2">name</th>
                        <th class="p-2">email</th>
                        <th class="p-2">role</th>
                        <th class="p-2">address</th>
                        <th class="p-2">phone</th>
                        <th class="p-2">terms accepted</th>
                        <th class="p-2">actions</th>
                    </tr>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
