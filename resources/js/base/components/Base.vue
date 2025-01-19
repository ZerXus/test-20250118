<template>
    <component
        :is="layoutComponent"
        v-if="layoutComponent"
    />
    <Toast/>
    <ConfirmDialog/>
</template>

<script setup>
import { shallowRef, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const layoutComponent = shallowRef(null);

// Load layout components dynamically.
const autoImportLayouts = import.meta.glob('../layouts/*.vue', { import: 'default' });

watch(
    () => route.meta,
    async meta => {
        let layouts = [];
        for (const path in autoImportLayouts) {
            const key = path.replace(/(^..\/layouts\/)|(\.vue$)/g, '').toLowerCase();
            layouts[key] = await autoImportLayouts[path]();
        }

        let layoutName = meta?.layout;
        layoutComponent.value = layouts[layoutName?.toLowerCase() ?? ''] ?? layouts['default'];
    },
    { immediate: true }
)
</script>
