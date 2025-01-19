<template>
    <router-view
        :key="$route.fullPath"
        v-slot="{ Component }"
    >
        <transition
            mode="out-in"
            name="fade"
        >
            <component :is="Component"/>
        </transition>
    </router-view>
</template>
