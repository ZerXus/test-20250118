<template>
    <FormZ @error="console.log" @submit="updateProfile">
        <input-text v-model="name" :rule="yup.string().required()" name="name" t="input.profile.name"></input-text>
        <input-text v-model="email" :rule="yup.string().email()" disabled name="email" t="input.profile.email"></input-text>
    </FormZ>
    <divider></divider>
    <FormZ @submit="updatePassword">
        <input-password name="password_current" t="input.profile.password_current"/>
        <input-password name="password" t="input.profile.password"/>
        <input-password name="password_confirmation" t="input.profile.password_confirmation"/>
    </FormZ>
    <form @submit="onSubmitPassword">
        <div class="form-default">

        </div>
    </form>
</template>

<script setup>
import { useAuth } from '@websanova/vue-auth';
import { ref } from "vue";
import settingApi from '../profileApi';
import InputPassword from "@/modules/auth/components/InputPassword.vue";
import * as toast from '@/base/toast';
import * as yup from "yup";

const auth = useAuth();
const updateProfile = (form) => settingApi.update(form).then(response => {
    toast[response.data.type](response.data.message);
    if (response.data.type === 'success') {
        auth.user().name = form.name;
        auth.user().email = form.email;
    }
});

const updatePassword = (form) => settingApi.changePassword(form).then(response => toast[response.data.type](response.data.message));

const name = ref(auth.user().name);
const email = ref(auth.user().email);
</script>
