<script setup lang="ts">
import {Link} from "@inertiajs/vue3"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps<{
    notifications: Object
}>()
</script>

<template>
    <AuthenticatedLayout>
        <div  class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <div class="p-6">
                <div v-if="notifications.data.length" class="w-full mb-4">
                    <Link :href="route('notifications.destroy')" class="text-white text-sm py-1 px-3 rounded-lg focus:outline-none transition-colors flex items-center justify-center bg-blue-600 hover:bg-blue-700 w-fit">
                        Mark all as read
                    </Link>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 ">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                            <div class="flex items-center">
                                Title
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                            <div class="flex items-center">
                                Type
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                            <div class="flex items-center">
                                Sent at
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500  uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white  divide-y divide-gray-200 ">
                        <tr v-for="notification in notifications.data">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ notification.title }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ notification.type }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ notification.created_at }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="route('notifications.update', notification.id)"
                                      method="put"
                                    class="text-white text-sm py-1 px-3 rounded-lg focus:outline-none transition-colors flex items-center justify-center bg-blue-600 hover:bg-blue-700 w-fit"
                                >
                                    Mark as read
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
