    <script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout class="p-5">
        <Head title="Log in" />


        <div class="mb-3 mt-10 font-extrabold text-3xl pl-8">
            <h1> Anmeldung</h1>
        </div>

        <form @submit.prevent="submit" class="p-8">
            <div class="mb-10">
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

            <div class="mt-4">
                <InputLabel for="password" value="Passwort" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4 mb-20">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Passwort vergessen?
                </Link>
            </div>

            <div class="flex items-center justify-between mt-4 mb-10">
                <!-- Linker Button -->
                <ButtonLink :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <p class="text-black font-extrabold">Registrierung</p>
                </ButtonLink>

                <!-- Rechter Button -->
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" style="background: #ffd4b5;">
                    <p class="text-black font-extrabold">Anmelden</p> <svg class="ml-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="black"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
                </PrimaryButton>
            </div>

        </form>
    </GuestLayout>
</template>
