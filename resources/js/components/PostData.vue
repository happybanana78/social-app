<template>
    <div class="flex flex-col sm:flex-row justify-between items-center
    px-10 pb-2">
        <div class="flex flex-row justify-center text-2xl sm:text-2xl">
            <div>
                <PostLike @add-like="doAddLike" @remove-like="doRemoveLike" :post="post" :user="user" />
            </div>
            <div>
                <PostComment :post="post" />
            </div>
        </div>
        <div>
            <div class="flex flex-col text-center text-sm sm:text-lg">
                <UsernameTag @post-username="doPostUsername" :user="user" :post="post" />
                <PostTime :post="post" />
            </div>
        </div>
    </div>
</template>

<script>
import PostLike from "./PostLike.vue"
import PostComment from "./PostComment.vue"
import PostTime from "./PostTime.vue"
import UsernameTag from "./UsernameTag.vue"
export default {
    name: "PostData",
    components: {
        PostLike,
        PostComment,
        PostTime,
        UsernameTag
    },
    props: {
        post: Object,
        user: Object
    },
    emits: ['add-like', 'remove-like', 'post-username'],
    methods: {
        doAddLike(postInfo) {
            this.$emit('add-like', postInfo)
        },
        doRemoveLike(postInfo) {
            this.$emit('remove-like', postInfo)
        },
        doPostUsername(user) {
            //console.log(user)
            this.$emit('post-username', user)
        }
    }
}
</script>