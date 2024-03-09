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
                    <div class="modal-body px-5 mx-5">
                        <p>Jahr:</p>
                        <p>Datum Freitag:</p>
                        <p>Datum Samstag:</p>
                        <p>Stand:</p>
                    </div>
                    <div class="modal-footer">
                        <div class="flex items-center justify-between my-10 ms-10">
                            <button type="button" class="btn btn-secondary" @click="toggleModal">Abbrechen</button>
                            <PrimaryButton class="me-10" style="background: #ffd4b5;">
                                <p class="text-black font-extrabold">Anmelden</p> <svg class="ms-2" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="black"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
                            </PrimaryButton>
                        </div>
                    </div>
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
