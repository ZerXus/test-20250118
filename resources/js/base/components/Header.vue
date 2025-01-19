<template>
    <Menubar :class="{sticky: isHeaderSticky}" :dt="{padding: '0 1rem'}" :model="headerItems">
        <template #start>
            <h3 class="header-title">{{ title }}</h3>
        </template>
        <template #end>
            <div class="menubar-end">
                <div aria-controls="profile_menu" aria-haspopup="true" class="profile-button" @click="toggleMenu">
                    <span>{{ sysUserName }}</span>
                    <Avatar v-if="sysUserAvatar" :image="sysUserAvatar"/>
                    <Avatar v-else icon="pi pi-user"/>
                </div>
                <RouterMenu id="profile_menu" ref="menu" :items="profileItems" :popup="true"/>
            </div>
        </template>
    </Menubar>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { useAuth } from '@websanova/vue-auth';
import { useI18n } from 'vue-i18n';

import RouterMenu from "@/base/ui/RouterMenu.vue";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import bus from '@/includes/Event';

const { t } = useI18n();
const auth = useAuth();

const isHeaderSticky = ref(false);
const confirm = useConfirm();
const toast = useToast();
const onScroll = () => isHeaderSticky.value = window.top.scrollY > 0
onMounted(() => {
    window.addEventListener('scroll', onScroll);
});
onUnmounted(() => {
    window.removeEventListener('scroll', onScroll);
});
const sysUserAvatar = computed(() => auth.user()?.avatar || null);
const sysUserName = computed(() => auth.user()?.name || null);
const headerItems = [];

const profileItems = [
    {
        label: 'routes.profile.edit',
        icon: 'pi pi-user',
        route: 'profile.change_password'
    },
    {
        label: 'routes.logout',
        icon: 'pi pi-sign-out',
        command: logout
    },
]

const menu = ref();
const toggleMenu = (event) => menu.value.menu.toggle(event);

function logout() {
    confirm.require({
        message: t('components.logout_confirm.message'),
        header: t('components.logout_confirm.title'),
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: t('buttons.cancel'),
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: t('buttons.ok'),
        },
        accept: async () => {
            bus.$emit('logout')
            await auth.logout();
        }
    });
}

const title = window.config.appName;
</script>

<style lang="scss" scoped>
.header-title {
    margin-left: 0.5rem;
    min-height: 50px;
    display: flex;
    align-items: center;
}

.menubar-end {
    display: flex;
    gap: 1rem;
}

.profile-button {
    display: flex;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
    color: var(--p-zinc-300);

    &:hover {
        color: var(--p-zinc)
    }

    :deep(.p-avatar) {
        overflow: hidden;
    }
}

.p-menubar {
    border-radius: 12px !important;
}
</style>
