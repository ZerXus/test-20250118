import Login from './components/Login.vue'
import Register from './components/Register.vue'
import ResetPassword from './components/ResetPassword.vue'
import VerifyEmail from './components/VerifyEmail.vue'
import ResendVerification from './components/ResendVerification.vue'
import ResetPasswordForm from "@/modules/auth/components/ResetPasswordForm.vue";

export const routes = [
    {
        path: '/email',
        name: 'Auth',
        meta: {
            layout: 'Auth',
            auth: true
        },
        hidden: true,
        children: [
            {
                path: '/login',
                component: Login,
                name: 'Login',
                meta: {
                    auth: false,
                },
            },
            {
                path: '/register',
                component: Register,
                name: 'Register',
                meta: {
                    auth: false,
                },
            },
            {
                path: '/reset-password',
                component: ResetPassword,
                name: 'ResetPassword',
                meta: {
                    auth: false,
                },
            },
            {
                path: '/reset-password/:token',
                component: ResetPasswordForm,
                name: 'ResetPasswordForm',
                meta: {
                    auth: false
                }
            },
            {
                path: 'verify/:user',
                component: VerifyEmail,
                name: 'Verification email'
            },
            {
                path: 'resend/verification',
                component: ResendVerification,
                name: 'Verification resend'
            }
        ]
    }
]
