<script setup>
import Fluid from "primevue/fluid";
import { useForm } from "vee-validate";

const props = defineProps({
    class: String,
});
const emit = defineEmits([ 'submit', 'error' ]);

const { handleSubmit } = useForm();
const onSubmit = handleSubmit((response) => emit('submit', response), error => emit('error', error));
</script>

<template>
    <form @submit="onSubmit">
        <Fluid :class="props.class" class="form-default">
            <slot></slot>
        </Fluid>
    </form>
</template>

<style lang="scss" scoped>

</style>
