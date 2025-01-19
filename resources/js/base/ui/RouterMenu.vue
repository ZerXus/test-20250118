<script setup>
import { ref } from "vue";

const props = defineProps([
    'items',
    'popup'
]);

const menu = ref();
defineExpose({ menu });

</script>

<template>
    <Menu ref="menu" :model="props.items" :popup="popup">
        <template #submenuheader="{ item }">
            <span v-t="item.label.toLowerCase()"/>
        </template>

        <template #item="{ item, props }">
            <router-link v-if="item.route" v-slot="{ href, navigate }" :to="{name: item.route}" custom>
                <a :href="href" class="p-menu-item-link" v-bind="props.action" @click="navigate">
                    <span :class="item.icon" class="p-menu-item-icon"/>
                    <span v-t="item.label.toLowerCase()" class="p-menu-item-label"></span>
                </a>
            </router-link>
            <a v-else :href="item.url" :target="item.target" class="p-menu-item-link" v-bind="props.action">
                <span :class="item.icon" class="p-menu-item-icon"></span>
                <span v-t="item.label.toLowerCase()" class="p-menu-item-label"></span>
            </a>
        </template>
    </Menu>
</template>

<style lang="scss" scoped>

</style>
