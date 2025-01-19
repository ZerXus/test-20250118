<script setup>
import InputText from "primevue/inputtext";
import { useField } from 'vee-validate';
import InputWrapper from "@/base/ui/input/Wrapper.vue";
import { computed } from "vue";

const props = defineProps({
    modelValue: String,
    type: { type: String, default: 'text' },
    disabled: Boolean,
    rule: {
        type: Object, default: () => {
        }
    },
    name: { type: String, default: '', },
    t: { type: String, default: 'input.dummy' },
    showLabel: { type: Boolean, default: true },
});
const { value, errorMessage, handleChange, meta } = useField(() => props.name, props.rule, {
    syncVModel: true,
    validateOnMount: true,
    validateOnValueUpdate: true
});
const invalid = computed(() => {
    return errorMessage.value?.length > 0 ?? false
});
</script>

<template>
    <InputWrapper :error="errorMessage" :showLabel="showLabel" :t="t">
        <InputText v-model="value" :invalid="invalid" :name="name" :type="type" v-bind="$attrs"/>
    </InputWrapper>
</template>

<style lang="scss" scoped>
</style>
