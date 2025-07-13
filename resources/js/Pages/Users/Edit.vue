<script setup lang="ts">
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Role} from "@/types/role";

interface User {
    id: string
    first_name: string
    last_name: string
    email: string
    password: string
    address: string
    phone_number: string
    roles: Role[]
    terms_accepted_at: string
}

const props = defineProps<{
    roles: Role[],
    user: User
}>();

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    password: props.user.password,
    address: props.user.address,
    phone_number: props.user.phone_number,
    role: props.user.roles.map(role => role.name).join(', '),
    terms_accepted: !!props.user.terms_accepted_at,
})

const createUser = () => {
    form.put(route('users.update', props.user.id));
}
</script>

<template>
    <Head title="Update User"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden mb-6">
            <div class="p-6">
                <form @submit.prevent="createUser" class="mt-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6 col-span-2">
                            <h3
                                class="text-lg font-medium text-gray-800  border-b border-gray-200 pb-2">
                                Update User</h3>
                        </div>

                        <div>
                            <InputLabel for="first_name" value="First Name" />

                            <TextInput
                                id="first_name"
                                v-model="form.first_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="first_name"
                            />

                            <InputError
                                :message="form.errors.first_name"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="last_name" value="Last Name" />

                            <TextInput
                                id="last_name"
                                v-model="form.last_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="last_name"
                            />

                            <InputError
                                :message="form.errors.last_name"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                autocomplete="email"
                            />

                            <InputError
                                :message="form.errors.email"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="address" value="Address" />

                            <TextInput
                                id="address"
                                v-model="form.address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="address"
                            />

                            <InputError
                                :message="form.errors.address"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="phone_number" value="Phone Number" />

                            <TextInput
                                id="phone_number"
                                v-model="form.phone_number"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="phone_number"
                            />

                            <InputError
                                :message="form.errors.phone_number"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="password"
                            />

                            <InputError
                                :message="form.errors.password"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <select id="role" name="role"
                                    v-model="form.role"
                                    class="w-full px-4 py-2 rounded-lg text-gray-700  bg-gray-50  border border-gray-300"
                            >
                                <option
                                    v-for="role in roles"
                                    :value="role.name"
                                    class="capitalize"
                                >
                                    {{role.name}}
                                </option>
                            </select>
                        </div>

                        <div>
                            <Checkbox v-model:checked="form.terms_accepted" id="terms_accepted" name="terms_accepted" />

                            <InputLabel for="terms_accepted" value="Terms Accepted" class="inline-flex ml-2" />
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-5 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-end space-x-3">
                            <Link :href="route('users.index')"
                                  class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                                Cancel
                            </Link>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
