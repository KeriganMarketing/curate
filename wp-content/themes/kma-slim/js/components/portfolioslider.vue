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
                slides: [],
                sliderHeight: 1080
            };
        },

        created(){

            this.slides = this.$children;

        },

        mounted(){

            this.sliderHeight = this.$el.clientHeight;

        },

        methods: {

        }

    }
</script>