window.Vue = require('vue');

import vueSmoothScroll from '../node_modules/vue-smooth-scroll'
import message from './components/message.vue';
import modal from './components/modal.vue';
import tabs from './components/tabs.vue';
import tab from './components/tab.vue';
import portfolioslider from './components/portfolioslider.vue';
import portfolioslide from './components/portfolioslide.vue';
import slider from './components/slider.vue';
import slide from './components/slide.vue';
import GoogleMap from './components/GoogleMap.vue';

Vue.use(vueSmoothScroll)

var app = new Vue({

    el: '#app',

    components: {
        message,
        modal,
        tabs,
        tab,
        portfolioslider,
        portfolioslide,
        slider,
        slide,
        GoogleMap
    },

    data: {
        isOpen: false,
        modalOpen: '',
        copyright: 'Curate.',
        showSignup: true,
        activeSlide: 0
    },

    methods: {

        toggleMenu(){
            this.isOpen = !this.isOpen;
        },

        sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

    },

    created: function () {

        // window.addEventListener('scroll', this.handleScroll);

    },

    mounted: function() {

        // console.log(this.$children[0].$children[this.$children["0"].$children.length-1].$el.offsetHeight + this.$children[0].$children[this.$children["0"].$children.length-1].$el.clientHeight);

    },

    destroyed: function () {

        // window.removeEventListener('scroll', this.handleScroll);

    }

});

