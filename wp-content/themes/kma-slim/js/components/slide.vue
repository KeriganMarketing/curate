<template>
    <div class="slide full-bg" :style="{ 'background-image': 'url(' + image + ')' }" >
        <div class="hero-label is-dark">
            <h2 class="artist-name is-2">{{ artist }}</h2>
            <p class="title is-3">{{ title }}</p>
            <a :href="{ link }" class="button is-primary">view</a>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            image: { required: true },
            active: { default: false },
            artist: '',
            title: '',
            link: '',
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