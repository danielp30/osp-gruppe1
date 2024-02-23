<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
    <div class="flex flex-row bg-[#FFF7F1]">
        <sidebar></sidebar>
        <div class="p-12 w-3/5 bg-white w-screen rounded-xl m-12">
            <h1 class="text-2xl">Hallo Admin</h1>
        </div>
    </div>
</template>
