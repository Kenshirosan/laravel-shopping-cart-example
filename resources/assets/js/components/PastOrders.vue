<template>
    <div>

        <ul class="list-group" >
            <li class="list-group-item list-group-item" v-for="order in orders">
                <p v-text="order.id"></p>
                <p>{{ order.items | replace }}</p>
                <p>{{ order.created_at | moment }}</p>
            </li>
        </ul>

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

        filters: {
            moment: function (date) {
                return moment(date).fromNow()
            },

            replace: (str) => {
                str.replace('/[]"/g/', "")
                console.log(str)
                return str
            }
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