<template>
    <section id="index">
        <div class="title mb-4">
            {{ title }}
        </div>
    </section>
</template>

<script setup>
const title = window.config.appName
</script>

<style lang="scss" scoped>
.title {
    font-size: 64px;
}
</style>
