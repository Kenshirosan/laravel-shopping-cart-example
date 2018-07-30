<template>
    <div class="container">
        <div class="row">
            <h1 class="text-info text-center">Latest orders</h1>
            <ul class="list-group" v-for="order in items">
                <li class="list-group-item active">
                    <h4 class="list-group-item-heading">Latest Orders: {{ order.id }}</h4>
                </li>
                <li class="list-group-item">
                    <p>{{ order.name }} {{ order.last_name }} paid <strong>{{ order.price | formatted }}</strong> for {{ order.items | regex }} on <strong>{{ order.created_at | moment  }}</strong> at {{ order.created_at | time }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                items: []
            }
        },

        mounted() {
            Echo.private('user_ordered')
            .listen('UserOrdered', (order) => {
              this.fetchOrders();
            });
        },

        created() {
            this.fetchOrders();
        },

        methods: {
            async fetchOrders() {
                axios.get('/restaurantpanel')
                .then(res => {
                    this.items = res.data
                })
                .catch(err => flash('Something wrong happened', 'danger'))
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