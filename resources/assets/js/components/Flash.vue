<template>
    <div>
        <!-- <div class="alert alert-flash"
            :class="`alert-${level}`"
            role="alert"
            v-show="show"
            v-text="body">
        </div> -->
        <div class="alert-section">
            <div class="alert-element" :class="`alert-${level}`" v-show="show">
                <div class="icon"><span class="glyphicon glyphicon-bell"></span></div>
                <div class="text"><span>{{ body }}</span></div>
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
                level: 'success',
                duration: 5000,
                show: true
            }
        },
        created() {
            if (this.message) {
                this.flash();
            }
            window.events.$on(
                'flash', data => this.flash(data)
            );
        },
        methods: {
            flash(data) {
                if(data){
                    this.body = data.message;
                    this.level = data.level;
                }

                this.animate();

                this.hide(parseInt(data.duration));
            },

            animate() {
                $('.alert-element').addClass('is-active');
            },

            hide(duration) {
                setTimeout(() => {
                    $('.alert-element').removeClass('is-active');
                }, duration);
            }
        }
    };
</script>

<style scoped>
    /*.alert, .alert-flash {
        position: fixed;
        right: 25px;
        top: 50px;
    }*/


    .alert-section .alert-element {
        position: fixed;
        top: 50px;
        right: 25px;
        color: rgba(255, 255, 255, 0.7);
        border-radius: 4px;
        font-weight: 400;
        display: flex;
        align-items: stretch;
        padding-right: 20px;
        perspective: 1000px;
        opacity: 0;
        transform-origin: bottom left;
        transform: rotate(90deg) scale(0.5) translate(100px, -300px) rotateX(90deg);
        transition: all 450ms cubic-bezier(0, 0.6, 0.35, 1.4);
    }
    .alert-section .alert-element .icon {
        padding: 20px;
        background: #0097A7;
        color: white;
        border-radius: 4px 0px 0px 4px;
        overflow: hidden;
    }
    .alert-section  .alert-element .icon span {
        transform: scale(0.2) translateY(50px);
        opacity: 0;
        transition: all 400ms cubic-bezier(0, 0.6, 0.35, 1.4) 600ms;
    }

    .alert-section  .alert-element .text {
        background: rgba(0, 0, 0, 0.8);
        padding: 0 20px;
        display: flex;
        align-items: center;
        border-radius: 0px 4px 4px 0px;
        transform: rotateY(90deg);
        transition: all 500ms ease-in-out 1000ms;
        transform-origin: center left;
        opacity: 0;
    }
    .alert-section .alert-element.is-active {
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }
    .alert-section .alert-element.is-active .glyphicon {
        transform: scale(1) translateY(0px);
        opacity: 1;
    }
    .alert-section .alert-element.is-active  .text {
        transform: rotateY(0deg);
        opacity: 1;
    }

</style>