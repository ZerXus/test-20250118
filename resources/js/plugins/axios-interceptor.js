import axios from 'axios';
import * as toast from '@/base/toast';

let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = window.config.baseURL;
axios.defaults.withCredentials = true;

// Response interceptor
axios.interceptors.response.use(response => {
    if (response?.status === 200) {
        toast.success('Успешно!', response.data.status);
    }
    return Promise.resolve(response);
}, error => {
    if (error.response?.data.message) {
        toast.error(error.response.data.message);
        console.error('--- ', error.response.data.message);
    }
    if (error.response?.status >= 500) {
        toast.error('Произошла неизвестная ошибка!');
    } else if (error.response?.status === 401 && error.response.data.message) {
        toast.error(error.response.data.message);
    }

    return Promise.reject(error);
})

export default axios
