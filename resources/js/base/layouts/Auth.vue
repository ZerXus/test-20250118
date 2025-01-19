<template>
    <div class="auth-container">
        <Card class="auth-card">
            <template #content>
                <Child/>
            </template>
        </Card>
    </div>
</template>

<script setup>
import Card from 'primevue/card';
import Child from '@/base/components/Child.vue'
</script>

<style lang="scss" scoped>
.auth-container {
    min-height: 100vh;
    display: flex;
}

.auth-card {
    margin: auto;
}
</style>
