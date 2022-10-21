<template>
    <div class="border-2 border-red-300
    rounded-lg post-bg flex flex-col space-y-2 py-1">
        <div class="text-3xl text-right mr-3 text-red-400" v-if="this.user.id == this.postUser.id">
            <i class="fa-solid fa-xmark cursor-pointer" @click="doDeletePost"></i>
        </div>
        <div class="mx-auto">
            <img :src="`/images/uploads/${post.img}`" alt=""
            class="w-full">
        </div>
        <PostData @add-like="doAddLike" @post-username="setPostUsername"
        @remove-like="doRemoveLike"
        :post="post" :user="user" />
    </div>
</template>

<script>
import axios from "axios"
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
    data() {
        return {
            postUser: Object
        }
    },
    emits: ['add-like', 'remove-like', 'delete-post'],
    methods: {
            doAddLike(postInfo) {
                this.$emit('add-like', postInfo)
            },
            doRemoveLike(postInfo) {
                this.$emit('remove-like', postInfo)
            },
            doDeletePost() {
                this.$emit('delete-post', this.post.id, this.postUser.id)
            },
            setPostUsername(user) {
                const userData = {
                    username: user
                }
                //console.log(user)
                axios.post('/api/users/byname', userData)
                .then((response) => {
                    this.postUser = response.data
                    //console.log(this.postUser[0])
                }).catch((error) => {
                    console.log(error)
                })
            }
        }
}
</script>

<style>
div.post-bg {
  background-color: antiquewhite;
}
</style>