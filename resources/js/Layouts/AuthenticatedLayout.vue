<script setup lang="ts">
import {ref} from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import {Link} from '@inertiajs/vue3';
import Notification from "@/Components/Notification.vue";

const sidebarOpen = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-sm z-20 border-b border-gray-200">
            <div class="flex items-center justify-between h-16 px-4">
                <!-- Left side -->
                <div class="flex items-center">
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div class="ml-4 font-semibold text-xl text-blue-600">Laravel</div>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-4" v-if="$page.props.auth.user">
                    <!-- Notifications -->
                    <span
                        class="text-indigo-600 hover:text-indigo-900 relative"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </span>

                    <!-- Dropdown using your Dropdown component -->
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button
                                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                <span class="bg-gray-400 text-zinc-900 p-1 rounded-lg">
                  {{ $page.props.auth.user.first_name[0] + $page.props.auth.user.last_name[0] }}
                </span>
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </header>

        <!-- Sidebar + Main -->
        <div class="flex">
            <!-- Updated Sidebar -->
            <aside
                :class="{ 'w-64': sidebarOpen, 'w-16': !sidebarOpen }"
                class="bg-sidebar text-sidebar-foreground border-r border-gray-200 sidebar-transition h-screen"
            >
                <div class="h-full flex flex-col">
                    <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
                        <ul class="space-y-1 px-2">
                            <li>
                                <Link
                                    :href="route('dashboard')"
                                    class="flex items-center gap-3 px-3 py-2 rounded text-sm font-medium transition hover:bg-gray-200 "
                                    :class="{ 'bg-gray-300': route().current('dashboard') }"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z"/>
                                    </svg>
                                    <span v-show="sidebarOpen">Dashboard</span>
                                </Link>
                            </li>

                            <li v-if="$page.props.auth.permissions.includes('manage users')">
                                <Link
                                    :href="route('users.index')"
                                    class="flex items-center gap-3 px-3 py-2 rounded text-sm font-medium transition hover:bg-gray-200"
                                    :class="{ 'bg-gray-300': route().current('users.index') }"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 640 512">
                                        <path fill="currentColor"
                                              d="M144 0a80 80 0 1 1 0 160a80 80 0 1 1 0-160m368 0a80 80 0 1 1 0 160a80 80 0 1 1 0-160M0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96H21.3C9.6 320 0 310.4 0 298.7M405.3 320h-.7c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7c58.9 0 106.7 47.8 106.7 106.7c0 11.8-9.6 21.3-21.3 21.3H405.4zM224 224a96 96 0 1 1 192 0a96 96 0 1 1-192 0m-96 261.3c0-73.6 59.7-133.3 133.3-133.3h117.3c73.7 0 133.4 59.7 133.4 133.3c0 14.7-11.9 26.7-26.7 26.7H154.6c-14.7 0-26.7-11.9-26.7-26.7z"/>
                                    </svg>
                                    <span v-show="sidebarOpen">Users</span>
                                </Link>
                            </li>

                            <li>
                                <Link
                                    :href="route('clients.index')"
                                    class="flex items-center gap-3 px-3 py-2 rounded text-sm font-medium transition hover:bg-gray-200"
                                    :class="{ 'bg-gray-300': route().current('clients.index') }"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"><g
                                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5" color="currentColor"><path
                                        d="M15 2H9c-3.31 0-4 .69-4 4v16h14V6c0-3.31-.69-4-4-4M3 22h18"/><path
                                        d="M15 22v-3c0-1.655-.345-2-2-2h-2c-1.655 0-2 .345-2 2v3m4.5-16h-3m3 3.5h-3m3 3.5h-3"/></g></svg>
                                    <span v-show="sidebarOpen">Clients</span>
                                </Link>
                            </li>

                            <li>
                                <span
                                    class="flex items-center gap-3 px-3 py-2 rounded text-sm font-medium transition hover:bg-gray-200"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 512 512"><path
                                        fill="currentColor" fill-rule="evenodd"
                                        d="M256 85.334h170.666V128H256zm0 149.333h170.666v42.667H256zM85.332 341.334h106.666V448H85.333zm32 32V416h42.666v-42.666zM255.999 384h170.667v42.667H256zM189.815 46.126l25.364 19.51l-76.032 98.843l-68.617-60.04l21.072-24.082l42.968 37.574zm0 149.333l25.364 19.511l-76.032 98.842l-68.617-60.04l21.072-24.082l42.968 37.574z"/></svg>
                                    <span v-show="sidebarOpen">Tasks</span>
                                </span>
                            </li>

                            <li>
                                <Link
                                    :href="route('projects.index')"
                                    class="flex items-center gap-3 px-3 py-2 rounded text-sm font-medium transition hover:bg-gray-200"
                                    :class="{ 'bg-gray-300': route().current('projects.index') }"
                                >
                                   <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"><path
                                       fill="currentColor"
                                       d="M22 13.478V18a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-4.522l.553.277a21 21 0 0 0 18.897-.002zM14 2a3 3 0 0 1 3 3v1h2a3 3 0 0 1 3 3v2.242l-1.447.724a19 19 0 0 1-16.726.186l-.647-.32l-1.18-.59V9a3 3 0 0 1 3-3h2V5a3 3 0 0 1 3-3zm-2 8a1 1 0 0 0-1 1a1 1 0 1 0 2 .01c0-.562-.448-1.01-1-1.01m2-6h-4a1 1 0 0 0-1 1v1h6V5a1 1 0 0 0-1-1"/></svg>
                                    <span v-show="sidebarOpen">Projects</span>
                                </Link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Main -->
            <main
                  class="flex-1 transition-all duration-200 overflow-hidden">
                <Notification/>
                <slot/>
            </main>
        </div>
    </div>
</template>
