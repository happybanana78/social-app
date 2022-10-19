<template>
    <div class="absolute top-0 w-full p-10 left-0 right-0 min-h-screen main-bg">
        <ProfileHeader @toggle-settings="toggleSettings" />
        <ToggleSettings :toggle="this.toggleUserSettings" @logout="logout" @close-settings-toggle="toggleSettings" />
        <div class="container mx-auto border-2 border-red-300
        rounded-lg mt-24 py-10 px-20 flex flex-col space-y-5 container-bg
        min-h-screen">
            <div class="flex items-center w-full p-5 justify-between
            border-b-2 border-red-300">
                <div class="w-1/3">
                    <img :src="this.profileImg" 
                    onclick="document.getElementById('imgUpload').click()"
                    class="w-full rounded-full cursor-pointer">
                    <form class="hidden">
                        <input id="imgUpload" ref="file" type="file" name="profileImg" 
                        v-on:change="changeProfile">
                    </form>
                </div>
                <div class="text-4xl">
                    {{this.user.username}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileHeader from "../components/ProfileHeader.vue"
import ToggleSettings from "../components/ToggleSettings.vue"
export default {
    name: 'ProfilePage',
    components: {
        ProfileHeader,
        ToggleSettings
    },
    data() {
        return {
            user: {},
            toggleUserSettings: false,
            file: '',
            profileImg: true
        }
    },
    methods: {
        toggleSettings() {
            this.toggleUserSettings = !this.toggleUserSettings;
        },
        changeProfile() {
            this.file = this.$refs.file.files[0]
            //console.log(this.file)
            let formData = new FormData()
            formData.append('file', this.file)
            formData.append('userId', this.user.id)
            axios.post('/api/users/profile', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                this.profileImg = '/images/profile/' + response.data
            })
                .catch((errors) => {
                    console.log(errors)
                })
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
                this.profileImg = '/images/profile/' + this.user.profileImg
            })
            .catch((errors) => {
                console.log(errors);
            })
    },
}
</script>

<style scoped>
div.main-bg {
    background-color: antiquewhite;
}
</style>