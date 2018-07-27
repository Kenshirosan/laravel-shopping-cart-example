<template>
    <div v-if="orders">
        <div class="panel-info">
            <div class="panel-heading">
                <h4>Your past orders :</h4>
            </div>
        </div>
        <ul class="list-group" v-if="orders">
            <li class="list-group-item list-group-item" v-for="order in orders">
                <a :href="/user-order/+ order.id">
                    <p>Print</p>
                </a>
                <p>Order number : {{ order.id }}</p>
                <p>${{ order.price / 100 }}</p>
                <p>{{ order.created_at | moment }}</p>
            </li>
        </ul>

        <div class="pagination">
            <button class="btn btn-default"
                    @click="fetchOrders(pagination.prev_page_url)"
                    v-if="pagination.prev_page_url"
                    > Previous
            </button>
            <span class="text-info"> Page {{pagination.current_page}} of {{pagination.last_page}} </span>
            <button class="btn btn-default"
                    @click="fetchOrders(pagination.next_page_url)"
                    v-if="pagination.next_page_url"
                    > Next
            </button>
        </div>
    </div>
    <div v-else>
        You did not order anything with us yet.
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

        filters: {
            moment: date => {
                return moment(date).fromNow()
            }
        },

        methods: {
            async fetchOrders(page_url) {
                page_url = page_url || '/user/orders'
                await axios.get(page_url)
                    .then( (response) => {
                        this.orders = response.data.data
                        this.pagination = response.data
                    });
            }
        }
    }
</script>