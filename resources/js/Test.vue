<template>
    <form @submit.prevent="register">
        <input type="text" v-model="this.user.name">
        <input type="text" v-model="this.user.email">
        <input type="text" v-model="this.user.password">
        <button>submit</button>
    </form>
</template>

<script>
export default {
    name: "app",
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
       register() {
            console.log(this.user)
            fetch("/api/register", {
            method: "POST",
            headers: {
                "content-type": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(this.user),
        })
            .catch((err) => console.log(err));

        },
    },
        }
</script>