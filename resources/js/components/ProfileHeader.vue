<template>
    <div class="flex flex-row justify-between items-center p-5 rounded-lg
    bg-header fixed left-5 right-5 top-0 z-30">
        <router-link to="/">
            <div class="text-3xl bg-white rounded-full text-black w-10 h-10
            items-center flex justify-center">
                <i class="fa-solid fa-arrow-left cursor-pointer"></i>
            </div>
        </router-link>
        <router-link to="/">
            <img src="../assets/logo.png" alt="" width="50" height="50">
        </router-link>
        <MenuButton />
    </div>
</template>

<script>
    import MenuButton from "./MenuButton.vue";
    export default {
        name: "CommentsHeader",
        components: {
            MenuButton
        },
    }
</script>

<style>
div.bg-header {
  background-image: url("../assets/images/static/bg.jpg");
  background-size: cover;
}
</style>