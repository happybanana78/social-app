<template>
    <div>
        <router-link :to="{name: 'CommentsPage', params: {id: post.id}}">
            <i class="fa-solid fa-comment cursor-pointer"></i>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "PostComment",
        props: {
            post: Object
        }
    }
</script>