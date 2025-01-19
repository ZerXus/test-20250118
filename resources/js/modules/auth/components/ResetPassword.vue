<template>
    <form @submit="onSubmit">
        <Fluid class="login-container form-default">
            <div>
                <h1 v-t="'routes.reset_password'" class="login-title"/>
                <span class="login-helper">Введите ваш email</span>
            </div>
            <InputText v-model="email" name="email" t="input.login.email"/>
            <Button v-t="'input.reset.submit'" type="submit"></Button>
        </Fluid>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
// import InputText from '@/base/ui/InputText.vue';
import Button from "primevue/button";
import Fluid from "primevue/fluid";
import * as yup from 'yup';
import { useForm } from "vee-validate";
import axios from "axios";

const { t } = useI18n();


const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        email: yup.string().email().required(),
    })
});
const [ password, passwordAttrs ] = defineField('password');
const [ remember, rememberAttrs ] = defineField('remember');

const onSubmit = handleSubmit((form) => axios.post('auth/forgot-password', { ...form }).then(null, error => {
    console.log(error);
}));

const email = ref('');
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
