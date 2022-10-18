<template>
    <div class="border-2 border-red-300
    rounded-lg post-bg flex flex-col space-y-5 py-5">
        <div class="mx-auto">
            <img :src="`/images/uploads/${post.img}`" alt=""
            class="w-full">
        </div>
        <PostData @add-like="doAddLike" 
        @remove-like="doRemoveLike"
        :post="post" :user="user" />
    </div>
</template>

<script>
import PostData from "./PostData.vue"
export default {
    name: "SinglePost",
    props: {
        post: Object,
        user: Object
    },
    components: {
        PostData
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
div.post-bg {
  background-color: antiquewhite;
}
</style>