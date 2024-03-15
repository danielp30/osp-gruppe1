<script>
import Table from "@/Components/RegistrationsTable.vue";
import {defineComponent} from "vue";
import RegistrationsTable from "@/Components/RegistrationsTable.vue";
import DangerButton from "../../../vendor/laravel/breeze/stubs/inertia-vue-ts/resources/js/Components/DangerButton.vue";
import ModalRegistrations from "@/Components/ModalRegistrations.vue";
import {Head} from "@inertiajs/vue3";
import UserTable from "@/Components/UserTable.vue";

export default defineComponent({
    components: {UserTable, Head, ModalRegistrations, DangerButton, RegistrationsTable, Table}
})

</script>

<template>
    <Head title="Anmeldungen" />
    <div class="flex flex-col">
        <h1 class="text-2xl pb-10">Anmeldungen</h1>
        <div class="flex flex-col justify-center items-center">
            <div class="flex justify-between items-center w-full pb-5">
                <div>
                    <ModalRegistrations></ModalRegistrations>
                </div>
                <div>
                    <input type="text" v-model="searchQuery" placeholder="Suchen..." class="w-64 border-2 border-black focus:border-black">
                </div>
            </div>
            <RegistrationsTable></RegistrationsTable>
        </div>
    </div>
</template>

