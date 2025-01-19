<template>
    <div class="sidebar">
        <RouterMenu :items="routeItems"/>
    </div>
</template>

<script setup>
import { computed } from "vue"
import { useRouter } from 'vue-router'
import RouterMenu from "@/base/ui/RouterMenu.vue";

const router = useRouter()

const routeItems = computed(() => {
    return router.options.routes[0].children[0].children.filter(route => !route?.hidden).map((route, index) => {
        return {
            label: 'routes.home.' + route.name?.toLowerCase() + '.index',
            items: route.children.filter(child => !child.hidden).map(child => {
                return {
                    label: 'routes.home.' + route.name + '.' + child.name?.toLowerCase() + '.index',
                    icon: child?.meta?.icon,
                    route: child?.name
                }
            })
        }
    })

})
</script>

<style lang="scss" scoped>
.sidebar {
    :deep(.p-menu) {
        border: unset
    }
}
</style>
