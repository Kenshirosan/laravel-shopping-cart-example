<template>
    <div v-if="items.length > 0">
        <data-table
            @deleted="getItems()"
            @erase="deleteItems($event)"
            @show="addItem($event)"
            id="ID"
            findaname="Order name"
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
</template>

<script>
    import requests from '../mixins/requests';

    export default {
        mixins: [requests],

        data() {
            return {
                items: '',
            }
        },

        mounted() {
            Echo.private('user_ordered')
            .listen('UserOrdered', (order) => {
                this.getItems();
            });
        }
    }
</script>