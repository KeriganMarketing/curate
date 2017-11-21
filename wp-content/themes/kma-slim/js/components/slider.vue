<template>
    <div class="work-viewer">
        <div class="work-left icon is-large" @click="clickPrev" >
            <i class="fa fa-angle-left is-large" aria-hidden="true"></i>
        </div>

        <div class="work" >
            <slot></slot>
        </div>

        <div class="work-right icon is-large" @click="clickNext" >
            <i class="fa fa-angle-right is-large" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                slides: [],
                activeSlide: 0,
                paused: false
            };
        },

        mounted() {
            this.slides = this.$children;
            this.toSlide(this.$root.activeSlide);
        },

        methods: {

            nextSlide(){
                this.slides[this.activeSlide]._data.isActive = false;
                if(this.activeSlide === this.slides.length-1){
                    this.activeSlide = -1;
                }
                this.activeSlide++;
                this.slides[this.activeSlide]._data.isActive = true
            },

            prevSlide(){
                this.slides[this.activeSlide]._data.isActive = false;
                this.activeSlide--;
                if(this.activeSlide === -1){
                    this.activeSlide = this.slides.length-1;
                }
                this.slides[this.activeSlide]._data.isActive = true;
            },

            clickNext(){
                this.nextSlide();
            },

            clickPrev(){
                this.prevSlide();
            },

            toSlide( keyframe ){
                this.slides[this.activeSlide]._data.isActive = false;
                this.activeSlide = keyframe;
                this.slides[this.activeSlide]._data.isActive = true;
            }

        }

    }
</script>