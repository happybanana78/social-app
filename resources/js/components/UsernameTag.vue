<template>
    <div class="text-md cursor-pointer">
        <router-link :to="'/profile/' + this.postUser.username">
            <b>{{this.postUser.username}}</b>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "UsernameTag",
        props: {
            post: Object
        },  
        data() {
            return {
                user: {
                    userId: this.post.userId
                },
                postUser: Object
            }
        },
        mounted() {
            axios.post('/api/users', this.user)
            .then((response) => {
                this.postUser = response.data
                //console.log(this.postUser)
            }).catch((error) => {
                console.log(error)
            })
        }
    }
</script>