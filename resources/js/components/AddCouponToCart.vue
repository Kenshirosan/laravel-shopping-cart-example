<template>
    <div class="col m2 s12">
        <p class="blue-text">Do you have a coupon ?</p>
        <div class="form-group">
            <form
                action="/apply-coupon"
                method="POST"
                class="side-by-side"
                @submit.prevent="applyCoupon"
            >
                <div class="col-md-6">
                    <input
                        type="text"
                        name="coupon"
                        placeholder="R5AH-JHXE"
                        v-model="coupon"
                    />
                </div>
                <div class="col-md-6">
                    <input
                        type="submit"
                        class="btn btn-primary"
                        value="Submit"
                    />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                coupon: '',
            };
        },

        methods: {
            applyCoupon() {
                axios
                    .post('/apply-coupon', { coupon: this.coupon })
                    .then(res => {
                        // Fire an event with data received from controller
                        // Get the event in CartTotalPrice.vue
                        if (res.status === 200) {
                            localStorage.setItem('promocode', this.coupon);
                            cartHasDiscount(res.data);
                            flash('Your coupon has been applied');
                            this.coupon = '';
                        }
                    })
                    .catch(err => flash('Coupon  invalide', 'red'));
            },
        },
    };
</script>
