<template>
    <div class="text-3xl text-black w-10 h-10
    items-center flex justify-center text-red-600">
        <i @click="settingsPopup" 
        class="fa-solid fa-bars cursor-pointer"></i>
    </div>
</template>

<script>
    export default {
        name: "MenuButton",
        methods: {
            settingsPopup() {
                const toggleSettings = document.getElementById('toggleSettings')
                const settingsPop0 = document.getElementById('settingsPop0')

                toggleSettings.classList.remove('settings-close-animation')
                toggleSettings.classList.add('settings-open-animation')
                toggleSettings.style.display = 'block'
                settingsPop0.style.display = 'block'
            }
        },
    }
</script>