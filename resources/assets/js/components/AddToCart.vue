<template>
    <div>
        <div class="row">
            <select name="options" v-if="options" v-model="option" class="options minimal" required autofocus>
            <option value="" class="reset">Choose</option>
            <option class="options" name="option"
                    v-for="option in options"
                    v-text="option.name"
                    v-bind:value="option.name"
                    ></option>
            </select>
        </div>
        <div class="row">
            <select name="secondoptions" v-if="secondoptions" v-model="secondoption" class="options minimal product-layout-img" required autofocus>
            <option value="" class="reset">Choose</option>
            <option class="options" name="secondoption"
                    v-for="secondoption in secondoptions"
                    v-text="secondoption.name"
                    v-bind:value="secondoption.name"
                    ></option>
            </select>
        </div>
        <input type="submit" @click.prevent="addtocart" class="btn btn-success scale_when_hover" value="Add To Cart">
    </div>
</template>

<script>
    export default {
        props: ['product', 'options', 'secondoptions'],

        data() {
            return {
                id: this.product.id,
                quantity: 1,
                name: this.product.name,
                option: '',
                secondoption: '',
                price: this.product.sales ?
                                            this.product.price - (this.product.price * this.product.sales.percentage)
                                          :
                                            this.product.price
            }
        },


        methods: {
            addtocart() {
                // axios.post('http://webcreation.rocks/cart', this.$data)
                let options = this.options;
                let secondoptions = this.secondoptions;

                if ( (options != undefined && options.length > 0 && this.option == '') || (secondoptions != undefined && secondoptions.length > 0 && this.secondoption == ''))  {
                    return swal("Wait!",
                        `Please pick an option for ${this.product.name}`,
                        "warning");
                } else {
                    axios.post('/cart', this.$data)
                        .then(flash(this.product.name + ' was added to cart'))
                        .then( productitemscountchanged() )
                        .then(setTimeout( () => {
                            this.option = '',
                            this.secondoption = ''
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