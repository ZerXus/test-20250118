<script setup>
import FloatLabel from "primevue/floatlabel";
import { useField } from 'vee-validate';
import Password from "primevue/password";
import InputWrapper from "@/base/ui/input/Wrapper.vue";

const props = defineProps({
    name: String,
    modelValue: String,
    t: {
        type: String,
        required: true
    },
    type: String,
    feedback: {
        type: Boolean,
        default: false
    },
    rule: {
        type: Object, default: () => {
        }
    }
});

const { value, errorMessage } = useField(props.name, props.rule, { syncVModel: true });

</script>

<template>
    <div>
        <InputWrapper :error="errorMessage">
            <FloatLabel>
                <Password
                    v-model="value"
                    :feedback="feedback"
                    :inputId="name"
                    :invalid="errorMessage?.length > 0"
                    medium-label="Средний"
                    strong-label="Сильный"
                    toggleMask
                    weak-label="Слабый"
                >
                    <template #header>
                        <div class="pass-helper">Вводите пароль</div>
                    </template>
                </Password>
                <label v-t="t" :for="name"></label>
            </FloatLabel>
        </InputWrapper>
    </div>
</template>

<style lang="scss" scoped>
</style>
