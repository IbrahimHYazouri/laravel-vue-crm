<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

interface Task {
    id: string
    title: string
    description: string
    deadline_formatted: string
    created_at_formatted: string
    status: string
}

defineProps<{
    task: Task
}>()
</script>

<template>
    <Head title="Task Details"/>
    <AuthenticatedLayout>
        <div class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden m-4">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ task.title }}</h1>
                        <p class="text-gray-600  mt-1">Task Details</p>
                    </div>
                    <div class="flex space-x-3">
                        <Link :href="route('tasks.edit', task.id)"
                           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Task
                        </Link>
                        <Link
                            :href="route('tasks.index')"
                           class="px-4 py-2 border border-gray-300  text-gray-700  rounded-md hover:bg-gray-50 focus:outline-none transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Tasks
                        </Link>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white  rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50  border-b border-gray-200 ">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Task Information
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Description</p>
                                        <p class="text-gray-900">
                                            {{ task.description ?? 'No description provided' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Deadline</p>
                                        <p class="text-gray-900">
                                            {{ task.deadline_formatted ?? 'No deadline set' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200"
                                              :class="{'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': task.status === 'pending', 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': task.status === 'in_progress', 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': task.status === 'completed'}">
                                        {{ task.status }}
                                    </span>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Created</p>
                                        <p class="text-gray-900">
                                            {{ task.created_at_formatted }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white  rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50  border-b border-gray-200 ">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Assigned User
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Name</p>
                                        <p class="text-gray-900">{{ task.user.full_name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Email</p>
                                        <p class="text-gray-900">{{ task.user.email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Phone</p>
                                        <p class="text-gray-900 ">
                                            {{ task.user.phone_number ?? 'No phone number' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div  class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 ">
                            <h3 class="text-lg font-semibold text-gray-800  flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Client Information
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Company</p>
                                        <p class="text-gray-900">{{ task.project.client.company_name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Contact Person</p>
                                        <p class="text-gray-900">{{ task.project.client.contact_name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Email</p>
                                        <p class="text-gray-900">{{ task.project.client.contact_email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Phone</p>
                                        <p class="text-gray-900">
                                            {{ task.project.client.contact_phone_number ?? 'No phone number' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white  rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50  border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800  flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                Project Information
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-6">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Project</p>
                                        <p class="text-gray-900">
                                            {{ task.project.title ?? 'No project assigned' }}
                                        </p>
                                    </div>
                                </div>

                                <div v-if="task.project" class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 ">Project Status</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                            :class="{'bg-blue-100 text-blue-800': task.project.status === 'planning', 'bg-yellow-100 text-yellow-800': task.project.status === 'in progress', 'bg-green-100 text-green-800 ': task.project.status === 'completed', 'bg-red-100 text-red-800 ': task.project.status === 'on_hold'}">
                                            {{ task.project.status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="task.project.client.company_address || task.project.client.company_city" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50  border-b border-gray-200 ">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Company Address
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div class="text-gray-900">
                                <p v-if="task.project.client.company_address">{{ task.project.client.company_address }}</p>
                                <p v-if="task.project.client.company_city || task.project.client.company_zip">
                                    {{task.project.client.company_city}},
                                    {{task.project.client.company_zip}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

