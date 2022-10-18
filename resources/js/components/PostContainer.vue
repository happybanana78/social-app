<template>
    <div class="container mx-auto border-2 border-red-300
    rounded-lg mt-24 py-10 px-60 flex flex-col space-y-5 container-bg
    min-h-screen">
        <div v-for="post in posts" :key="post.id">
            <SinglePost @remove-like="doRemoveLike" @add-like="doAddLike" :post="post"
                :user="user" />
        </div>
    </div>
</template>

<script>
import SinglePost from "./SinglePost.vue"
export default {
    name: "PostContainer",
    props: {
        posts: Array,
        user: Object
    },
    components: {
        SinglePost
    },
    emits: ['add-like', 'remove-like'],
    methods: {
            doAddLike(postInfo) {
                this.$emit('add-like', postInfo)
            },
            doRemoveLike(postInfo) {
                this.$emit('remove-like', postInfo)
            }
        }
}
</script>

<style>
div.container-bg {
    background-image: url("@/assets/images/static/bg.jpg");
    background-size: cover;
}
</style>