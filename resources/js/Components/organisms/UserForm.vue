<script setup lang="ts">
import {Role} from "@/types/role";
import {Link, useForm} from "@inertiajs/vue3";
import {computed} from "vue";
import {User} from "@/types";
import FormField from "@/Components/molecules/FormField.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps<{
    user?: User,
    roles: Role[],
    cancelUrl: string
    submitUrl: string
    method?: 'post' | 'put'
}>();

const form = useForm({
    first_name: props.user?.first_name || '',
    last_name: props.user?.last_name || '',
    email: props.user?.email || '',
    password: props.user?.password || '',
    address: props.user?.address || '',
    phone_number: props.user?.phone_number || '',
    role: props.user?.roles.map(role => role.name).join(', ') || '',
    terms_accepted: !!props.user?.terms_accepted_at || false,
});

const isEdit = computed(() => !!props.user);

function submit() {
    form[isEdit.value ? 'put' : 'post'](props.submitUrl)
}
</script>

<template>
    <form @submit.prevent="submit" class="p-6 space-y-6">
        <h3 class="text-lg mb-4">{{ isEdit ? 'Edit' : 'Create' }} User</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <FormField id="first_name" value="First Name" :error="form.errors.first_name">
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="first_name"
                />
            </FormField>

            <FormField id="last_name" value="Last Name" :error="form.errors.last_name">
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="last_name"
                />
            </FormField>

            <FormField id="email" value="Email" :error="form.errors.email">
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    autocomplete="email"
                />
            </FormField>

            <FormField id="address" value="address" :error="form.errors.address">
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="address"
                />
            </FormField>

            <FormField id="phone_number" value="Phone Number" :error="form.errors.phone_number">
                <TextInput
                    id="phone_number"
                    v-model="form.phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="phone_number"
                />
            </FormField>

            <FormField id="password" value="Password" :error="form.errors.password">
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="password"
                />
            </FormField>

            <FormField id="role" value="Role" :error="form.errors.role">
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
            </FormField>

            <div>
                <Checkbox v-model:checked="form.terms_accepted" id="terms_accepted" name="terms_accepted" />

                <InputLabel for="terms_accepted" value="Terms Accepted" class="inline-flex ml-2" />
            </div>
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

