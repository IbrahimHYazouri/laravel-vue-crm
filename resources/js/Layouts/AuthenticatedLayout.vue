<script setup lang="ts">
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

const sidebarOpen = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
      <nav class="flex justify-between items-center p-3 border-b shadow-sm">
          <div class="flex items-center">
              <div
                  @click="sidebarOpen = !sidebarOpen"
                  class="w-8 h-8 rounded flex items-center justify-center mr-3 cursor-pointer">
                  <svg
                      class="size-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                  </svg>
              </div>
              <h3 class="text-indigo-600 font-bold text-lg">Laravel</h3>
          </div>
          <div class="ms-auto" v-if="$page.props.auth.user">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        <span class="bg-gray-400 text-zinc-900 p-1 rounded-lg">{{ $page.props.auth.user.first_name[0] + $page.props.auth.user.last_name[0] }}</span>
                        <svg
                            class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
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
      </nav>

        <div class="flex">
            <aside
                :class="{'w-64': sidebarOpen, 'w-15': !sidebarOpen}"
                class="fixed bottom-0 top-[58px] bg-gray-200 p-4 overflow-y-auto flex flex-col gap-3"
            >
                <Link
                  :href="route('dashboard')"
                  class="flex items-center gap-3 text-gray-700 hover:bg-zinc-700 hover:text-white rounded transition-colors duration-150"
                  :class="{'bg-zinc-700 text-white': route().current('dashboard'), 'px-3 py-1': sidebarOpen, 'p-2 justify-center': !sidebarOpen}"
                >
                    <svg class="size-5 text-inherit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
                    </svg>
                    <p v-show="sidebarOpen">Dashboard</p>
                </Link>
                <Link
                    :href="route('users.index')"
                    class="flex items-center gap-3 text-gray-700 hover:bg-zinc-700 hover:text-white rounded transition-colors duration-150"
                    :class="{'bg-zinc-700 text-white': route().current('users.index'), 'px-3 py-1': sidebarOpen, 'p-2 justify-center': !sidebarOpen}"
                >
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M144 0a80 80 0 1 1 0 160a80 80 0 1 1 0-160m368 0a80 80 0 1 1 0 160a80 80 0 1 1 0-160M0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96H21.3C9.6 320 0 310.4 0 298.7M405.3 320h-.7c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7c58.9 0 106.7 47.8 106.7 106.7c0 11.8-9.6 21.3-21.3 21.3H405.4zM224 224a96 96 0 1 1 192 0a96 96 0 1 1-192 0m-96 261.3c0-73.6 59.7-133.3 133.3-133.3h117.3c73.7 0 133.4 59.7 133.4 133.3c0 14.7-11.9 26.7-26.7 26.7H154.6c-14.7 0-26.7-11.9-26.7-26.7z"/></svg>
                    <p v-show="sidebarOpen">Users</p>
                </Link>
            </aside>

            <main
                class="flex-1"
                :class="{'ml-64': sidebarOpen, 'ml-14': !sidebarOpen}"
            >
                <slot />
            </main>
        </div>
    </div>
</template>
