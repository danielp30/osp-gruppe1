<template>
    <div>
        <div>
            <!-- Modal Background -->
            <div v-show="isModalOpen" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 z-50"></div>

            <!-- Modal -->
            <div v-show="isModalOpen"
                 class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 rounded-lg z-50">
                <h2 class="text-xl font-bold mb-4">Edit Item</h2>
                <form @submit.prevent="submitForm">
                    <!-- Your form fields for editing item details -->
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Item Name:</label>
                        <input v-model="editedItem.name" type="text"
                               class="w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <!-- Add other fields as needed -->

                    <div class="flex justify-end">
                        <button type="button" @click="cancelEdit" class="px-4 py-2 bg-gray-300 rounded-md mr-2">Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save Changes</button>
                    </div>
                </form>
            </div>
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
                    <td class="px-6 py-4">{{ item.type }}</td>
                    <td class="px-6 py-4">{{ item.status }}</td>
                    <td class="px-6 py-4">
                        <div class="relative">
                            <MoreHorizontal @click="toggleDropdown(index)" class="cursor-pointer"/>
                            <div v-if="showDropdown === index"
                                 class="dropdown-menu absolute right-0 mt-2 w-48 bg-white border-2 border-black z-10">
                                <ul>
                                    <li @click="edit(index.items)"
                                        class="py-2 px-4 block text-gray-800 hover:bg-black hover:text-white cursor-pointer">
                                        Bearbeiten
                                    </li>
                                    <li @click="cancel(index.items)"
                                        class="py-2 px-4 block text-gray-800 hover:bg-black hover:text-white cursor-pointer">
                                        Stornieren
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script setup>
import { MoreHorizontal } from 'lucide-vue-next';
import { ref } from 'vue';

const isModalOpen = ref(false);
const editedItem = ref(null); // Initialize editedItem with null

const toggleModal = (item) => {
    editedItem.value = item;
    isModalOpen.value = !isModalOpen.value;
};

const submitForm = () => {
    // Here you can submit the edited item to your backend API
    console.log("Submitting edited item:", editedItem.value);
    // You can add your API call here
    isModalOpen.value = false; // Close the modal after submission
};

const cancelEdit = () => {
    // Reset the editedItem and close the modal
    editedItem.value = null;
    isModalOpen.value = false;
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
        return {showDropdown, toggleDropdown, editItem, deleteItem};
    }
};
</script>
