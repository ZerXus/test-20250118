<template>
    <template v-if="!isSuccess">
        <form @submit="onSubmit">
            <Fluid class="login-container form-default">
                <div>Вы успешно сменили пароль!</div>
                <Button v-t="'input.login.submit'" :to="{name: 'Login'}" as="router-link"/>
            </Fluid>
        </form>
    </template>
    <template v-else>
        <form @submit="onSubmit">
            <Fluid class="login-container form-default">
                <div>
                    <h1 v-t="'routes.reset_password'" class="login-title"/>
                    <span class="login-helper">Сменить старый пароль</span>
                </div>
                <InputPassword name="password" t="input.reset.password"/>
                <InputPassword name="password_confirmation" t="input.reset.password_repeat"/>
                <Button v-t="'input.reset.submit'" type="submit"></Button>
            </Fluid>
        </form>
    </template>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { useI18n } from 'vue-i18n';
import Fluid from "primevue/fluid";
import * as yup from 'yup';
import { useForm } from "vee-validate";
import axios from "axios";
import InputPassword from "@/modules/auth/components/InputPassword.vue";
import { ref } from "vue";

const { t } = useI18n();

const isSuccess = ref(false);
const route = useRoute()
const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        password: yup.string().required(),
        password_confirmation: yup.string().required()
    })
});
const [ password, passwordAttrs ] = defineField('password');
const [ passwordRepeat, rememberAttrs ] = defineField('remember');

const onSubmit = handleSubmit((form) => axios.post('auth/reset-password', { ...form, token: route.params.token, email: route.query.email }).then(
    response => {
        isSuccess.value = true;
    },
    error => {
        console.log(error);
    }
));
</script>

<style lang="scss" scoped>
.login-container {
    min-width: 20vw;
}

.login-title {
    margin: 0 0 0.5rem;
}

.pass-helper {
    margin-bottom: 0.4rem;
    font-weight: bold;
}
</style>
