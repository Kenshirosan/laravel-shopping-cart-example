<template>
    <div @productadded="add()" class="modal" id="modal">
        <div class="modal-content">
            <h1 class="blue center">Your Cart</h1>
            <hr>
            <table class="striped highlight responsive-table">
                <thead class="blue-text">
                    <tr>
                        <th>Product</th>
                        <th>Options</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th class="text-center">Taxes Included</th>
                        <th class="column-spacer"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="indigo-text">
                    <tr v-for="item in products">
                        <td>
                            <p>{{ item.name }}</p>
                        </td>
                        <td v-if="item.options">
                            <p><strong v-for="option in item.options['options']['options']">{{ option.name }}, </strong></p>
                            <p><strong v-if="item.options['options']['way']">{{ item.options['options']['way'] }} </strong></p>
                        </td>
                        <td>
                            <p>{{ item.qty }}</p>
                        </td>
                        <td>${{ item.subtotal }}</td>
                        <td class="center">${{ (item.subtotal  + item.tax).toFixed(2) }}</td>
                    </tr>
                    <tr>
                        <td><h3>Total: ${{ (this.$data.price) }}</h3></td>
                    </tr>
                </tbody>
            </table>

            <div class="modal-footer">
                <a href="/cart" class="btn blue">Go to Cart</a>
                <input type="submit" @click.prevent="emptycart" class="btn cyan close-modal" value="Empty Cart">
                <button type="button" class="btn indigo close-modal">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['items', 'total'],

        data() {
            return {
                products: this.items,
                price: this.total
            }
        },

        created() {
            window.events.$on(
                'productadded', () => {
                    this.add(this.products)
                }
            );
        },

        methods: {
            async emptycart() {
                await axios.delete('/emptyCart').then(flash('Cart empty !'))
                        .then(this.products = '')
                        .then(this.price = '')
                        .then(cartisempty())
                        .catch(e => {
                            console.log(e)
                        })
            },
            async add() {
                await axios.get('/cartcontent').then(response => {
                    if (response.data) {
                        this.products = response.data[0]
                        this.price = response.data[1]
                    }
                }).catch(e => {
                    console.log(e)
                });
            },
        }
    }
</script>