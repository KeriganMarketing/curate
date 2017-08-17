<template>
    <div :id=" 'slide-' + id " class="slide" :style="{ 'background-image': 'url(' + image + ')', 'z-index': zindex }" >
        <div class="slide-contents" v-show="isVisible" >
            <div class="hero-label">
                <p class="artist-name">{{ artist }}</p>
                <p class="artist-title invisible">{{ title }}</p>
                <a :href=" link " class="button is-info">view</a>
            </div>
            <a v-if="islast === false" class="clickdown icon center" :href=" href " v-smooth-scroll ><span class="btn-text">scroll</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            image: { required: true },
            artist: '',
            title: '',
            link: '',
            id: { type: Number },
            islast: { type: Boolean }
        },

        data(){
            return {
                isVisible: false
            };
        },

        mounted(){
            this.isVisible = true
        },

        computed: {
            href: function(){
                var href = this.id;
                return '#slide-' + (href + 1);
            },
            zindex: function(){
                var index = this.id;
                return (20 - index);
            }
        }

    }
</script>