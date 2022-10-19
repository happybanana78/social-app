<template>
    <div>
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