<template>
    <div @productadded="add()" class="container modal fade">
    <div class="modal-header">
        <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
    </div>
    <div class="mb-100"></div>
    <h1>Your Cart</h1>
    <hr>

    <div class="modal-body">
        <table class="table">
            <thead class="text-info">
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
        <tbody>
                <tr v-for="item in products">
                    <td>
                        <p>{{ item.name }}</p>
                    </td>
                    <td v-if="item.options">
                        <p class="text-primary" v-if="item.options[1]"><strong>{{ item.options[0] }} , {{ item.options[1] }}</strong></p>
                        <p class="text-primary" v-else><strong>{{ item.options[0] }}</strong></p>
                    </td>
                    <td>
                        <p>{{ item.qty }}</p>
                    </td>
                    <td class="text-primary">${{ item.subtotal / 100 }}</td>
                    <td class="text-primary text-center">${{ (item.subtotal / 100 + item.tax / 100).toFixed(2) }}</td>
                </tr>
                <tr>
                    <td><h3 class="text-primary text-center">Total: ${{ price /100 }} </h3></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mb-100"></div>
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Continue Shopping</button>
        <a href="/cart" class="btn btn-success btn-lg">Go to Cart</a>
        <div style="float:right">
            <input type="submit" @click.prevent="emptycart" data-dismiss="modal" class="btn btn-danger btn-lg" value="Empty Cart">
        </div>
    <div class="mb-100"></div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</template>

<script>
    export default {
        props: ['items', 'total'],

        data() {
            return{
                products: this.items,
                price: this.total
            }
        },

        created() {
            window.events.$on(
                'productadded', () => {
                    setTimeout( () => {
                        this.add(this.products)
                    }, 100);
                }
            );
        },

        methods: {
            emptycart() {
                axios.delete('/emptyCart').then(flash('Cart empty !'))
                                        .then(this.products = '')
                                        .then(this.price = '')
                                        .then(cartisempty())
                                        .catch(e => { console.log(e)})
            },
            add() {
                axios.get('/cartcontent').then( response => {
                    if(response.data) {
                        this.products = response.data[0]
                        this.price = response.data[1]
                    }
                });
            },
        }
    }
</script>