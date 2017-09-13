<template>
<div>
    <form action="/order" method="POST">
        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <button type="submit" @click.prevent="buy" class="btn btn-success">Pay with Card</button>

    </form>
</div>
</template>

<script>
    export default {
        props: ['product'];

        data() {
            return {
                stripeEmail: '',
                stripeToken: ''
            };
        },

        created() {
            this.stripe = StripeCheckout.configure({
                key: shop.stripeKey,
                // image: "{{ asset('img/' . $item->model->image) }}",
                locale: "auto",
                token: (token) => {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;
                    axios.post('/order', this.$data)
                        .then(console.log('done'));
                }
            });
        },

        methods: {
            buy() {
                this.stripe.open({
                    name: 'Your order',
                    description: 'Great to have you for dinner',
                    zipCode: true,
                    amount: price
                });
            }
        }
    }
</script>