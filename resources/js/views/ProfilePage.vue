<template>
    <div class="absolute top-0 w-full p-10 left-0 right-0 min-h-screen main-bg">
        <ProfileHeader />
        <ToggleSettings
            @logout="logout"
        />
        <LoadingSpinner v-if="this.loading" />
        <div
            v-show="!this.loading"
            class="container mx-auto border-2 border-red-300 rounded-lg mt-24 py-10 px-10 md:px-20 flex flex-col space-y-5 container-bg min-h-screen"
        >
            <div class="flex flex-col sm:flex-row items-center w-full p-5 justify-between border-b-2 
            border-red-300 mb-10 space-y-4 sm:space-y-0">
                <!-- profile img for profile owners -->
                <div
                    class="w-48 h-48 rounded-full relative overflow-hidden"
                    v-if="this.sessionUser.id == this.user.id"
                >
                    <img
                        :src="this.profileImg"
                        onclick="document.getElementById('imgUpload').click()"
                        class="w-full absolute top-1/2 -translate-y-1/2 left-0 right-0 bottom-0 cursor-pointer z-10"
                    />
                    <form class="hidden">
                        <input
                            id="imgUpload"
                            ref="file"
                            type="file"
                            name="profileImg"
                            v-on:change="changeProfile"
                        />
                    </form>
                </div>
                <!-- profile img for guests -->
                <div
                    class="w-48 h-48 rounded-full relative overflow-hidden"
                    v-if="this.sessionUser.id != this.user.id"
                >
                    <img
                        :src="this.profileImg"
                        class="w-full absolute top-1/2 -translate-y-1/2 left-0 right-0 bottom-0 z-10"
                    />
                </div>
                <div class="text-4xl">
                    {{ this.user.username }}
                </div>
            </div>
            <div>
                <div v-for="post in this.userPosts">
                    <div
                        class="border-2 border-red-300 rounded-lg post-bg flex flex-col pb-2 mb-5 overflow-hidden"
                    >
                        <div
                            class="text-3xl text-right mr-3 text-red-400"
                            v-if="this.sessionUser.id == this.user.id"
                        >
                            <i
                                class="fa-solid fa-xmark cursor-pointer"
                                @click="deletePost(post.id)"
                            ></i>
                        </div>
                        <div class="mx-auto">
                            <img
                                :src="`/images/uploads/${post.img}`"
                                alt=""
                                class="w-full mb-2"
                            />
                        </div>
                        <PostData
                            @add-like="like"
                            @remove-like="like"
                            :post="post"
                            :user="this.sessionUser"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileHeader from "../components/ProfileHeader.vue";
import ToggleSettings from "../components/ToggleSettings.vue";
import PostData from "../components/PostData.vue";
import LoadingSpinner from "../components/LoadingSpinner.vue";
export default {
    name: "ProfilePage",
    components: {
        ProfileHeader,
        ToggleSettings,
        PostData,
        LoadingSpinner,
    },
    data() {
        return {
            user: {},
            sessionUser: {},
            userPosts: [],
            file: "",
            profileImg: true,
            loading: true,
        };
    },
    methods: {
        changeProfile() {
            this.file = this.$refs.file.files[0];
            //console.log(this.file)
            let formData = new FormData();
            formData.append("file", this.file);
            formData.append("userId", this.user.id);
            axios
                .post("/api/users/profile", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    this.profileImg = "/images/profile/" + response.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        like(postInfo) {
            //console.log(postInfo)
            this.userPosts.forEach((post) => {
                if (post.id === postInfo.uId) {
                    axios.post("/api/posts/like", postInfo).catch((error) => {
                        console.log(error);
                    });
                }
            });
        },
        deletePost(postId) {
            // console.log(userId)
            // console.log(this.user.id)
            if (this.user.id == this.sessionUser.id) {
                const postInfo = {
                    id: postId,
                };
                axios
                    .post("/api/posts/delete", postInfo)
                    .then((response) => {
                        //console.log(response.data)
                        if (response.data == "post deleted") {
                            axios
                                .get("/api/posts/" + this.user.id)
                                .then((response) => {
                                    this.userPosts = response.data;
                                    //console.log(this.userPosts)
                                })
                                .catch((error) => {
                                    console.log(error);
                                });
                            console.log("post deleted");
                        } else {
                            console.log("Post not deleted, not your post!");
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                console.log("Post not deleted, not your post!");
            }
        },
        logout() {
            if (localStorage.getItem("token")) {
                localStorage.removeItem("token");
                //console.log(localStorage.getItem('token'))
                this.$router.go("/login");
            }
        },
    },
    mounted() {
        const profileUrl = window.location.href;
        const profileArray = profileUrl.split("/");
        const profileUsername = profileArray[profileArray.length - 1];

        const profileUser = {
            username: profileUsername,
        };

        // get current logged in user
        axios
            .post("/api/users/byname", profileUser)
            .then((response) => {
                //console.log(response.data);
                if (response.data == "user not found") {
                    this.$router.push("/");
                }
                this.user = response.data;
                //console.log(this.user)
                this.profileImg = "/images/profile/" + this.user.profileImg;
                axios
                    .get("/api/posts/" + this.user.id)
                    .then((response) => {
                        this.userPosts = response.data;
                        setTimeout(() => {
                            this.loading = false;
                        }, 1000);
                        //console.log(this.userPosts)
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            })
            .catch((errors) => {
                console.log(errors);
            });
        // get current logged in user
        axios
            .get("/api/user", {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            })
            .then((response) => {
                this.sessionUser = response.data;
                // console.log(this.sessionUser)
                // console.log(this.user)
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
};
</script>

<style scoped>
div.main-bg {
    background-color: antiquewhite;
}
</style>
