<template>
    <div class="alert-section" v-show="show">
        <div class="alert-element is-active" :class="`${level}`">
            <div class="icon">
                <i class="material-icons green-text">notifications</i>
            </div>
            <div class="text">
                <span class="white-text"
                    ><strong>{{ body }}</strong></span
                >
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: this.message,
                level: 'green',
                duration: 3000,
                show: false,
            };
        },
        created() {
            if (this.message) {
                this.flash();
            }
            window.events.$on('flash', data => this.flash(data));
        },
        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }

                this.show = true;

                this.hide(data.duration);
            },

            hide(duration) {
                setTimeout(() => {
                    this.show = false;
                }, duration);
            },
        },
    };
</script>

<style scoped>
    .alert-section .alert-element {
        z-index: 1000;
        position: fixed;
        top: 50px;
        right: 25px;
        color: rgba(255, 255, 255, 0.7);
        border-radius: 4px;
        font-weight: 800;
        display: flex;
        align-items: stretch;
        padding-right: 20px;
        perspective: 1000px;
        opacity: 0;
        transform-origin: bottom left;
        transform: rotate(90deg) scale(0.5) translate(100px, -300px)
            rotateX(90deg);
        transition: all 250ms cubic-bezier(0, 0.6, 0.35, 1.4);
    }
    .alert-section .alert-element .icon {
        padding: 20px;
        background: blue;
        color: white;
        border-radius: 4px 0px 0px 4px;
        overflow: hidden;
    }
    .alert-section .alert-element .icon i {
        transform: scale(0.2) translateY(50px);
        opacity: 0;
        transition: all 250ms cubic-bezier(0, 0.6, 0.35, 1.4) 400ms;
    }

    .alert-section .alert-element .text {
        background: transparent;
        padding: 0 20px;
        display: flex;
        align-items: center;
        border-radius: 0px 4px 4px 0px;
        transform: rotateY(90deg);
        transition: all 500ms ease-in-out 600ms;
        transform-origin: center left;
        opacity: 0;
    }
    .alert-section .alert-element.is-active {
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }
    .alert-section .alert-element.is-active .material-icons {
        transform: scale(1) translateY(0px);
        opacity: 1;
    }
    .alert-section .alert-element.is-active .text {
        transform: rotateY(0deg);
        opacity: 1;
    }
</style>
