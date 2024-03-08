<template>
    <div>
        <div class="flex flex-wrap items-center">
            <div class="w-full sm:w-1/2 md:w-1/4 mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Jahr:</label>
                <select id="year" v-model="filter.year"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option selected value="">Alle</option>
                    <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
                </select>
            </div>

            <div class="w-full sm:w-1/2 md:w-1/4 mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Unternehmensname:</label>
                <select v-model="filter.name" id="name"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option selected value="">Alle</option>
                    <option v-for="name in availableNames" :key="name" :value="name">{{ name }}</option>
                </select>
            </div>

            <div class="w-full sm:w-1/2 md:w-1/4 mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <select v-model="filter.status" id="status"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option selected value="">Alle</option>
                    <option value="genehmigt">Genehmigt</option>
                    <option value="abgelehnt">Abgelehnt</option>
                    <option value="offen">Offen</option>
                </select>
            </div>

            <div class="w-full sm:w-1/2 md:w-1/4 mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Datum:</label>
                <select v-model="filter.date" id="date"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option selected value="">Alle</option>
                    <option v-for="date in filteredDates" :key="date" :value="date">{{ formatDate(date) }}</option>
                </select>
            </div>
        </div>

        <!-- Button to generate PDF -->
        <button :disabled="!(Object.keys(items).length)" @click="filterItems"
            class="mt-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"><span
                v-if="Object.keys(items).length">PDF generieren</span>
            <span v-else>Lade...</span>
        </button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            filter: {
                year: new Date().getFullYear(),
                name: '',
                status: '',
                date: '',
            },
            items: [],
            dates: [],
            filteredDates: [],
            availableYears: [2020, 2021, 2022, 2023, 2024, 2025],
            availableNames: [],
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
        filteredLectures() {
            let lectures = this.items.lectures ?? [];

            let filteredLectures = lectures.filter(lecture => (this.filter.year ? (new Date(lecture.date).getFullYear() == this.filter.year) : true) && (this.filter.name ? (lecture.user.name == this.filter.name) : true) && (this.filter.status ? (lecture.status == this.filter.status) : true) && (this.filter.date ? (lecture.date == this.filter.date) : true))

            return filteredLectures;
        },
        filteredStands() {
            let stands = this.items.information_stands ?? [];

            let filteredStands = stands.filter(stand => (this.filter.year ? (new Date(stand.date).getFullYear() == this.filter.year) : true) && (this.filter.name ? (stand.user.name == this.filter.name) : true) && (this.filter.status ? (stand.status == this.filter.status) : true) && (this.filter.date ? (stand.date == this.filter.date) : true))

            return filteredStands;
        }
    },
    methods: {
        async fetchItems() {
            try {
                const response = await axios.get('/items?all=true');
                this.items = response.data;
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
                console.error('Error fetching items:', error);
            }
        },
        extractUserNames() {
            const uniqueNames = Array.from(new Set(
                this.items.information_stands.map(stand => stand.user.name)
                    .concat(this.items.lectures.map(lecture => lecture.user.name))
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