<template>
    <div>
        <h2>Nos Plats Du Jour</h2>
        <div class="carousel carousel-slider">
            <div v-for="picture of pictures" class="carousel-item" href="#one!">
                <img :src="'/img/' + picture" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pictures: [],
                sliderId: '',
            };
        },

        created() {
            this.startSlider();

            window.events.$on('specialschanged', () => {
                clearInterval(this.sliderId);
                this.startSlider();
            });
        },

        methods: {
            async getSpecials() {
                await axios
                    .get('today')
                    .then(res => (this.pictures = res.data))
                    .catch(err => console.log(err));
            },

            async startSlider() {
                await this.getSpecials();

                M.Carousel.init(document.querySelectorAll('.carousel'), {
                    fullWidth: true,
                    dist: 0,
                });

                await this.sliderAuto();
            },

            sliderAuto() {
                const instance = M.Carousel.getInstance(
                    document.querySelector('.carousel')
                );

                this.sliderId = setInterval(() => {
                    instance.next();
                }, 3000);
            },
        },
    };
</script>

<style scoped>
    .carousel {
        width: 720px;
        height: 540px;
        margin: auto;
    }
    h2 {
        margin: 0;
        margin-bottom: 10px;
        text-align: center;
        text-transform: uppercase;
        font-size: 4rem;
        font-weight: 700;
        color: rgba(0, 0, 0, 0.5);
        text-shadow: 1px 1px 1px rgba(145, 145, 145, 1),
            1px 2px 1px rgba(145, 145, 145, 1),
            1px 3px 1px rgba(145, 145, 145, 1),
            1px 4px 1px rgba(145, 145, 145, 1),
            1px 5px 1px rgba(145, 145, 145, 1),
            1px 6px 1px rgba(145, 145, 145, 1),
            1px 7px 1px rgba(145, 145, 145, 1),
            1px 8px 1px rgba(145, 145, 145, 1),
            1px 9px 1px rgba(145, 145, 145, 1),
            1px 10px 1px rgba(145, 145, 145, 1),
            1px 18px 6px rgba(16, 16, 16, 0.4),
            1px 22px 10px rgba(16, 16, 16, 0.2),
            1px 25px 35px rgba(16, 16, 16, 0.2),
            1px 30px 60px rgba(16, 16, 16, 0.4);
    }
</style>
