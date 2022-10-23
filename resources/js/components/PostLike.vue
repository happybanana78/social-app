<template>
    <div v-if="!this.likes.includes(this.userId)">
        <div @click="doLike" class="cursor-pointer" id="notLiked"></div>
    </div>
    <div v-if="this.likes.includes(this.userId)">
        <div @click="removeLike" class="cursor-pointer" id="liked"></div>
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

<style>
#notLiked {
    background-image:url( 'https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');
    background-position: left;
    background-repeat:no-repeat;
    background-size:2900%;
    height: 80px;
    width: 80px;
}
#liked {
    background-image:url( 'https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');
    background-position: left;
    background-repeat:no-repeat;
    background-size:2900%;
    height: 80px;
    width: 80px;
    animation: like 0.8s steps(28) forwards;
}
#liked:hover {
    background-position:right;
}

@keyframes like {
    from {background-position:left;}
    to { background-position:right;}
}
</style>