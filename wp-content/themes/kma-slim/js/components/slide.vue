<template>
    <div class="piece" :class="{ 'is-active': this.isActive }">
        <slot></slot>
    </div>
</template>

<script>
    export default {

        props: {
            active: { default: false }
        },

        data(){
            return {
                isActive: false
            };
        },

        created(){
            if(this.active == true){ this.isActive = true }
        }

    }
</script>