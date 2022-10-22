<template>
    <div class="absolute top-0 w-full p-10 left-0 right-0 min-h-screen main-bg">
        <AppHeader @toggle-profile="toggleProfile" @toggle-settings="toggleSettings" />
        <ToggleProfile :toggle="this.toggleUserProfile" @create-post="
            (this.showCreateModal = true), (this.toggleUserProfile = false)
        " @close-profile-toggle="toggleProfile" :user="user" />
        <ToggleSettings :toggle="this.toggleUserSettings" @logout="logout" @close-settings-toggle="toggleSettings" />
        <AppModal :showModal="this.showCreateModal" @close-modal="this.showCreateModal = false">
            <template v-slot:createForm>
                <form @submit.prevent="createPost">
                    <h2 class="text-left text-2xl border-b-2 border-red-300 pb-1 mb-2">
                        Create Post
                    </h2>
                    <div class="flex flex-col space-y-4 text-xl pb-4">
                        <label for="post_img">Choose an Image</label>
                        <input ref="file" type="file" name="postImg" v-on:change="handleUpload" />
                    </div>
                    <div class="text-right border-t-2 border-red-300 pt-4">
                        <button type="submit"
                            class="px-3 py-1 text-xl bg-red-300 border-2 border-red-400 text-red-800 hover:bg-red-800 hover:text-red-400 rounded-lg"
                            @click="this.showCreateModal = false">
                            Create
                        </button>
                    </div>
                </form>
            </template>
        </AppModal>
        <LoadingSpinner v-if="this.loading" />
        <PostContainer v-show="!this.loading"
        @remove-like="like" @add-like="like" @delete-post="deletePost" :posts="posts" :user="user" />
    </div>
</template>

<script>
import AppHeader from "../components/AppHeader.vue";
import PostContainer from "../components/PostContainer.vue";
import ToggleProfile from "../components/ToggleProfile.vue";
import ToggleSettings from "../components/ToggleSettings.vue";
import AppModal from "../components/AppModal.vue";
import LoadingSpinner from "../components/LoadingSpinner.vue";

export default {
    name: "HomePage",
    components: {
        AppHeader,
        PostContainer,
        ToggleProfile,
        ToggleSettings,
        AppModal,
        LoadingSpinner
    },
    data() {
        return {
            posts: [],
            user: {},
            file: '',
            toggleUserProfile: false,
            toggleUserSettings: false,
            showCreateModal: false,
            token: localStorage.getItem("token"),
            loading: true
        }
    },
    methods: {
        like(postInfo) {
            //console.log(postInfo)
            this.posts.forEach((post) => {
                if (post.id === postInfo.uId) {
                    axios
                        .post("/api/posts/like", postInfo)
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });
        },
        toggleProfile() {
            this.toggleUserProfile = !this.toggleUserProfile;
        },
        toggleSettings() {
            this.toggleUserSettings = !this.toggleUserSettings;
        },
        handleUpload() {
            this.file = this.$refs.file.files[0]
            //console.log(this.file)
        },
        createPost() {
            let formData = new FormData()
            formData.append('file', this.file)
            formData.append('userId', this.user.id)
            axios.post('/api/posts/create', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(() => {
                axios
                    .get("/api/posts")
                    .then((response) => {
                        this.posts = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                //console.log('success')
            })
                .catch((errors) => {
                    console.log(errors)
                })
        },
        deletePost(postId, userId) {
            // console.log(userId)
            // console.log(this.user.id)
            if (this.user.id == userId) {
                const postInfo = {
                    id: postId
                }
                axios.post('/api/posts/delete', postInfo)
                    .then((response) => {
                        //console.log(response.data)
                        if (response.data == 'post deleted') {
                            axios
                                .get("/api/posts")
                                .then((response) => {
                                    this.posts = response.data;
                                })
                                .catch((error) => {
                                    console.log(error);
                                });
                            console.log('post deleted')
                        } else {
                            console.log('Post not deleted, not your post!')
                        }
                    }).catch((error) => {
                        console.log(error)
                    })
            } else {
                console.log('Post not deleted, not your post!')
            }
        },
        logout() {
            if (localStorage.getItem('token')) {
                localStorage.removeItem('token')
                //console.log(localStorage.getItem('token'))
                this.$router.go('/login')
            }
        }
    },
    mounted() {
        // get current logged in user
        axios
            .get("/api/user", {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            })
            .then((response) => {
                this.user = response.data;
                this.postUser = this.user.id
            })
            .catch((errors) => {
                console.log(errors);
            })
        axios
            .get("/api/posts")
            .then((response) => {
                this.posts = response.data;
                setTimeout(() => {
                    this.loading = false
                }, 2000)
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}

div.main-bg {
    background-color: antiquewhite;
}
</style>
