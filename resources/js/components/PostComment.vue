<template>
    <div>
        <router-link :to="{name: 'CommentsPage', params: {id: post.id}}">
            <i class="fa-solid fa-comment cursor-pointer text-red-400"></i>
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