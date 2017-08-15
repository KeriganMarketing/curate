<template>
    <div class="slider">

        <div class="slides" @mouseover="togglePause" @mouseleave="togglePause">
            <slot></slot>
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

        created(){

            this.slides = this.$children
            //setInterval(() => { if(this.paused == false){ this.nextSlide() } }, 6000)

        },

        methods: {

            nextSlide(){
                this.slides[this.activeSlide]._data.isActive = false
                if(this.activeSlide == this.slides.length-1){
                    this.activeSlide = -1
                }
                this.activeSlide++
                this.slides[this.activeSlide]._data.isActive = true
            },

            prevSlide(){
                this.slides[this.activeSlide]._data.isActive = false
                this.activeSlide--
                if(this.activeSlide == -1){
                    this.activeSlide = this.slides.length-1
                }
                this.slides[this.activeSlide]._data.isActive = true
            },

            clickNext(){
                this.nextSlide()
                this.togglePause()
            },

            clickPrev(){
                this.prevSlide()
                this.togglePause()
            },

            togglePause(){
                this.paused = !this.paused;
                console.log('paused: ' + this.paused);
            }

        }

    }
</script>