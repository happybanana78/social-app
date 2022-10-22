<template>
    <div class="fixed w-full h-screen top-0 left-0"
    v-show="toggle" @click="this.$emit('close-settings-toggle')"></div>
    <div class="fixed toggle-profile-bg top-24 sm:right-16 right-1/2 translate-x-1/2 sm:translate-x-0 p-10
    flex flex-row justify-center items-center w-80 border-2 border-red-200
    rounded-lg" v-show="toggle">
        <div class="flex flex-col text-xl space-y-4 text-red-500">
            <b class="cursor-pointer space-x-2 flex items-center" @click="onClickLogout">
                <p>Logout</p><i class="fa-solid fa-right-from-bracket"></i>
            </b>
        </div>
    </div>
</template>

<script>
export default {
    name: "ToggleSettings",
    props: {
        toggle: Boolean
    },
    methods: {
        onClickLogout() {
            this.$emit('logout')
        }
    },
    emits: ['close-settings-toggle', 'logout']
}
</script>

<style>
div.toggle-profile-bg {
    background-color: antiquewhite;
}
</style>