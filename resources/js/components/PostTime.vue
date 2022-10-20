<template>
    <div class="text-red-500">
        <p>{{post.time}}</p>
    </div>
</template>

<script>
    export default {
        name: "PostTime",
        props: {
            post: Object
        }
    }
</script>