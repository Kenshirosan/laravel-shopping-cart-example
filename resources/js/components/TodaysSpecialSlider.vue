<template>
    <div>
        <h2>Nos Plats Du Jour</h2>
        <div class="carousel carousel-slider">
            <div v-for="picture of pictures" class="carousel-item" href="#one!">
                <p class="white-text">{{ picture }}</p>
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
