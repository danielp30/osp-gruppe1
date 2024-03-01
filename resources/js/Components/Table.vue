<script setup>
import { MoreHorizontal } from 'lucide-vue-next';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>
<template>
    <table class="border border-2 border-black w-full m-5 rounded-xl">
        <thead class="border border-2 border-black">
        <tr class="text-up">
            <th class="px-6 py-3 text-left">Unternehmen</th>
            <th class="px-6 py-3 text-left">Datum</th>
            <th class="px-6 py-3 text-left">Vortrag</th>
            <th class="px-6 py-3 text-left">Stand</th>
            <th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-left"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="px-6 py-4 ">Appox GmbH.</td>
            <td class="px-6 py-4 ">23-02-2024</td>
            <td class="px-6 py-4 ">Ja</td>
            <td class="px-6 py-4 ">C10</td>
            <td class="px-6 py-4 ">Genehmigt</td>
            <td class="px-6 py-4"><MoreHorizontal/></td>
        </tr>
        </tbody>
    </table>
</template>
