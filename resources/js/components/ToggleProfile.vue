<template>
    <div class="fixed w-full h-screen top-0 left-0" v-show="toggle" @click="this.$emit('close-profile-toggle')"></div>
    <div class="fixed toggle-profile-bg top-24 left-16 p-10
    flex flex-row justify-center items-center w-80 border-2 border-red-200
    rounded-lg" v-show="toggle">
        <div class="flex flex-col text-xl space-y-4">
            <router-link :to="'/profile/' + user.username">
                <b class="cursor-pointer">Profile</b>
            </router-link>
            <b class="cursor-pointer" @click="this.$emit('create-post')">Create New Post</b>
        </div>
    </div>
</template>

<script>
export default {
    name: "ToggleProfile",
    props: {
        toggle: Boolean,
        user: Object
    },
    emits: ['create-post', 'close-profile-toggle']
}
</script>

<style>
div.toggle-profile-bg {
    background-color: antiquewhite;
}
</style>