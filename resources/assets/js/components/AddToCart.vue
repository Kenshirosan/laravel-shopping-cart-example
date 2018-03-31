<template>
    <div>
        <input type="hidden" name="id" v-model="this.product.id">
        <input type="hidden" name="name" v-model="this.product.name">
        <input type="hidden" name="price" v-model="this.product.price">
        <select name="options" v-if="options" v-model="option" class="options minimal" required autofocus>
        <option value="" class="reset">Choose</option>
        <option class="options" name="option"
                v-for="option in options"
                v-text="option.name"
                v-bind:value="option.name"
                ></option>
        </select>
        <input type="submit" @click.prevent="addtocart" class="btn btn-success" value="Add To Cart">
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
                // axios.post('http://webcreation.rocks/cart', this.$data)
                let options = this.product.group.options;

                if (options.length > 0 && this.option == '') {
                    return swal("Wait!",
                        `Please pick an option for ${this.product.name}`,
                        "warning");
                } else {
                    axios.post('/cart', this.$data)
                        .then(flash(this.product.name + ' was added to cart'))
                        .then( productitemscountchanged() )
                        .then(setTimeout( () => {
                            this.option = ''
                        }, 100 ))
                        .catch( e => {
                            flash(e.response.data, 'danger')
                        })
                }
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