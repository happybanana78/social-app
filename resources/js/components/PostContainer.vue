<template>
    <div class="container mx-auto border-2 border-red-300
    rounded-lg mt-24 py-10 px-10 sm:px-20 md:px-40 xl:px-80 flex flex-col space-y-5 container-bg
    min-h-screen">
        <div v-for="post in posts" :key="post.id">
            <SinglePost @remove-like="doRemoveLike" @add-like="doAddLike" :post="post"
                :user="user" @delete-post="doDeletePost" />
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
    emits: ['add-like', 'remove-like', 'delete-post'],
    methods: {
            doAddLike(postInfo) {
                this.$emit('add-like', postInfo)
            },
            doRemoveLike(postInfo) {
                this.$emit('remove-like', postInfo)
            },
            doDeletePost(postId, userId) {
                //console.log(userId)
                this.$emit('delete-post', postId, userId)
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