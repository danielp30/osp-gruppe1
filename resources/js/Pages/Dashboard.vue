<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from "@/Components/Sidebar.vue";
import Reports from "@/Components/Reports.vue";
import Overview from "@/Components/Overview.vue";
</script>
<script>
export default {
    props: {
       /* user: {
            type: [Object],
        },*/
    },
    data() {
        return {
            currentComponent: "overview",
        };
    },
    components: {
        Sidebar, Reports, Overview
    },
    computed: {},
    methods: {},
    mounted() {},
    watch: {},
};
</script>

<template>
    <div class="flex flex-row bg-[#FFF7F1]">
        <sidebar :user="user" @reports="currentComponent = 'reports'" @overview="currentComponent = 'overview'"></sidebar>
        <div class="p-12 w-3/5 bg-white w-screen rounded-xl m-12">
            <component :is="currentComponent"></component>
        </div>
    </div>
</template>
