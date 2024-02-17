<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-3 mt-10 font-extrabold text-3xl pl-8">
            <h1> Passwort vergessen?</h1>
        </div>

        <div class="text-sm text-gray-600 pl-8 mt-10">
            Passwort vergessen? Kein Problem! <br>
            Geben Sie einfach Ihre E-Mail-Adresse ein, und wir senden Ihnen einen Link zum Zurücksetzen des Passworts zu.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="p-8">
            <div class="mb-20">
                <InputLabel for="email" value="E-Mail" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" style="background: #ffd4b5;">
                    <p class="text-black font-extrabold">Bestätigen</p> <svg class="ml-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="black"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
