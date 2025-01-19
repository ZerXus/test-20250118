<template>
    <FormZ @submit="onSubmit">
        <div>
            <h1 v-t="'routes.auth'" class="login-title"/>
            <span class="login-helper">Введите логин и пароль</span>
        </div>

        <InputTextZ v-model="email" :rule="string().required().email()" name="email" t="input.login.email"/>
        <InputPassword v-model="password" :feedback="false" :rule="string().min(8).required()" name="password" t="input.login.password"/>

        <div class="row no-gap sp-btw">
            <div class="flex items-center">
                <Checkbox v-model="remember" binary/>
                <label v-t="'input.login.remember'"/>
            </div>
            <div>
                <Button v-t="'input.login.reset_password'" :to="{name: 'ResetPassword'}" as="router-link" link/>
            </div>
        </div>
        <div class="row no-gap">
            <Button v-t="'input.login.to_register'" :to="{name: 'Register'}" as="router-link" link/>
        </div>
        <Button v-t="'input.login.submit'" :disabled="false" type="submit"></Button>
    </FormZ>
</template>

<script setup>
import { ref } from 'vue';
import InputPassword from "@/modules/auth/components/InputPassword.vue";
import { useAuth } from "@websanova/vue-auth";
import { useForm } from "vee-validate";
import { string } from 'yup';

const { login } = useAuth();

const { handleSubmit } = useForm();
const remember = ref(false);
const email = ref('');
const password = ref('');

const onSubmit = handleSubmit(() => login({
    data: {
        device_name: window.config.deviceName,
        email: email.value,
        password: password.value,
        remember: remember.value,
    }
}));


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
