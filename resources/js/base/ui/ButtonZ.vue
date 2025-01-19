<script setup>
import { useI18n } from "vue-i18n";

const props = defineProps({
    label: String,
    icon: { type: String, required: true },
});

const { t } = useI18n()

</script>

<template>
    <Button :icon="props.icon" :label="label" class="mr-2" v-bind="$attrs"/>
</template>

<style lang="scss" scoped>

</style>
