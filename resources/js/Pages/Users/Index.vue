<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps<{
    users: Object
}>();
</script>

<template>
    <Head title="Users"/>
    <AuthenticatedLayout>
        <div class="m-4 rounded-md bg-gray-200">
            <p class="p-2 border-b">Users</p>
            <div class="p-2 bg-white flex flex-col gap-5">
                <Link
                    :href="route('users.create')"
                    class="w-fit px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">+ Add User
                </Link>
                <hr/>
                <button class="w-fit px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 border-b">Show
                    deleted users
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <div class="flex items-center">
                                Name
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <div class="flex items-center">
                                Email
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <div class="flex items-center">
                                Role
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <div class="flex items-center">
                                Address
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <div class="flex items-center">
                                Phone
                            </div>
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <div class="flex items-center">
                                Terms Accepted
                            </div>
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white  divide-y divide-gray-200 ">
                    <tr v-if="users" v-for="user in users.data" class="hover:bg-gray-50 ">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ user.full_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ user.email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ user.roles.map(role => role.name).join(', ') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 ">{{ user.address }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ user.phone_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 ">
                                {{ user.terms_accepted_at ? 'Yes' : 'No' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <Link :href="route('users.edit', user.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </Link>
                                <Link :href="route('users.destroy', user.id)" method="DELETE">
                                    <span class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                </span>
                                </Link>
                            </div>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="7"
                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 ">
                            No users found
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
