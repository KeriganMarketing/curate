<template>
    <div class="slider">

        <div class="slides">
            <slot></slot>
        </div>

    </div>
</template>

<script>
    export default {

        data(){
            return {
                slides: []
            };
        },

        created(){

            this.slides = this.$children

        },

        methods: {

        }

    }
</script>