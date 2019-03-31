<template>
    <div class="container">
        <div class="row">
            <h1 class="text-info text-center">Latest orders</h1>
            <ul class="list-group" v-for="order in items">
                <li class="list-group-item active">
                    <h4 class="list-group-item-heading">Latest Orders: {{ order.id }}</h4>
                </li>
                <li class="list-group-item">
                    <p>{{ order.name }} {{ order.last_name }} ordered <strong class="pull-right">{{ order.price | formatted }}</strong>
                        <div class="text-info" v-for="product in order.products">
                            <h4><strong>{{ product.qty}} {{ product.product_name }}</strong>
                                <small class="text-success" v-if="product.options"><strong>{{ product.options }}</strong></small>
                            </h4>
                        </div>
                        on <strong>{{ order.created_at | moment  }}</strong> at {{ order.created_at | time }}
                    </p>
                    
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import filters from '../mixins/filters';
    
    export default {
        mixins: [filters],
        
        data() {
            return {
                items: []
            }
        },

        mounted() {
            Echo.private('user_ordered')
            .listen('UserOrdered', (order) => {
              this.fetchOrders();
              flash('New Order');
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
        }
    }
</script>