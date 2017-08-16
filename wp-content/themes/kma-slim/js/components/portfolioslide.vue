<template>
    <div :id="{ slideId }" class="slide full-bg" :style="{ 'background-image': 'url(' + image + ')' }" >
        <div class="hero-label is-dark">
            <h2 class="artist-name is-2">{{ artist }}</h2>
            <p class="title is-3">{{ title }}</p>
            <a :href="{ link }" class="button is-primary">view</a>
        </div>
        <a class="clickdown icon center" :href="{ href }"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
    </div>
</template>

<script>
    export default {

        props: {
            image: { required: true },
            artist: '',
            title: '',
            link: '',
            id: { type: Number, required: true }
        },

        computed: {
            href: function(){
                return "#" + this.id++;
            },
            slideId: function(){
                return "slide-" + this.id;
            }
        },

    }
</script>