<template>
    <div class="fixed w-full h-screen top-0 left-0"
    id="settingsPop0" @click="closeSettingsPopup"></div>
    <div class="fixed toggle-profile-bg top-24 sm:right-16 sm:translate-x-0 p-10
    flex flex-row justify-center items-center w-80 border-2 border-red-200
    rounded-lg" id="toggleSettings">
        <div class="flex flex-col text-xl space-y-4 text-red-500">
            <b class="cursor-pointer space-x-2 justify-center flex items-center" @click="onClickLogout">
                <p>Logout</p><i class="fa-solid fa-right-from-bracket"></i>
            </b>
        </div>
    </div>
</template>

<script>
export default {
    name: "ToggleSettings",
    props: {
        toggle: Boolean
    },
    methods: {
        closeSettingsPopup() {
            const toggleSettings = document.getElementById('toggleSettings')
            const settingsPop0 = document.getElementById('settingsPop0')

            toggleSettings.classList.remove('settings-open-animation')
            toggleSettings.classList.add('settings-close-animation')
            settingsPop0.style.display = 'none'

            setTimeout(() => {
                toggleSettings.style.display = 'none'
            }, 450)
        },
        onClickLogout() {
            this.$emit('logout')
        }
    },
    emits: ['logout']
}
</script>

<style>
#toggleSettings,
#settingsPop0 {
    display: none;
}

/* open popup animation */
.settings-open-animation {
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
.settings-close-animation {
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