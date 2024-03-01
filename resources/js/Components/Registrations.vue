<script>
import Table from "@/Components/RegistrationsTable.vue";
import {defineComponent} from "vue";
import RegistrationsTable from "@/Components/RegistrationsTable.vue";
import DangerButton from "../../../vendor/laravel/breeze/stubs/inertia-vue-ts/resources/js/Components/DangerButton.vue";

export default defineComponent({
    components: {DangerButton, RegistrationsTable, Table}
})

</script>
<template>
    <div>
        <h1 class="text-2xl pb-10">Anmeldungen</h1>
        <RegistrationsTable></RegistrationsTable>
    </div>
</template>
