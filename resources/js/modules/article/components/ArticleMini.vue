<script setup>
import { computed } from "vue";
import { useArticleStore } from "../articleStore.js";
import { useRouter } from "vue-router";

const props = defineProps({
    article: {}
})

const router = useRouter()
const { like } = useArticleStore()

const symbolsLimit = 100;
const shortenedDetail = computed(() => props.article.detail?.length <= 100 ? props.article.detail : props.article.detail.split("").slice(0, symbolsLimit).join("") + '...');
const likeClass = computed(() => props.article.is_liked ? "pi-heart-fill red" : "pi-heart");
const likeArticle = () => {
    like(props.article.id);
}
const imgUrl = computed(() => "https://loremflickr.com/379/240?random=" + props.article.id)
const articleClick = () => router.push({ name: "article-details", params: { id: props.article.id } });
</script>

<template>
    <div class="article flex flex-wrap" @click="articleClick">
        <div class="image overflow-hidden">
            <img :src="imgUrl">
        </div>
        <div class="p-4 flex flex-col justify-between flex-grow">
            <div class="title mt-2 font-bold">
                {{ article.title }}
            </div>
            <div class="text mt-2">
                {{ shortenedDetail }}
            </div>
            <div class="buttons flex justify-between items-center mt-2">
                <span class="flex gap-2 items-center"><i class="pi pi-eye"/> {{ article.views ?? 0 }}</span>
                <div class="like-button" @click.stop="likeArticle"><i :class="likeClass" class="like pi"/> {{ article.likes ?? 0 }}</div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.title {
    font-size: 1.5rem;
}

.article {
    border-radius: 10px;
    background: #1f1f23;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.1s;

    &:hover {
        scale: 1.01;
    }
}

.red {
    color: darkred;
}

.like:hover {
    color: darkred;
}
</style>
