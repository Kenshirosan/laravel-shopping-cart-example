<template>
    <div>
        <div class="input-field col s12">
            <select id="option" name="option" v-if="options" v-model="option" required>
            <option value="" class="reset" disabled>Choose</option>
            <option name="option"
                    v-for="option in options"
                    v-text="option.name"
                    v-bind:value="option.name"
                    ></option>
            </select>
             <label for="options">Choose</label>
        </div>
        <div class="input-field col s12">
            <select id="secondoption" name="secondoption" v-if="secondoptions" v-model="secondoption" required>
            <option value="" class="reset" disabled>Choose</option>
            <option name="secondoption"
                    v-for="secondoption in secondoptions"
                    v-text="secondoption.name"
                    v-bind:value="secondoption.name"
                    ></option>
            </select>
            <label for="secondoption">Choose</label>
        </div>
        <a type="submit" @click.prevent="addtocart" class="btn scale_when_hover waves-effect waves-light waves-green"><i class="material-icons left">shopping_cart </i>Add To Cart</a>
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
            async addtocart() {
                const options = this.options;
                const secondoptions = this.secondoptions;

                if (options != undefined && options.length > 0 && this.option == '') {
                    return swal("Wait!", `Please pick an option for ${this.product.name}`, "warning");
                }

                if (secondoptions != undefined && secondoptions.length > 0 && this.secondoption == '') {
                    return swal("Wait!", `Please pick a second option for ${this.product.name}`, "warning");
                }

                await axios.post('/cart', this.$data).then(res => {
                    flash(`${this.product.name} was added to cart`);
                    productitemscountchanged();
                    this.resetOptions();
                })
                .catch(err => console.log(err));

            },

            resetOptions() {
                this.option = '',
                this.secondoption = ''
            }
        }
    }
</script>