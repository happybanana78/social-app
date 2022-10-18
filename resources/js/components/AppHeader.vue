<template>
    <div class="flex flex-row justify-between items-center p-5 rounded-lg
    bg-header fixed left-5 right-5 top-0">
        <ProfileButton @toggle-profile="$emit('toggle-profile')" />
        <router-link to="/">
            <img src="../assets/logo.png" alt="" width="50" height="50">
        </router-link>
        <MenuButton />
    </div>
</template>

<script>
    import ProfileButton from "./ProfileButton.vue"
    import MenuButton from "./MenuButton.vue"
    export default {
        name: "AppHeader",
        components: {
            ProfileButton,
            MenuButton
        }
    }
</script>

<style>
div.bg-header {
  background-image: url("../assets/images/static/bg.jpg");
  background-size: cover;
}
</style>