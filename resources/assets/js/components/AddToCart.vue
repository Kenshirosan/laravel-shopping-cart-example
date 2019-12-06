<template>
    <div>
        <div class="input-field col s12" v-if="options">
            <select id="option" name="option" v-if="optiongroups.length" v-model="option" required multiple>
            <option value="" class="black-text reset" disabled>Choose</option>
            <option name="option"
                    v-for="option in optiongroups"
                    v-text="option.name"
                    v-bind:value="option"
                    class="black-text"
                    ></option>
            </select>
             <label for="options">Choose</label>
        </div>
        <div class="input-field col s12" v-if="waysofcooking">
            <select id="ways" name="ways" v-if="ways.length" v-model="way" required>
            <option value="" class="black-text reset" disabled>How do you want it cooked ?</option>
            <option name="ways"
                    v-for="way in ways"
                    v-text="way"
                    v-bind:value="way"
                    class="black-text"
                    ></option>
            </select>
             <label for="ways">Choose</label>
        </div>
        <a type="submit" @click.prevent="addtocart" class="btn scale_when_hover waves-effect waves-light waves-green"><i class="material-icons left">shopping_cart </i>Add To Cart</a>
    </div>
</template>

<script>
    export default {
        props: ['product', 'groups', 'options', 'waysofcooking'],

        data() {
            return {
                id: this.product.id,
                quantity: 1,
                name: this.product.name,
                optiongroups: [],
                option: [],
                ways: this.waysofcooking,
                way: '',
                price: this.product.sales ?
                                            this.product.price - (this.product.price * this.product.sales.percentage)
                                          :
                                            this.product.price
            }
        },
// TODO: Send the way of cooking
        methods: {
            async addtocart() {
                const options = this.optiongroups;

                if (options != undefined && options.length > 0 && this.option == '') {
                    return swal("Wait!", `Please pick an option for ${this.product.name}`, "warning");
                }

                if (options != undefined && this.option.length > 2 ) {
                    return swal("Wait!", `Two options maximum ${this.product.name}`, "warning");
                }

                const data = {
                                id: this.id,
                                name:this.name,
                                quantity: this.quantity,
                                option: this.option,
                                way: this.way,
                                price: this.price
                            };

                await axios.post('/cart', this.$data).then(res => {
                    flash(`${this.product.name} was added to cart`);
                    productitemscountchanged();
                    this.resetOptions();
                })
                .catch(err => console.log(err));

            },

            resetOptions() {
                this.option = [];
            },

            resetWay() {
                this.way = '';
            },

            getOptionsArray() {
                let optiongroup = [];

                this.options.map(group => {
                    group.options.forEach(option => {

                        optiongroup.push(option);

                        return this.optiongroups = optiongroup;
                    });
                });
            }
        },

        mounted() {
            this.getOptionsArray();
        }

    }
</script>