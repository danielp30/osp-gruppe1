<template>
    <div class="flex flex-col">
        <h1 class="text-2xl pb-10">Admin Dashboard</h1>
        <div class="flex flex-col justify-center items-center">

            <div class="flex justify-between pb-5 w-full">
                <button :disabled="!(Object.keys(combinedItems).length)" @click="console.log(filteredItems)"
                        class="bg-black p-4 text-white hover:bg-white hover:text-black border-black border-2 transition-all">
                    <span
                        v-if="Object.keys(combinedItems).length">PDF generieren</span>
                    <span v-else>Lade...</span>
                </button>
                <input type="text" v-model="searchQuery" placeholder="Suchen..."
                    class="w-64 border-2 border-black focus:border-black">
            </div>

            <div class="flex flex-wrap justify-between w-full">
                <div class="w-full sm:w-1/2 md:w-1/4 mb-4 px-2">
                    <label for="year" class="block text-sm font-medium text-gray-700">Jahr:</label>
                    <select id="year" v-model="filter.year"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option selected value="">Alle</option>
                        <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
                    </select>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/4 mb-4 px-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Unternehmensname:</label>
                    <select v-model="filter.name" id="name"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option selected value="">Alle</option>
                        <option v-for="name in availableNames" :key="name" :value="name">{{ name }}</option>
                    </select>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/4 mb-4 px-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                    <select v-model="filter.status" id="status"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option selected value="">Alle</option>
                        <option value="genehmigt">Genehmigt</option>
                        <option value="abgelehnt">Abgelehnt</option>
                        <option value="offen">Offen</option>
                    </select>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/4 mb-4 px-2">
                    <label for="date" class="block text-sm font-medium text-gray-700">Datum:</label>
                    <select v-model="filter.date" id="date"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option selected value="">Alle</option>
                        <option v-for="date in filteredDates" :key="date" :value="date">{{ formatDate(date) }}</option>
                    </select>
                </div>
            </div>
            <Table :items="filteredItems"></Table>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
import Table from '@/Components/Table.vue';

export default {
    components: {
        Table,
    },
    data() {
        return {
            filter: {
                year: new Date().getFullYear(),
                name: '',
                status: '',
                date: '',
            },
            combinedItems: [],
            dates: [],
            filteredDates: [],
            availableYears: [2020, 2021, 2022, 2023, 2024, 2025],
            availableNames: [],
            searchQuery: ''
        };
    },
    watch: {
        filter: {
            handler() {
                this.filterDates();
            },
            deep: true
        }
    },
    computed: {
        filteredItems() {
            const filteredBySearch = this.combinedItems.filter(item =>
                item.user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.date.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.type.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                item.status.toLowerCase().includes(this.searchQuery.toLowerCase())
            );

            const filteredByFilters = filteredBySearch.filter(item =>
                (this.filter.year ? new Date(item.date).getFullYear() === this.filter.year : true) &&
                (this.filter.name ? item.user.name === this.filter.name : true) &&
                (this.filter.status ? item.status === this.filter.status : true) &&
                (this.filter.date ? item.date === this.filter.date : true)
            );

            return filteredByFilters;
        }
    },
    methods: {
        async fetchItems() {
            try {
                const response = await axios.get('/items?all=true');
                const { information_stands, lectures } = response.data;

                const informationStandsWithType = information_stands.map(item => {
                    return { ...item, type: 'Stand' };
                });

                const lecturesWithType = lectures.map(item => {
                    return { ...item, type: 'Vortrag' };
                });

                console.log(lecturesWithType);

                this.combinedItems = [...informationStandsWithType, ...lecturesWithType];
                this.extractUserNames();
            } catch (error) {
                console.error('Error fetching items:', error);
            }
        },
        async fetchDates() {
            try {
                const response = await axios.get('/registrations');
                this.dates = response.data;
                this.filterDates();
            } catch (error) {
                console.error('Error fetching dates:', error);
            }
        },
        extractUserNames() {
            const uniqueNames = Array.from(new Set(
                this.combinedItems.map(item => item.user.name)
            ));
            this.availableNames = uniqueNames;
        },
        filterDates() {
            const currentYear = this.filter.year;
            this.filteredDates = [];
            this.dates.forEach(registration => {
                if (new Date(registration.date_friday).getFullYear() === currentYear) {
                    this.filteredDates.push(registration.date_friday);
                }
                if (new Date(registration.date_saturday).getFullYear() === currentYear) {
                    this.filteredDates.push(registration.date_saturday);
                }
            });
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('de-DE', options);
        },
    },
    mounted() {
        this.fetchItems();
        this.fetchDates();
    },
};
</script>
