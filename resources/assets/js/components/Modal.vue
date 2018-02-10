<template>
    <div @productadded="add()" class="container modal fade">
    <div class="modal-header">
        <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
    </div>
    <div class="spacer"></div>
    <h1>Your Cart</h1>
    <hr>

    <div class="modal-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Options</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th class="column-spacer"></th>
                    <th></th>
                </tr>
            </thead>
        <tbody>
                <tr v-for="item in products">
                    <td>
                        <p class="text-info">{{ item.name }}</p>
                    </td>
                    <td v-if="item.options">
                        <p class="text-info">{{ item.options[0] }}</p>
                    </td>
                    <td>
                        <p>{{ item.qty }}</p>
                    </td>
                    <td>$ {{ item.subtotal / 100 }}</td>
                    <td>{{ item.subtotal /100 }}</td>
                </tr>
                <tr>
                    <td><h3 class="text-info text-center">Total: ${{ price /100 }} </h3></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="spacer"></div>
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Continue Shopping</button>
        <a href="/checkout" class="btn btn-success btn-lg">Proceed to Checkout</a>
        <div style="float:right">
            <input type="submit" @click.prevent="emptycart" data-dismiss="modal" class="btn btn-danger btn-lg" value="Empty Cart">
        </div>
    <div class="spacer"></div>

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
                showModal: false,
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
            emptycart() {
                axios.delete('/emptyCart').then(flash('Cart empty !'))
                                        .then(this.products = '')
                                        .then(this.price = '')
                                        .then(this.showModal = false)
                                        .then(cartisempty())
                                        .catch(e => { console.log(e)})
            },
            add() {
                axios.get('/cartcontent').then(response => {
                    if(response.data) {
                        this.showModal = true
                        this.price = response.data[1]
                        this.products = response.data[0]
                    }
                });
            },
        }
    }
</script>