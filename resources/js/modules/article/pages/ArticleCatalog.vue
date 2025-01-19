<template>
    <section class="grid grid-cols-1 gap-4 mx-auto">
        <ArticleMini v-for="item in items" :article="item"/>
    </section>
</template>
<script setup>
import ArticleMini from "../components/ArticleMini.vue";
import { storeToRefs } from "pinia";
import { useArticleStore } from '../articleStore.js';
import { useRouter } from "vue-router";

const { items, meta, loading } = storeToRefs(useArticleStore())
const { fetchNewest, save } = useArticleStore()
const router = useRouter();

fetchNewest();
</script>
