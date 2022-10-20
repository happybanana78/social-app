<template>
    <div class="text-3xl bg-white rounded-full text-black w-10 h-10
    items-center flex justify-center text-red-600">
        <i @click="this.$emit('toggle-profile')"
        class="fa-solid fa-user cursor-pointer"></i>
    </div>
</template>

<script>
    export default {
        name: "ProfileButton",
    }
</script>