<template>
    <div
        id="sign_up"
        class="bg-red-500 h-screen w-full fixed top-0 left-0 flex justify-center items-center"
    >
        <div class="w-2/3 main-bg h-3/4 px-10 rounded-lg pt-10 overflow-y-auto">
            <h2 class="text-5xl mt-5">Login</h2>
            <form @submit.prevent="login" style="margin-top: 10%">
                <div class="flex flex-col space-y-2 mb-5">
                    <label class="text-left text-xl">Username</label>
                    <input
                        v-model="this.user.username"
                        class="p-2 text-lg"
                        type="text"
                        required
                    />
                </div>
                <div class="flex flex-col space-y-2 mb-10">
                    <label class="text-left text-xl">Password</label>
                    <input
                        v-model="this.user.password"
                        class="p-2 text-lg"
                        type="password"
                        required
                    />
                </div>
                <div class="text-right">
                    <button
                        class="px-4 py-2 bg-red-400 text-white rounded-lg text-xl hover:bg-red-500"
                    >
                        Login
                    </button>
                </div>
            </form>
            <div class="text-xl pt-10 pr-10 text-left">
                <p>
                    Don't have an account?
                    <router-link class="text-red-600" to="/signup"
                        >SignUp</router-link
                    >
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import router from "../router";

export default {
    name: "LoginPage",
    data() {
        return {
            user: {
                username: "",
                password: "",
            },
            errors: [],
        };
    },
    methods: {
        async login() {
            try {
                await axios.post("/api/users/login", this.user)
                .then((response) => {
                    localStorage.setItem('token', response.data)
                    this.$router.push("/")
                })
            } catch (e) {
                if (e.response.status == 422) {
                    this.errors = e.response.data.errors;
                }
            }
        },
    },
};
</script>

<style scoped>
#sign_up {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
}
div.main-bg {
    background-image: url("@/assets/images/static/bg.jpg");
    background-size: cover;
}
input {
    border: 2px solid transparent;
    border-bottom: 2px solid black;
    background: transparent;
}
</style>
