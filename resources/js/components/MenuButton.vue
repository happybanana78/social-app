<template>
    <div class="text-3xl text-black w-10 h-10
    items-center flex justify-center">
        <i @click="onClickToggle" 
        class="fa-solid fa-bars cursor-pointer"></i>
    </div>
</template>

<script>
    export default {
        name: "MenuButton",
        methods: {
            onClickToggle() {
                this.$emit('toggle-settings')
                //console.log('ciao')
            }
        }
    }
</script>