<script>
import Sidebar from "@/Components/Sidebar.vue";
import Reports from "@/Components/Reports.vue";
import AdminOverview from "@/Components/AdminOverview.vue";
import UserOverview from "@/Components/UserOverview.vue";
import Registrations from "@/Components/Registrations.vue";

export default {
    props: {
        auth: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            currentComponent: this.auth.user.is_admin ? "adminOverview" : "userOverview"
        };
    },
    methods: {
        handleComponentChange(value) {
            this.currentComponent = value;
        }
    },
    components: {
        Sidebar, Reports, AdminOverview, UserOverview, Registrations
    }
};
</script>

<template>
    <div class="flex flex-row bg-[#FFF7F1]">
        <sidebar :user="auth.user" @input="handleComponentChange"></sidebar>
        <div class="p-12 w-3/5 bg-white w-screen rounded-xl m-12">
            <reports v-if="currentComponent === 'reports'"></reports>
            <admin-overview v-if="currentComponent === 'adminOverview'"></admin-overview>
            <user-overview v-if="currentComponent === 'userOverview'"></user-overview>
            <registrations v-if="currentComponent === 'registrations'"></registrations>
        </div>
    </div>
</template>
