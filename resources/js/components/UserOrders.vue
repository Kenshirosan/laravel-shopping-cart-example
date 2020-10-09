<template>
    <div>
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <h2 class="text-info text-center">
                    <strong>{{ processed }} Order processed</strong>
                </h2>
            </div>
        </div>
        <div v-if="items.length > 0">
            <data-table
                @deleted="getItems()"
                id="ID"
                findaname="Order Customer"
                :data="items"
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
    </div>
</template>

<script>
    import requests from '../mixins/requests';

    export default {
        mixins: [requests],

        data() {
            return {
                items: '',
                processed: 0,
            };
        },

        mounted() {
            Echo.private('user_ordered').listen('UserOrdered', order => {
                this.getItems();
            });

            window.events.$on('erase', data => {
                this.deleteItems(data);
                this.getOrdersProcessed();
            });
            window.events.$on('show', data => {
                this.addItem(data);
                this.getOrdersProcessed();
            });

            this.getOrdersProcessed();
        },

        methods: {
            getOrdersProcessed() {
                axios
                    .get('/orders-processed')
                    .then(res => (this.processed = res.data))
                    .catch(err => console.error(err));
            },
        },
    };
</script>
