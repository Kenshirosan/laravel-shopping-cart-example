<template>
    <div>
        <input type="hidden" name="id"  v-model="this.product.id">
        <input type="hidden" name="name"  v-model="this.product.name">
        <input type="hidden" name="price"  v-model="this.product.price">
        <select name="options" v-if="options" class="options minimal" autofocus required v-model="option">
        <option value="" class="reset">Choose</option>
        <option class="options" name="option"
                v-for="option in options"
                v-text="option.name"
                v-bind:value="option.name"
                ></option>
        </select>
        <input type="submit" @click.prevent="addtocart()" class="btn btn-success" value="Add To Cart">
    </div>
</template>

<script>
    export default {
        props: ['product', 'options'],

        data() {
            return {
                id: this.product.id,
                quantity: 1,
                name: this.product.name,
                price: this.product.price,
                option: ''
            }
        },

        methods: {
            addtocart() {
                axios.post('/cart/', this.$data)
                    .then(flash(this.product.name + ' was added to cart'))
                    .then(this.$emit('done'))
                    .then(setTimeout( () => {
                        this.option = ''
                    }, 100 ))
            }
        }
    }
</script>

<style>
    .option{
        color: orangered;
    }
    .reset {
        color: red;
    }
</style>