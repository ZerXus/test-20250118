<script setup>
import articleAPI from "@/modules/article/articleAPI.js";
import { computed, onMounted, ref, unref } from "vue";
import { useRoute } from "vue-router";
import { useArticleStore } from "../articleStore.js";
import * as toast from '@/base/toast';
import FormZ from "@/base/ui/FormZ.vue";
import InputTextZ from "@/base/ui/input/InputTextZ.vue";
import ButtonZ from "@/base/ui/ButtonZ.vue";

const { like } = useArticleStore();
const route = useRoute();
const article = ref({
    id: '',
    is_liked: false,
    detail: '',
    views: 0,
    title: '',
    tags: [],
    comments: [],
});

const commentTitle = ref("");
const commentDetail = ref("");
const commentSent = ref(false);

const likeClass = computed(() => unref(article).is_liked ? "pi-heart-fill red" : "pi-heart");
const likeArticle = () => {
    like(unref(article).id);
    article.value.is_liked = !article.value.is_liked;
    article.value.likes += article.value.is_liked ? 1 : -1;
}
const tagClick = tag => {
    toast.info('Нажатие на тэг', 'Здесь мог бы быть поиск по тегу :)');
}

const createComment = () => {
    articleAPI.createComment({
        article_id: article.value.id,
        title: commentTitle.value,
        detail: commentDetail.value,
    }).then(() => {
        commentSent.value = true;
    })
}

onMounted(() => {
    articleAPI.find(route.params.id).then((res) => {
        article.value = res.data.data
    });

});
</script>
<template>
    <section class="flex flex-col gap-5">
        <div class="flex gap-5 items-center mt-2">
            <h1>{{ article.title }}</h1>
            <span class="flex gap-2 items-center"><i class="pi pi-eye"/> {{ article.views ?? 0 }}</span>
            <div class="like-button" @click.stop="likeArticle"><i :class="likeClass" class="like pi"/> {{ article.likes ?? 0 }}</div>
        </div>
        <div>
            <Chip v-for="tag in article.tags" :label="tag.name" class="article-tag" @click="tagClick(tag)"/>
        </div>
        <div>
            {{ article.detail }}
        </div>
        <divider/>
        <div class="flex flex-col">
            <div v-for="comment in article.comments" class="mb-2">
                <h2>{{ comment.title }}</h2>
                <span>{{ comment.detail }}</span>
            </div>
        </div>
        <FormZ v-if="!commentSent">
            <h2>Оставить комментарий</h2>
            <InputTextZ v-model="commentTitle" name="title" t="input.article.comment.title"/>
            <InputTextZ v-model="commentDetail" name="detail" t="input.article.comment.detail"/>
            <ButtonZ icon="pi pi-send" label="Отправить" @click="createComment"/>
        </FormZ>
        <div v-else>
            <h2>Комментарий будет опубликован после того, как рак на горе свистнет :0</h2>
        </div>
    </section>
</template>
<style scoped>
.red {
    color: darkred;
}

.like:hover {
    color: darkred;
}

.article-tag {
    cursor: pointer;
}
</style>
