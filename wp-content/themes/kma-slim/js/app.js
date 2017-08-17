window.Vue = require('vue');

import vueSmoothScroll from '../node_modules/vue-smooth-scroll'
import message from './components/message.vue';
import modal from './components/modal.vue';
import tabs from './components/tabs.vue';
import tab from './components/tab.vue';
import portfolioslider from './components/portfolioslider.vue';
import portfolioslide from './components/portfolioslide.vue';

Vue.use(vueSmoothScroll)

var app = new Vue({

    el: '#app',

    components: {
        message,
        modal,
        tabs,
        tab,
        portfolioslider,
        portfolioslide
    },

    data: {
        isOpen: false,
        modalOpen: false,
        siteby: 'Site by KMA.',
        copyright: 'Curate.',
        showSignup: true
    },

    methods: {

        toggleMenu(){
            this.isOpen = !this.isOpen;
        },
        handleScroll() {

            if(window.scrollY > this.$children[0].$children[this.$children["0"].$children.length-1].$el.offsetHeight + this.$children[0].$children[this.$children["0"].$children.length-1].$el.clientHeight){
                this.showSignup = false;
            }else{
                this.showSignup = true;
            }
        }

    },

    created: function () {

        window.addEventListener('scroll', this.handleScroll);

    },

    mounted: function() {

        console.log(this.$children[0].$children[this.$children["0"].$children.length-1].$el.offsetHeight + this.$children[0].$children[this.$children["0"].$children.length-1].$el.clientHeight);

    },

    destroyed: function () {

        window.removeEventListener('scroll', this.handleScroll);

    }

});

