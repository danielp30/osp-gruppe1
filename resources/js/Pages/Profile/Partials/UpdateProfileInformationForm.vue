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
                Aktualisieren Sie die Profilinformationen und die E-Mail-Adresse Ihres Kontos.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Profilname" />

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
                <PrimaryButton :disabled="form.processing">Speichern</PrimaryButton>

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
