<template>

    <div class="col-md-6 col-md-offset-3" v-if="orders">
        <div class="row">
            <div class="col-md-12">
                <h2 class="btn btn-lg btn-default pull-right"><a href="/calendar">Calendar</a></h2>
                <h1 class="text-info text-center">Today's Orders</h1>
            </div>
            <div class="mb-100"></div>
        </div>
        <ul class="list-group">
            <li class="list-group-item" v-for="order in orders">
                <div v-if="order.hiddenOrder">
                    <form @submit.prevent="showOrder(order.id)">
                        <p class="text-right" >
                            <button type="submit" class="btn btn-info btn-sm">
                                Show Order {{ order.id }}
                            </button>
                        </p>
                    </form>
                </div>
                <div v-else>
                    <a :href="`/order/${order.id}`" class="admin-links">
                        <h4 class="admin-links">Order: {{ order.id }}</h4>
                        <p><strong>{{ order.order_type }}</strong></p>
                        <p>
                            {{ order.name }} {{ order.last_name }} paid <strong>{{ order.price | formatted}}</strong> for {{ order.items | regex }} on <strong>{{ order.created_at | moment}}</strong> at {{ order.created_at | time }}
                        </p>
                    </a>
                    <p v-if="order.comments">{{ order.comments }}</p>
                    <a :href="`/order/${order.id}`" class="btn btn-primary btn-sm pull-right">View order</a>
                    <form @submit.prevent="hideOrder(order.id)">
                        <input type="submit" class="btn btn-danger btn-sm" value="Hide">
                    </form>
                </div>
            </li>
        </ul>
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
                        flash('Success')
                        this.fetchTodaysOrders()
                    })
                    .catch(err => flash(err, 'danger'))
            },

            async fetchTodaysOrders() {
                await axios.get('/customer-orders')
                    .then(res => this.orders = res.data)
                    .catch(err => console.log(err.message));
            }
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
