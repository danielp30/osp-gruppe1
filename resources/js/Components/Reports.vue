<template>
    <div>
        <div class="flex flex-wrap items-center">
            <div class="w-full sm:w-1/2 md:w-1/4 mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Jahr:</label>
                <select id="year" v-model="filter.year"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
                    <option value="approved">Genehmigt</option>
                    <option value="rejected">Abgelehnt</option>
                    <option value="pending">Offen</option>
                </select>
            </div>

            <div class="w-full sm:w-1/2 md:w-1/4 mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Datum:</label>
                <input type="date" v-model="filter.date" id="date"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>

        <!-- Button to generate PDF -->
        <button @click="filterItems"
            class="mt-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Generate
            PDF</button>
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
            availableYears: [2020, 2021, 2022, 2023, 2024, 2025],
            availableNames: [],
        };
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
        extractUserNames() {
            const uniqueNames = Array.from(new Set(
                this.items.information_stands.map(stand => stand.user.name)
                    .concat(this.items.lectures.map(lecture => lecture.user.name))
            ));
            this.availableNames = uniqueNames;
        },
        filterItems() {
            let filteredItems = [];
            console.log(this.filter);

            // Filter by year
            if (this.filter.year) {
                this.items.information_stands.forEach(stand => {
                    const standYear = new Date(stand.date).getFullYear();
                    if (standYear === this.filter.year) {
                        filteredItems.push(stand);
                    }
                });
                this.items.lectures.forEach(lecture => {
                    const lectureYear = new Date(lecture.date).getFullYear();
                    if (lectureYear === this.filter.year) {
                        filteredItems.push(lecture);
                    }
                });
            }

            // Filter by name
            if (this.filter.name) {
                this.items.information_stands.forEach(stand => {
                    if (stand.user.name === this.filter.name) {
                        filteredItems.push(stand);
                    }
                });

                this.items.lectures.forEach(lecture => {
                    if (lecture.user.name === this.filter.name) {
                        filteredItems.push(lecture);
                    }
                });
            }

            if (this.filter.status) {
                this.items.information_stands.forEach(stand => {
                    if (stand.status === this.filter.status) {
                        filteredItems.push(stand);
                    }
                });

                this.items.lectures.forEach(lecture => {
                    if (lecture.status === this.filter.status) {
                        filteredItems.push(lecture);
                    }
                });
            }

            filteredItems = Array.from(new Set(filteredItems));

            console.log(filteredItems);

            //console.log(filteredItems);
        },

    },
    mounted() {
        this.fetchItems();
    },
};
</script>