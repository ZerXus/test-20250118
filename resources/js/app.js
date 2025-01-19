/**
 * @directive t
 */
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './base/App.vue';
import $dayjs from './plugins/day';
import * as _ from 'lodash';
import $filters from './includes/filters';
import $bus from './includes/Event';
import router from './plugins/router';
import auth from './plugins/auth';
import './plugins/day';
import VueAxios from 'vue-axios';
import axios from './plugins/axios-interceptor';
import PrimeVue from 'primevue/config';
import Zerxus from './includes/themes/zerxus';

import { createI18n } from "vue-i18n";
import en from '@/includes/lang/en.json'
import ru from '@/includes/lang/ru.json'
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from "primevue/toastservice";
import { useToast } from 'primevue/usetoast';

import { setLocale } from "yup";
import yupRU from '@/includes/validations/ru.js';

import FormZ from "@/base/ui/FormZ.vue";
import ButtonZ from '@/base/ui/ButtonZ.vue';
import InputTextZ from '@/base/ui/input/InputTextZ.vue';

if (import.meta.hot) {
    import.meta.hot.accept(r => console.log(r));
}
const i18n = createI18n({
    legacy: false,
    locale: 'ru',
    fallbackLocale: 'en',
    messages: { en, ru }
})
const app = createApp(App)

window._ = _

app.use(createPinia());
app.use(router);
app.use(VueAxios, axios);
app.use(auth);
app.use(i18n);
app.use(ConfirmationService);
app.use(ToastService);
app.use(PrimeVue, {
    theme: {
        preset: Zerxus,
        options: {
            darkModeSelector: '.dark',
        }
    },
});

app.component('FormZ', FormZ);
app.component('ButtonZ', ButtonZ);
app.component('InputTextZ', InputTextZ);

setLocale(yupRU);

app.config.globalProperties.$config = window.config;
app.config.globalProperties.$filters = $filters;
app.config.globalProperties.$dayjs = $dayjs;
app.config.globalProperties.$bus = $bus;

const addToast = (severity, message) => useToast().add({ severity: severity, summary: message, life: 3000 })
app.config.globalProperties.$toastError = (message) => addToast('error', message);
app.config.globalProperties.$toastSuccess = (message) => addToast('success', message);
app.config.globalProperties.$toastSecondary = (message) => addToast('secondary', message);
app.config.globalProperties.$toastContrast = (message) => addToast('contrast', message);

app.mount('body')

export default app
