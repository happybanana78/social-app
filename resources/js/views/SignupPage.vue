<template>
    <div
        id="sign_up"
        class="bg-red-500 h-screen w-full fixed top-0 left-0 flex justify-center items-center"
    >
        <div class="w-2/3 main-bg h-3/4 px-10 rounded-lg pt-10 overflow-y-auto">
            <h2 class="text-5xl mt-5">SignUp</h2>
            <form @submit.prevent="signup" style="margin-top: 5%">
                <div class="flex flex-col space-y-2 mb-5">
                    <label class="text-left text-xl">Username</label>
                    <input
                        v-model="this.user.username"
                        class="p-2 text-lg"
                        type="text"
                        required
                    />
                    <div v-if="this.errors">
                        <div v-for="(v, k) in this.errors" :key="k">
                            <div v-for="error in v" :key="error">
                                <b
                                    class="text-red-700"
                                    v-if="
                                        error ==
                                        'The username has already been taken.'
                                    "
                                    >{{ error }}</b
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-2 mb-5">
                    <label class="text-left text-xl">Email</label>
                    <input
                        v-model="this.user.email"
                        class="p-2 text-lg"
                        type="email"
                        required
                    />
                    <div v-if="this.errors">
                        <div v-for="(v, k) in this.errors" :key="k">
                            <div v-for="error in v" :key="error">
                                <b
                                    class="text-red-700"
                                    v-if="
                                        error ==
                                        'The email has already been taken.'
                                    "
                                    >{{ error }}</b
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-2 mb-10">
                    <label class="text-left text-xl">Password</label>
                    <input
                        v-model="this.user.password"
                        class="p-2 text-lg"
                        type="password"
                        required
                    />
                    <div v-if="this.errors">
                        <div v-for="(v, k) in this.errors" :key="k">
                            <div v-for="error in v" :key="error">
                                <b
                                    class="text-red-700"
                                    v-if="
                                        error ==
                                        'The password must be at least 5 characters.'
                                    "
                                    >{{ error }}</b
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-400 text-white rounded-lg text-xl hover:bg-red-500"
                    >
                        SignUp
                    </button>
                </div>
            </form>
            <div class="text-xl pt-10 pr-10 text-left">
                <p>
                    Have an account?
                    <router-link class="text-red-600" to="/login"
                        >Login</router-link
                    >
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import router from "../router";

export default {
    name: "SignupPage",
    data() {
        return {
            user: {
                username: "",
                email: "",
                password: "",
            },
            errors: [],
        };
    },
    methods: {
        async signup() {
            try {
                await axios.post("/api/users/register", this.user);
                await router.push("/login");
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
