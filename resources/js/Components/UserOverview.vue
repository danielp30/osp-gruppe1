<script setup>
    import Table from '@/Components/Table.vue'
</script>
<template>
    <div class="flex flex-col">
        <h1 class="text-2xl pb-10">Dashboard</h1>
            <Table></Table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.fetchItems();
  },
  methods: {
    async fetchItems() {
      try {
        const response = await axios.get('/items');
        this.items = response.data;
      } catch (error) {
        console.error('Error fetching items:', error);
      }
    },
  },
};
</script>
