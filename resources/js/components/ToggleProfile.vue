<template>
    <div
        class="fixed w-full h-screen top-0 left-0" id="profilePop0"
        @click="closeProfilePopup"></div>
    <div
        class="fixed toggle-profile-bg top-24 sm:left-16 p-10 
        sm:translate-x-0 flex flex-row justify-center items-center w-80 border-2 border-red-200 
        rounded-lg" id="toggleProfile">
        <div class="flex flex-col text-xl space-y-4 text-red-500">
            <router-link :to="'/profile/' + user.username">
                <b class="cursor-pointer">Profile</b>
            </router-link>
            <b class="cursor-pointer" @click="closeProfilePopup(); this.$emit('create-post')">
                Create New Post
            </b>
        </div>
    </div>
</template>

<script>
export default {
    name: "ToggleProfile",
    props: {
        user: Object,
    },
    methods: {
        closeProfilePopup() {
            const toggleProfile = document.getElementById('toggleProfile')
            const profilePop0 = document.getElementById('profilePop0')

            toggleProfile.classList.remove('profile-open-animation')
            toggleProfile.classList.add('profile-close-animation')
            profilePop0.style.display = 'none'

            setTimeout(() => {
                toggleProfile.style.display = 'none'
            }, 450)
        }
    },
    emits: ["create-post"],
};
</script>

<style>
/* profile popup background */
div.toggle-profile-bg {
    background-color: antiquewhite;
}
#toggleProfile,
#profilePop0 {
    display: none;
}

/* open popup animation */
.profile-open-animation {
    animation: 0.5s ease-in-out forwards drop;
}
@keyframes drop {
    0% {
        opacity: 0;
    }
    70% {
        transform: translateY(40px);
    }
    100% {
        transform: translateY(30px);
        opacity: 1;
    }
}

/* close popup animation */
.profile-close-animation {
    animation: 0.5s ease forwards pop;
}
@keyframes pop {
    0% {
        opacity: 1;
        transform: translateY(30px);
    }
    100% {
        transform: translateY(-20px);
        opacity: 0;
    }
}
</style>
