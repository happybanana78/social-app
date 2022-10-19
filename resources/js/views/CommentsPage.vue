<template>
    <div class="absolute top-0 w-full p-10 left-0 right-0 min-h-screen main-bg">
        <CommentsHeader />
        <div class="container mx-auto border-2 border-red-300
        rounded-lg mt-24 py-10 px-20 flex flex-col space-y-5 container-bg
        min-h-screen">
            <div class="container mx-auto max-h-96 overflow-auto
            p-5 flex flex-col-reverse">
                <div class="flex flex-col space-y-5">
                    <div v-for="comment in this.comments" class="bg-red-300 px-4 py-2 rounded-full">
                        {{comment.text}}
                    </div>
                </div>
            </div>
            <div class="container mx-auto">
                <form @submit.prevent="sendComment" class="flex space-x-3">
                    <input type="text" v-model="newComment.text" class="w-full py-2 px-3 border-b-2 border-slate-900">
                    <button><i class="fa-solid fa-paper-plane text-3xl"></i></button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import CommentsHeader from "../components/CommentsHeader.vue"
export default {
    name: 'CommentsPage',
    components: {
        CommentsHeader
    },
    data() {
        return {
            comments: Array,
            user: Object,
            newComment: {
                postId: parseInt(this.$route.params.id),
                userId: '',
                text: ''
            }
        }
    },
    methods: {
        sendComment() {
            //console.log(linkify.find(this.newComment.text)); 
            if (this.newComment.text) {
                axios.post('/api/posts/comment', this.newComment)
                    .then((response) => {
                        if (response) {
                            axios.get('/api/posts/comments/' + this.$route.params.id)
                                .then((response) => {
                                    this.comments = response.data
                                }).catch((error) => {
                                    console.log(error)
                                })
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    })
                this.newComment.text = ''
            }
        }
    },
    mounted() {
        axios.get('/api/posts/comments/' + this.$route.params.id)
            .then((response) => {
                this.comments = response.data
                //console.log(this.comments)
            }).catch((error) => {
                console.log(error)
            })
        // get current logged in user
        axios
            .get("/api/user")
            .then((response) => {
                this.user = response.data;
                this.newComment.userId = this.user.id
            })
            .catch((errors) => {
                console.log(errors);
            })
    }
}
</script>

<style scoped>
div.main-bg {
    background-color: antiquewhite;
}
</style>