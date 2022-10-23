<template>
    <div>
        <div class="fixed create-post-under-bg top-0 left-0
        h-screen w-full flex justify-center items-center z-20"
        @click.self="this.$emit('close-modal')"
        v-show="this.showModal">
            <div class="create-post-bg border-2 rounded-lg z-30
            border-red-300 p-5 w-1/2">
                <slot name="createForm"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreatePost",
        props: {
            showModal: Boolean
        }
    }
</script>

<style>
.create-post-bg {
  background-color: antiquewhite;
}
.create-post-under-bg {
  background-color: rgba(0, 0, 0, 0.8);
}
</style>