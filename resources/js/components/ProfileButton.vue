<template>
    <div class="text-3xl bg-white rounded-full text-black w-10 h-10
    items-center flex justify-center text-red-600">
        <i @click="profilePopup"
        class="fa-solid fa-user cursor-pointer profile-btn"></i>
    </div>
</template>

<script>
    export default {
        name: "ProfileButton",
        methods: {
            profilePopup() {
                const toggleProfile = document.getElementById('toggleProfile')
                const profilePop0 = document.getElementById('profilePop0')

                toggleProfile.classList.remove('profile-close-animation')
                toggleProfile.classList.add('profile-open-animation')
                toggleProfile.style.display = 'block'
                profilePop0.style.display = 'block'
            }
        }
    }
</script>