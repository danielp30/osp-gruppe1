<template>
    <table class="border border-2 border-black w-full rounded-xl">
        <thead class="border border-2 border-black">
        <tr class="text-up">
            <td><input type="checkbox" class="border-black border-2 m-2"/></td>
            <th class="px-6 py-3 text-left">Unternehmen</th>
            <th class="px-6 py-3 text-left">Datum</th>
            <th class="px-6 py-3 text-left">Art</th>
            <th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-left"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in items" :key="index">
            <td><input type="checkbox" class="border-black border-2 m-2"/></td>
            <td class="px-6 py-4">{{ item.user.name }}</td>
            <td class="px-6 py-4">{{ item.date }}</td>
            <td class="px-6 py-4">{{ item.type}}</td>
            <td class="px-6 py-4">{{ item.status }}</td>
            <td class="px-6 py-4">
                <div class="relative">
                    <MoreHorizontal @click="toggleDropdown(index)" class="cursor-pointer" />
                    <div v-if="showDropdown === index" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white border-2 border-black z-10">
                        <ul>
                            <li @click="edit(index, items)" class="py-2 px-4 block text-gray-800 hover:bg-black hover:text-white cursor-pointer">Genehmigen</li>
                            <li @click="reject(index, items)" class="py-2 px-4 block text-gray-800 hover:bg-black hover:text-white cursor-pointer">Ablehnen</li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>


<script setup>
import { MoreHorizontal } from 'lucide-vue-next';
import { ref } from 'vue';

const showDropdown = ref(null);

const toggleDropdown = (index) => {
    showDropdown.value = showDropdown.value === index ? null : index;
};

const approve = async (index, items) => {
    try {
        const itemId = items[index].id;
        await axios.put(`/items/${itemId}/approve`);
        items[index].status = 'genehmigt';
    } catch (error) {
        console.error('Error approving item:', error);
    }
};

const reject = async (index, items) => {
    try {
        const itemId = items[index].id;
        await axios.put(`/items/${itemId}/reject`);
        items[index].status = 'abgelehnt';
    } catch (error) {
        console.error('Error rejecting item:', error);
    }
};
</script>

<script>
export default {
    props: {
        items: {
            type: Array,
            default: () => [],
        },
    },
    setup() {
        return { showDropdown, toggleDropdown, editItem, deleteItem };
    }
};
</script>
