import { ref } from 'vue';
import { defineStore } from 'pinia';
import articleAPI from './articleAPI.js';

export const useArticleStore = defineStore('article', () => {

    const items = ref([]);
    const meta = ref([]);
    const loading = ref(true);

    async function fetchAll(params = {}) {
        loading.value = true;
        items.value = [];
        const { data } = await articleAPI.all(params);
        items.value = data.data;
        meta.value = data.meta;
        loading.value = false;
    }

    async function fetchNewest(params = {}) {
        loading.value = true;
        items.value = [];
        const { data } = await articleAPI.newest(params);
        items.value = data.data;
        meta.value = data.meta;
        loading.value = false;
    }

    async function save(item) {
        loading.value = true;
        const { data } = await articleAPI.create(item);

        items.value.push(data.data);
        meta.value = data.meta;
        loading.value = false;
    }

    async function like(id) {
        loading.value = true;
        const { data } = await articleAPI.like(id);
        let article = items.value.find(item => item.id === id);
        article.is_liked = !article.is_liked;
        article.likes += article.is_liked ? 1 : -1;
        meta.value = data.meta;
        loading.value = false;
    }

    return {
        items,
        meta,
        loading,
        fetchAll,
        fetchNewest,
        save,
        like
    }
})
