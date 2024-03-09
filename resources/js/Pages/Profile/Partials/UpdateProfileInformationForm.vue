<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    contact: user.contact_person_name,
    phone: user.phone,
    fax: user.fax,
    logo: user.logo,
});

const handleLogoChange = (e) => {
    form.logo = e.target.files[0];
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profil Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Hier können Sie ihre Profilinformationen ändern.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Unternehmensname" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"

                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="E-Mail" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"

                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="contact" value="Ansprechperson" />

                <TextInput
                    id="contact"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.contactPersonName"
                />

                <InputError class="mt-2" :message="form.errors.contactPersonName" />
            </div>

            <div>
                <InputLabel for="phone" value="Telefon" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div>
                <InputLabel for="fax" value="Fax" />

                <TextInput
                    id="fax"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.fax"
                />

                <InputError class="mt-2" :message="form.errors.fax" />
            </div>

            <div>
                <InputLabel for="logo" value="Logo" />

                <input
                    id="logo"
                    type="file"
                    class="mt-1 block w-full"
                    @change="handleLogoChange"
                />

                <!-- Fehlermeldung für Logo -->
                <InputError class="mt-2" :message="form.errors.logo" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Klicken Sie hier, um die Bestätigungs-E-Mail erneut zu senden.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    Es wurde ein neuer Verifizierungslink an Ihre E-Mail-Adresse gesendet.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button :disabled="form.processing" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background: rgb(255, 212, 181);"><p class="text-black font-extrabold">Speichern</p> <svg class="ml-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="black"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"></path></svg></button>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Gespeichert.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
