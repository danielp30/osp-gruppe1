<script>
import Table from "@/Components/RegistrationsTable.vue";
import {defineComponent} from "vue";
import RegistrationsTable from "@/Components/RegistrationsTable.vue";
import DangerButton from "../../../vendor/laravel/breeze/stubs/inertia-vue-ts/resources/js/Components/DangerButton.vue";
import ModalRegistrations from "@/Components/ModalRegistrations.vue";

export default defineComponent({
    components: {ModalRegistrations, DangerButton, RegistrationsTable, Table}
})

</script>
<template>
    <div>
        <h1 class="text-2xl pb-10">Anmeldungen</h1>
        <RegistrationsTable></RegistrationsTable>
        <ModalRegistrations></ModalRegistrations>
    </div>
</template>
