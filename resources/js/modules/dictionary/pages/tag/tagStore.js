import { ref } from 'vue';
import { defineStore } from 'pinia';
import categoryAPI from './tagAPI.js';

export const useTagStore = defineStore('tag', () => {

    const items = ref([]);
    const meta = ref([]);
    const loading = ref(true);

    async function fetchAll(params = {}) {
        loading.value = true;
        const { data } = await categoryAPI.all(params);
        items.value = data.data;
        meta.value = data.meta;
        loading.value = false;
    }

    async function save(item) {
        loading.value = true;
        const { data } = items.value.filter(category => category.id === item.id)?.length > 0
            ? await categoryAPI.update(item)
            : await categoryAPI.create(item);
        console.log(data);
        console.log('loaded');
        items.value.push(data.data);
        meta.value = data.meta;
        loading.value = false;
    }

    return {
        items,
        meta,
        loading,
        fetchAll,
        save
    }
})
