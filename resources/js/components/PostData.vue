<template>
    <div class="flex justify-between 
    text-4xl px-10">
        <!-- <div class="flex flex-row justify-center space-x-4"> -->
            <div>
                <PostLike @add-like="doAddLike"
                @remove-like="doRemoveLike"
                :post="post" :user="user" />
            </div>
            <div>
                <PostComment :post="post" />
            </div>
            <!-- <div class="flex flex-col">
                <PostTime />
                <UserProfile />
            </div> -->
        <!-- </div> -->
    </div>
</template>

<script>
    import PostLike from "./PostLike.vue"
    import PostComment from "./PostComment.vue"
    import PostTime from "./PostTime.vue"
    import UserProfile from "./UserProfile.vue"
    export default {
        name: "PostData",
        components: {
            PostLike,
            PostComment,
            PostTime,
            UserProfile
        },
        props: {
            post: Object,
            user: Object
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