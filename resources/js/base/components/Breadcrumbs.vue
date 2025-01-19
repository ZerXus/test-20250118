<template>
    <Breadcrumb :model="breadcrumbs">
        <template #item="{ item, props }">
            <router-link v-if="item.path" v-slot="{ href, navigate }" :to="item.path ?? '/admin/'" custom>
                <a :href="href" v-bind="props.action" @click="navigate">
                    <span v-if="item.icon" :class="[item.icon, 'text-color']" class="p-breadcrumb-item-icon"/>
                    <span v-t="item.name?.toLowerCase()" class="p-breadcrumb-item-label"></span>
                </a>
            </router-link>
            <a v-else :href="item.url" :target="item.target" v-bind="props.action">
                <span v-t="item.name?.toLowerCase()" class="text-surface-700 dark:text-surface-0"></span>
            </a>
        </template>
    </Breadcrumb>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const breadcrumbs = computed(() => {
    let matchedRoutes = route.matched;
    let fullName = [ 'routes' ];

    matchedRoutes.shift();
    return matchedRoutes.map(matchedRoute => {
        fullName.push(matchedRoute.name);
        return {
            path: matchedRoute.path,
            name: fullName.join('.') + '.index',
            icon: matchedRoute.meta.icon ?? null
        };
    })
});
</script>
