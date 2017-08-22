<template>
    <input type="submit" @click.prevent="addtocart()" class="btn btn-success" value="Add To Cart">
</template>

<script>
    export default {
        props: ['product'],

            data() {
                return {
                    id: this.product.id,
                    quantity: 1,
                    name: this.product.name,
                    price: this.product.price
            }
        },

        methods: {
            addtocart() {
                axios.post('/cart/', this.$data)
                .then(flash(this.product.name + ' was added to cart'));
            },

            remove() {
                axios.delete('/cart/', this.$data).then(flash(this.product.name + 'removed !'));
            }
        }
    }
</script>