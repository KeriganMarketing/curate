<template>
    <div class="modal is-active" v-if="this.$parent.modalOpen != ''">
        <div class="modal-background" @click="toggleModal"></div>
        <div class="modal-content large">
            <slot></slot>
        </div>
        <button class="modal-close is-large" @click="toggleModal"></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false
            }
        },
        methods: {
            toggleModal(){
                this.showModal = !this.showModal;
                if(this.$root.modalOpen !== ''){
                    this.$root.modalOpen = ''
                }
            }

        },
        mounted() {
            console.log('Component mounted.');
        },
        created(){
            console.log('Component created.');

            this.$root.$on('toggleModal', function (modal, keyframe) {
                this.modalOpen = modal;
                this.activeSlide = keyframe;
            });
        }
    }
</script>