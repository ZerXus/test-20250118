<script setup>
import FloatLabel from "primevue/floatlabel";

const props = defineProps({
    error: String,
    showLabel: Boolean,
    t: String,
});


</script>

<template>
    <div>
        <template v-if="showLabel">
            <FloatLabel >
                <slot></slot>
                <label v-t="t"/>
            </FloatLabel>
        </template>
        <template v-else>
            <slot></slot>

        </template>
        <div v-if="props.error" class="input-error">
            <small>{{ props.error }}</small>
        </div>
    </div>
</template>

<style lang="scss" scoped>

</style>
