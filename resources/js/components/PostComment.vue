<template>
    <div>
        <router-link :to="{name: 'CommentsPage', params: {id: post.id}}">
            <div class="comment">
                <i class="fa-solid fa-comment cursor-pointer text-red-400 comment-icon"></i>
            </div>
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

<style>
.comment {
    width: 80px;
    height: 80px;
    text-align: center;
    align-items: center;
    position: relative;
}
.comment-icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
    right: 0;
}
</style>