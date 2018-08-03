<template>
    <div v-if="orders.length > 0">
        <data-table
            @deleted="fetchTodaysOrders()"
            @erase="hideOrder($event)"
            @show="showOrder($event)"
            id="ID"
            findaname="Order name"
            :data="orders"
        >
        </data-table>
    </div>

    <div class="col-md-6 col-md-offset-3" v-else>
        <div class="row">
            <h2 class="text-info text-center">
                <strong>No orders yet</strong>
            </h2>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                orders: '',
            }
        },

        mounted() {
            Echo.private('user_ordered')
            .listen('UserOrdered', (order) => {
                this.fetchTodaysOrders();
                flash('New Order');
            });
        },

        created() {
            this.fetchTodaysOrders()
        },

        methods: {
            async showOrder(id) {
                console.log(id)
                await axios.delete(`/show-order/${id}`)
                    .then(res => {
                        flash('Success')
                        this.fetchTodaysOrders()
                    })
                    .catch(err => flash(err, 'danger'))
            },

            async hideOrder(id) {
                await axios.post(`/hide-order/${id}`)
                    .then(res => {
                        flash('Success');
                        this.fetchTodaysOrders();
                    })
                    .catch(err => {
                        flash('Something wrong happenened', 'danger');
                        this.showErrors(err);
                    });
            },

            async fetchTodaysOrders() {
                await axios.get('/customer-orders')
                    .then(res => this.orders = res.data)
                    .catch(err => {
                        flash('Something wrong happenened', 'danger');
                        this.showErrors(err);
                    });
            }
        },

        showError(err) {
            return this.error = err.response.data.message;
        },

        filters: {
            moment: date => {
                return moment(date).format('Y, ddd, MMM Mo')
            },

            time: date => {
                return moment(date).format('H:mm:ss')
            },

            regex: string => {
                return string.replace( /[\[\]\:"]/g, ' ')
            },

            formatted: price => {
                return price / 100;
            }
        },
    }
</script>