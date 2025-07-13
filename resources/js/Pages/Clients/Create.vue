<script setup lang="ts">
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const form = useForm({
    contact_name: '',
    contact_email: '',
    contact_phone_number: '',
    company_name: '',
    company_address: '',
    company_city: '',
    company_zip: '',
    company_vat: '',
})

const createClient = () => {
    form.post(route('clients.store'));
}
</script>

<template>
    <Head title="Create Client"/>

    <AuthenticatedLayout>
        <div
            class="bg-white  rounded-lg shadow-sm border border-gray-200  overflow-hidden mb-6">
            <div class="p-6">
                <form @submit.prevent="createClient" class="mt-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6 col-span-2">
                            <h3
                                class="text-lg font-medium text-gray-800  border-b border-gray-200 pb-2">
                                Create User</h3>
                        </div>

                        <div>
                            <InputLabel for="contact_name" value="Contact Name" />

                            <TextInput
                                id="contact_name"
                                v-model="form.contact_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="contact_name"
                            />

                            <InputError
                                :message="form.errors.contact_name"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="contact_email" value="Contact email" />

                            <TextInput
                                id="contact_email"
                                v-model="form.contact_email"
                                type="email"
                                class="mt-1 block w-full"
                                autocomplete="contact_email"
                            />

                            <InputError
                                :message="form.errors.contact_email"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="contact_phone_number" value="Contact Phone Number" />

                            <TextInput
                                id="contact_phone_number"
                                v-model="form.contact_phone_number"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="contact_phone_number"
                            />

                            <InputError
                                :message="form.errors.contact_phone_number"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="company_name" value="Company Name" />

                            <TextInput
                                id="company_name"
                                v-model="form.company_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="company_name"
                            />

                            <InputError
                                :message="form.errors.company_name"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="company_address" value="Company Address" />

                            <TextInput
                                id="company_address"
                                v-model="form.company_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="company_address"
                            />

                            <InputError
                                :message="form.errors.company_address"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="company_city" value="Company City" />

                            <TextInput
                                id="company_city"
                                v-model="form.company_city"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="company_city"
                            />

                            <InputError
                                :message="form.errors.company_city"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="company_zip" value="Company ZIP" />

                            <TextInput
                                id="company_zip"
                                v-model="form.company_zip"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="company_zip"
                            />

                            <InputError
                                :message="form.errors.company_city"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="company_vat" value="Company Vat" />

                            <TextInput
                                id="company_vat"
                                v-model="form.company_vat"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="company_vat"
                            />

                            <InputError
                                :message="form.errors.company_vat"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-5 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <Link :href="route('users.index')"
                                  class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                                Cancel
                            </Link>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Create Client
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
