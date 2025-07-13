<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps<{
    clients: Object
}>();
</script>

<template>
    <Head title="Clients"/>

    <AuthenticatedLayout>
        <div class="m-4 rounded-md bg-gray-200">
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h3 class="text-lg font-medium text-gray-800">Clients</h3>
                </div>
            </div>
            <div class="p-4 border-b border-gray-200 ">
                <div class="flex flex-wrap gap-2">
                    <Link
                        :href="route('clients.create')"
                        class="w-fit px-2 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">+ Add Client
                    </Link>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Name
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                            <div class="flex items-center">
                                Email
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Company Name
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                            <div class="flex items-center">
                                Company Address
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Company Phone
                            </div>
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Company VAT
                            </div>
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500  uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white  divide-y divide-gray-200 ">
                    <tr v-if="clients" v-for="client in clients.data" class="hover:bg-gray-50 ">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ client.contact_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ client.contact_email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ client.company_name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ client.company_address }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 ">
                                {{ client.contact_phone_number }}
                            </div>
                        </td>

                        <td>
                            <div class="text-sm text-gray-900 ">
                                {{ client.company_vat }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </span>
                                <span v-if="$page.props.auth.permissions.includes('delete')" class="text-red-600 hover:text-red-900 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="7"
                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 ">
                            No clients found
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
