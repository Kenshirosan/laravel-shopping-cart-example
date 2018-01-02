<template>
    <div>
        <div class="row">
            <ul class="list-group col-md-3" v-for="order in orders">
                <li class="list-group-item list-group-item">
                    <p>{{ order.id }}</p>
                    <p>{{ order.items }}</p>
                    <p>{{ order.created_at}} {{ order.created_at }}</p>
                    <p>{{ order.created_at }}</p>
                </li>
            </ul>
        </div>
        <div class="pagination">
            <button class="btn btn-default" @click="fetchOrders(pagination.prev_page_url)"
                    :disabled="!pagination.prev_page_url">
                Previous
            </button>
            <span class="text-info"> Page {{pagination.current_page}} of {{pagination.last_page}} </span>
            <button class="btn btn-default" @click="fetchOrders(pagination.next_page_url)"
                    :disabled="!pagination.next_page_url"> Next
            </button>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

    export default {

        data() {
            return {
                orders: [],
                pagination: {}
            }
        },

        mounted() {
            this.fetchOrders()
        },

        methods: {
            fetchOrders: function (page_url) {
                let vm = this;
                page_url = page_url || '/user/orders'
                axios.get(page_url)
                    .then( (response) => {
                        this.orders = response.data.data
                        this.pagination = response.data
                    });
            }
        }
    }
</script>