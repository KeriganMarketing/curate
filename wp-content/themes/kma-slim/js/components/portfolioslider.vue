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

            this.slides = this.$children;
            window.addEventListener('scroll', this.handleScroll);
        },

        mounted(){

//            console.log(this.$children[this.$children.length-1].$el.offsetHeight + this.$children[this.$children.length-1].$el.clientHeight);

        },

        destroyed: function () {

            window.removeEventListener('scroll', this.handleScroll);

        },

        methods: {

            handleScroll() {

                if(window.scrollY > this.$children[this.$children.length-1].$el.offsetHeight + this.$children[this.$children.length-1].$el.clientHeight){
                    this.$parent.showSignup = false;
                }else{
                    this.$parent.showSignup = true;
                }
            }

        }

    }
</script>