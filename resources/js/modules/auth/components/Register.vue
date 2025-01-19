<template>
    <form @submit="onSubmit">
        <Fluid class="register-container form-default">
            <div>
                <h1 v-t="'routes.register'" class="register-title"/>
            </div>

            <InputTextZ v-model="name" name="name" t="input.register.name"/>
            <InputTextZ v-model="email" name="email" t="input.register.email"/>
            <InputPassword v-model="password" name="password" t="input.login.password"/>
            <InputPassword v-model="password_confirmation" name="password_confirmation" t="input.register.password_repeat"/>

            <div class="row no-gap sp-btw">
                <div>
                    <Button v-t="'input.register.have_account'" :to="{name: 'Login'}" as="router-link" link/>
                </div>
            </div>
            <Button v-t="'input.register.submit'" type="submit"></Button>
        </Fluid>
    </form>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
// import InputText from '@/base/ui/InputText.vue';
import Button from "primevue/button";
import InputPassword from "@/modules/auth/components/InputPassword.vue";
import Fluid from "primevue/fluid";
import { useForm } from "vee-validate";
import * as yup from "yup";
import { ref } from "vue";
import { useAuth } from "@websanova/vue-auth";

const { register } = useAuth();
const { t } = useI18n()

const props = defineProps({
    errors: {
        type: Object,
        default: null
    },
    loading: {
        type: Boolean,
        default: false
    }
})
const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        name: yup.string().required(),
        email: yup.string().email().required(),
        password: yup.string().min(8).required(),
        password_confirmation: yup.string().min(8).required().oneOf([ yup.ref('password') ], t('input.register'))
    })
});

const onSubmit = handleSubmit((form) => register({
    data: {
        ...form
    }
}).then(null, error => {
    console.log(error);
}));

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
</script>
