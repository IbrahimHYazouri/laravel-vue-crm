<script setup lang="ts">
import {Client} from "@/types/client";
import {Link, useForm} from "@inertiajs/vue3";
import {computed} from "vue";
import FormField from "@/Components/molecules/FormField.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps<{
    client?: Client,
    cancelUrl: string
    submitUrl: string
    method?: 'post' | 'put'
}>()

const form = useForm({
    contact_name: props.client?.contact_name || '',
    contact_email: props.client?.contact_email || '',
    contact_phone_number: props.client?.contact_phone_number || '',
    company_name: props.client?.company_name || '',
    company_address: props.client?.company_address || '',
    company_city: props.client?.company_city || '',
    company_zip: props.client?.company_zip || '',
    company_vat: props.client?.company_vat || ''
});
const isEdit = computed(() => !!props.client);

function submit() {
    form[isEdit.value ? 'put' : 'post'](props.submitUrl)
}
</script>

<template>
    <form @submit.prevent="submit" class="p-6 space-y-6">
        <h3 class="text-lg mb-4">{{ isEdit ? 'Edit' : 'Create' }} User</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <FormField id="contact_name" value="Contact Name" :error="form.errors.contact_name">
                <TextInput
                    id="contact_name"
                    v-model="form.contact_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="contact_name"
                />
            </FormField>

            <FormField id="contact_phone_number" value="Contact Phone number" :error="form.errors.contact_phone_number">
                <TextInput
                    id="contact_phone_number"
                    v-model="form.contact_phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="contact_phone_number"
                />
            </FormField>

            <FormField id="contact_email" value="Contact Email" :error="form.errors.contact_email">
                <TextInput
                    id="contact_email"
                    v-model="form.contact_email"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="contact_email"
                />
            </FormField>

            <FormField id="company_name" value="Company Name" :error="form.errors.company_name">
                <TextInput
                    id="company_name"
                    v-model="form.company_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="company_name"
                />
            </FormField>

            <FormField id="company_address" value="Company address" :error="form.errors.company_address">
                <TextInput
                    id="company_address"
                    v-model="form.company_address"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="company_address"
                />
            </FormField>

            <FormField id="company_city" value="Company city" :error="form.errors.company_city">
                <TextInput
                    id="company_city"
                    v-model="form.company_city"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="company_city"
                />
            </FormField>

            <FormField id="company_zip" value="Company zip" :error="form.errors.company_zip">
                <TextInput
                    id="company_zip"
                    v-model="form.company_zip"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="company_zip"
                />
            </FormField>

            <FormField id="company_vat" value="Company vat" :error="form.errors.company_vat">
                <TextInput
                    id="company_vat"
                    v-model="form.company_vat"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="company_vat"
                />
            </FormField>
        </div>

        <div class="mt-8 pt-5 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <Link :href="cancelUrl"
                      class="px-4 py-2 border border-gray-300  rounded-md shadow-sm text-sm font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none">
                    Cancel
                </Link>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    {{ isEdit ? 'Save Changes' : 'Create' }}
                </button>
            </div>
        </div>
    </form>
</template>
