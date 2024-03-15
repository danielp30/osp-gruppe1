<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';


const form = useForm({
    date: '',
    lecture_title: '',
    note: '',
    errors: {},
});

const submitForm = async () => {
    try {
        const response = await axios.post('/items', form);
        console.log(response.data.message);
        // Reset the form after successful submission
        form.reset();
    } catch (error) {
        if (error.response && error.response.status === 422) {
            // Handle validation errors
            form.errors = error.response.data.errors;
        } else {
            console.error('Error submitting form:', error);
        }
    }
};

</script>


<template>
    <div>
        <!-- Trigger Button -->
        <div class="flex justify-center items-center">
            <button
                type="button"
                @click="toggleModal"
                class="bg-black p-4 text-white hover:bg-white hover:text-black border-black border-2 transition-all">
                Neue Anmeldung
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
                    <form @submit.prevent="submitForm">
                        <div class="modal-body px-5 mx-5">
                            <div class="flex py-5">
                                <div class="flex-1">
                                    <InputLabel for="date" value="Datum" />
                                    <TextInput
                                        id="date"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="form.date"
                                        required
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.date" />
                                </div>
                            </div>

                            <div class="flex py-5">
                                <div class="mt-3 block w-full">
                                    <label class="me-5">
                                        <input class="me-2" type="radio" name="lecture" value="ja" v-model="form.lecture" required>
                                        Ja
                                    </label>
                                    <label>
                                        <input class="me-2" type="radio" name="lecture" value="nein" v-model="form.lecture">
                                        Nein
                                    </label>
                                </div>

                                <div class="flex-1">
                                    <InputLabel for="lecture_title" value="Titel des Vortrags" />
                                    <TextInput
                                        id="lecture_title"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.lecture_title"
                                        autocomplete="off"
                                    />
                                    <InputError class="mt-2" :message="form.errors.lecture_title" />
                                </div>
                            </div>

                            <div class="flex py-5">
                                <div class="flex-1 w-full ">
                                    <InputLabel for="notice" class="mb-1" value="Informationen / Notizen:" />
                                    <textarea v-model="form.note"  class="resize rounded-md w-full font-medium text-sm text-gray-700 h-40" placeholder="Wir bitten Sie, uns im Voraus die gewünschten Maße Ihres Standes sowie spezielle Ausstattungswünsche mitzuteilen, z.B.: Standgröße 4x4 Meter, Anzahl der benötigten Stromanschlüsse (4x), Anzahl der Verlängerungskabel (2x) usw."></textarea>
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

