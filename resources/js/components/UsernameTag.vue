<template>
    <div class="text-md cursor-pointer">
        <router-link :to="'/profile/' + user.username">
            <b>{{user.username}}</b>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "UsernameTag",
        props: {
            user: Object
        }
    }
</script>