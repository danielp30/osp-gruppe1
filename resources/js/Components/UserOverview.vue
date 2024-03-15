<template>
    <div class="flex flex-col">
        <h1 class="text-2xl pb-10">User Dashboard</h1>
        <div class="flex flex-col justify-center items-center">
            <div class="flex justify-between items-center m-5 w-full pb-5">
                <div>
                    <ModalRegistrations></ModalRegistrations>
                </div>
                <div>
                    <input type="text" v-model="searchQuery" placeholder="Suchen..." class="w-64 border-2 border-black focus:border-black">
                </div>
            </div>
            <UserTable :items="filteredItems"></UserTable>
        </div>
    </div>
</template>

<script setup>
import {ref, computed, onMounted} from 'vue';
import UserTable from '@/Components/UserTable.vue';
import axios from "axios";
import ModalRegistrations from "@/Components/ModalRegistrations.vue";

const combinedItems = ref([]);
const searchQuery = ref('');


onMounted(async () => {
    try {
        const response = await axios.get('/items');
        const { information_stands, lectures } = response.data;

        const informationStandsWithType = information_stands.map(item => {
            return { ...item, type: 'Stand' };
        });

        const lecturesWithType = lectures.map(item => {
            return { ...item, type: 'Vortrag' };
        });

        combinedItems.value = [...informationStandsWithType, ...lecturesWithType];
    } catch (error) {
        console.error('Error fetching items:', error);
    }
});



const filteredItems = computed(() => {
    return combinedItems.value.filter(item =>
        item.user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        item.date.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        item.type.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        item.status.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});
</script>


<script>
export default {
    components: {
        UserTable
    }
};
</script>
