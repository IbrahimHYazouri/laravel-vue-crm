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
          <div class="ms-auto">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <button
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        {{ $page.props.auth.user.name }}
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
                class="fixed bottom-0 top-[58px] bg-gray-200 p-4 overflow-y-auto"
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
            </aside>

            <main
                class="flex-1 ml-64 py-6"
                :class="{'ml-64': sidebarOpen, 'ml-10': !sidebarOpen}"
            >
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
