<template>
    <div v-if="!this.likes.includes(this.userId)">
        <i @click="doLike" class="fa-regular fa-heart cursor-pointer text-red-500"></i>
    </div>
    <div v-if="this.likes.includes(this.userId)">
        <i @click="removeLike" class="fa-solid fa-heart cursor-pointer text-red-500"></i>
    </div>
</template>

<script>
    export default {
        name: "PostLike",
        props: {
            post: Object,
            user: Object
        },
        data() {
            return {
                likes: this.post.like,
                userId: '',
                postInfo: {
                    uId: this.post.id,
                    likes: Array
                }
            }
        },
        methods: {
            doLike() {
                this.likes.push(this.user.id.toString())
                this.postInfo.likes = this.likes
                this.$emit("add-like", this.postInfo)
            },
            removeLike() {
                const index = this.likes.indexOf(this.userId.toString())
                if (index > -1) {
                    this.likes.splice(index, 1); 
                }
                this.postInfo.likes = this.likes
                //console.log(this.postInfo.likes)
                this.$emit("remove-like", this.postInfo)
            },
        },
        emits: ['add-like', 'remove-like'],
        mounted() {
            this.likes = this.post.like.split(',')
            //console.log(this.post.like)
        },
        beforeUpdate() {
            if(this.user.id) {
                this.userId = this.user.id.toString()
            }
        },
    }
</script>