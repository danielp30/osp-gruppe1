<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});
</script>


<template>
    <div>
        <!-- Trigger Button -->
            <div class="flex justify-center items-center">
            <button
                type="button"
                @click="toggleModal"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                style="background: rgb(255, 212, 181); color: black;">
                Neue Anmeldung vornehmen
            </button>
        </div>

        <!-- Modal Overlay -->
        <div v-if="isVisible" class="modal-overlay" @click="toggleModal">
            <!-- Modal -->
            <div class="modal-dialog" @click.stop>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title text-2xl pb-10 p-5 m-5">Neue Anmeldung vornehmen</h1>
                        <button type="button" class="btn-close" @click="toggleModal"></button>
                    </div>
                    <form action="">
                        <div class="modal-body px-5 mx-5">
                            <div class="flex mb-5">
                                <div class="flex-1 mr-10">
                                    <InputLabel for="year" value="Jahr" />
                                    <TextInput
                                        id="year"
                                        type="number"
                                        class="mt-1 block w-full"
                                        v-model="form.year"
                                        required
                                        autofocus
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.year" />
                                </div>
                                <div class="flex-1">
                                    <InputLabel for="status" value="Stand" />
                                    <TextInput
                                        id="status"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.status"
                                        required
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.status" />
                                </div>
                            </div>

                            <div class="flex py-5">
                                <div class="flex-1 mr-10">
                                    <InputLabel for="date-friday" value="Datum Freitag" />
                                    <TextInput
                                        id="date-friday"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="form.dateFriday"
                                        required
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.dateFriday" />
                                </div>

                                <div class="flex-1">
                                    <InputLabel for="date-saturday" value="Datum Samstag" />
                                    <TextInput
                                        id="date-saturday"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="form.dateSaturday"
                                        required
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.dateSaturday" />
                                </div>
                            </div>

                            <div class="flex py-5">
                                <div class="flex-1 mr-10">
                                    <InputLabel for="lecture" value="Vortrag" />
                                    <div class="mt-3 block w-full">
                                        <label class="me-5">
                                            <input class="me-2" type="radio" name="lecture" value="yes" v-model="form.lecture" required>
                                            Ja
                                        </label>
                                        <label>
                                            <input class="me-2" type="radio" name="lecture" value="no" v-model="form.lecture">
                                            Nein
                                        </label>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.lecture" />
                                </div>
                                <div class="flex-1">
                                    <InputLabel for="lecture_title" value="Titel des Vortrags" />
                                    <TextInput
                                        id="lecture_title"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.lecture_title"
                                        required
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.lecture_title" />
                                </div>
                            </div>

                            <div class="flex py-5">
                                <div class="flex-1 w-full ">
                                    <InputLabel for="notice" class="mb-1" value="Informationen / Notizen:" />
                                    <textarea class="resize rounded-md w-full font-medium text-sm text-gray-700 h-40" placeholder="Wir bitten Sie, uns im Voraus die gewünschten Maße Ihres Standes sowie spezielle Ausstattungswünsche mitzuteilen, z.B.: Standgröße 4x4 Meter, Anzahl der benötigten Stromanschlüsse (4x), Anzahl der Verlängerungskabel (2x) usw."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="flex items-center justify-between my-10 ms-10">
                                <button type="button" class="btn btn-secondary" @click="toggleModal">Abbrechen</button>
                                <PrimaryButton class="me-10" style="background: #ffd4b5;">
                                    <p class="text-black font-extrabold">Anmelden</p> <svg class="ms-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="black"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    components: {PrimaryButton},
    data() {
        return {
            isVisible: false,
        };
    },
    methods: {
        toggleModal() {
            this.isVisible = !this.isVisible;
        },
    },
};
</script>

<style>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}

.modal-dialog {
    background: white;
    border-radius: 5px;
    max-width: 500px;
    width: 100%;
}

.modal-dialog .modal-content {
    position: relative;
}

.btn-close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    border: none;
    background: transparent;
    cursor: pointer;
}
</style>
