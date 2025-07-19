<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";

const form = useForm({
    accept_terms: false
});

const submit = () => {
    form.post(route('terms.store'))
}
</script>

<template>
    <Head title="Terms of Service"/>

    <AuthenticatedLayout>
        <div class="bg-white  rounded-lg shadow-md border border-gray-200  overflow-hidden m-4">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Terms of Service</h1>

                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam commodi culpa cum doloribus, illum
                    in
                    iure iusto, numquam odio quam quibusdam quo repellendus sit, velit. Harum minima nobis recusandae?
                </p>

                <div v-if="$page.props.errors.length > 0" class="mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            <li v-for="error in $page.props.errors">{{error}}</li>
                        </ul>
                    </div>
                </div>

                <form @submit.prevent="submit" class="space-y-4 mt-4">
                    <div>
                        <Checkbox v-model:checked="form.accept_terms" id="accept_terms" name="accept_terms" />

                        <InputLabel for="accept_terms" value="I accept the terms of service" class="inline-flex ml-2" />
                    </div>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Accept
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
