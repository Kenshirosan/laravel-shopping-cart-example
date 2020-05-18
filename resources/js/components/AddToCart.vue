<template>
    <form id="addtocart">
        <div class="input-field col s12" v-if="options">
            <select id="option" name="option" v-if="optiongroups.length" v-model="option" required multiple>
            <option value="" class="black-text reset" disabled>Choisissez 1 ou 2 accompagnements</option>
            <option name="option"
                    v-for="option in optiongroups"
                    v-text="option.name"
                    v-bind:value="option"
                    class="black-text"
                    ></option>
            </select>
        </div>
        <div class="input-field col s12" v-if="waysofcooking">
            <select id="ways" name="ways" v-if="ways.length" v-model="way" required>
            <option value="" class="black-text reset" disabled>Choisissez la cuisson</option>
            <option name="ways"
                    v-for="way in ways"
                    v-text="way"
                    v-bind:value="way"
                    class="black-text"
                    ></option>
            </select>
        </div>
        <small>
            <a type="submit"
               @click.prevent="addtocart"
               class="btn-small small scale_when_hover waves-effect waves-light waves-green">
                <i class="material-icons left">shopping_cart </i>Ajouter
            </a>
        </small>
    </form>
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

        methods: {
            async addtocart() {
                const options = this.optiongroups;
                const ways = this.ways;

                if (options != undefined && options.length > 0 && this.option == '') {
                    return swal("Attention!", `Choisissez 2 accompagnements maximum ${this.product.name}`, "warning");
                }

                if (options != undefined && this.option.length > 2 ) {
                    return swal("Attention!", `Deux accompagnements maximum ${this.product.name}`, "warning");
                }

                if (ways != undefined && ways.length > 0 && this.way == '') {
                    return swal("Attention!", `Choisissez la cuisson pour ${this.product.name}`, "warning");
                }

                const data = {
                    id: this.id,
                    name: this.name,
                    quantity: this.quantity,
                    option: this.option,
                    way: this.way,
                    price: this.price
                };

                await axios.post('/cart', this.$data).then(res => {
                    flash(`${this.product.name} was added to cart`);
                    productitemscountchanged();
                    this.resetFields();
                    document.getElementById("addtocart").reset();
                })
                .catch(err => console.log(err));

            },

            resetFields() {
                this.option = [];
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