<template>
    <div class="layout">
        <div class="header" style="z-index: 1000;">
            <Header/>
        </div>
        <div class="menu">
            <card>
                <template #content>
                    <sidebar/>
                </template>
            </card>
        </div>
        <div class="body">
            <transition :css="false" @enter="console.log('test')">
                <breadcrumbs/>
            </transition>
            <card>
                <template #content>
                    <child/>
                </template>
            </card>
        </div>
    </div>
</template>

<script setup>
import Breadcrumbs from "@/base/components/Breadcrumbs.vue";
import Header from '@/base/components/Header.vue'
import Sidebar from '@/base/components/Sidebar.vue'
import Child from '@/base/components/Child.vue'
</script>

<style lang="scss" scoped>
.layout {
    display: grid;
    grid-template-columns: 250px 1fr;
    grid-template-areas: "header header"
                         "menu body"
                         "menu body";
    gap: 20px;
    max-width: 1500px;
    margin: 0 auto;
}

.header {
    grid-area: header;
    position: sticky;
    top: 0;
    background: rgba(var(--p-content-background), 0.8);
    backdrop-filter: blur(8px);

    :deep(.p-menubar) {
        margin-top: 10px;
        transition: border-color 0.5s ease,
        background-color 0.5s ease;
        background: transparent;

        &:not(.sticky) {
            border-color: var(--p-menubar-background);
            background: var(--p-menubar-background);
        }
    }
}

.menu {
    grid-area: menu;
    height: fit-content;
    padding-top: 14px;

    :deep(.p-card) {
        position: sticky;
        top: 99px;

        .p-card-body {
            padding: 0.75rem;
        }
    }
}

.body {
    grid-area: body;
    margin: 0 0 30px 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;

    :deep(.p-breadcrumb) {
        background: unset;
        padding-bottom: 0;
    }
}

.footer {
    grid-area: footer;
}
</style>
