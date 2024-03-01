<script setup>
import { MoreHorizontal } from 'lucide-vue-next';
import DropdownLink from '@/Components/DropdownLink.vue';
import DangerButton from "../../../vendor/laravel/breeze/stubs/inertia-vue-ts/resources/js/Components/DangerButton.vue";
</script>
<template>
    <table class="border border-2 border-black w-full m-5 rounded-xl">
        <thead class="border border-2 border-black">
        <tr class="text-up">
            <th class="px-6 py-3 text-left">Jahr</th>
            <th class="px-6 py-3 text-left">Datum Freitag</th>
            <th class="px-6 py-3 text-left">Datum Samtag</th>
            <th class="px-6 py-3 text-left">Stand</th>
            <th class="px-6 py-3 text-left"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="px-6 py-4 ">2024</td>
            <th class="px-6 py-3 text-left">02-03-2024</th>
            <th class="px-6 py-3 text-left">-</th>
            <td class="px-6 py-4 ">C10</td>
            <td class="px-6 py-4"><button>Anmelden</button></td>
        </tr>
        <tr>
            <td class="px-6 py-4 ">2023</td>
            <th class="px-6 py-3 text-left">04-03-2023</th>
            <th class="px-6 py-3 text-left">-</th>
            <td class="px-6 py-4 ">C10</td>
            <td class="px-6 py-4 "><button>Anmelden</button></td>
        </tr>
        </tbody>
    </table>
</template>
