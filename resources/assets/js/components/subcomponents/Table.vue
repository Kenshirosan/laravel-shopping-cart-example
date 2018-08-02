<template>
    <div>
        <div class="text-center mb-100" v-if="this.URI != '/customer-orders'">
            <a href="/customer-orders" class="btn btn-success btn-lg"><h1>Go to Orders Page</h1></a>
        </div>
        <div class="alert alert-success text-center" v-if="this.URI == '/customer-orders'">
            <span><h1>Your Customers Ordered</h1></span>
        </div>
        <table class="table table-hover table-striped table-bordered even">
            <thead>
                <tr class="text-white">
                    <td><h4>{{ this.identifier }}</h4></td>
                    <td><h4>{{ this.title}}</h4></td>
                    <td v-if="this.$props.findaname == 'Order name'"><h4>Order Status</h4></td>
                    <td><h4>Action</h4></td>
                    <td v-if="this.$props.findaname == 'Order name'"><h4>See Order</h4></td>
                </tr>
            </thead>
            <tbody >
                <tr class="text-info" v-for="item in this.$props.data">
                    <td>{{ item.id }}</td>
                    <td>{{ item.reward || item.name || item.holiday_page_title || item.products.name}}</td>
                    <td v-if="item.status"  :class="classes(item.status.name)"><strong >{{ item.status.name }}</strong></td>
                    <td>
                        <button
                            v-if="item.hiddenOrder"
                            class="btn btn-info btn-sm"
                            @click.prevent="showResource(item.id)">Show
                        </button>
                        <button
                            v-else
                            class="btn btn-danger btn-sm"
                            @click.prevent="deleteResource(item.id)">{{ deleteBtnMethod }}
                        </button>
                    </td>
                    <td v-if="!item.hiddenOrder && item.order_type">
                        <a :href="`/order/${item.id}`"
                            v-if="!item.hiddenOrder && item.order_type"
                            class="btn btn-info btn-sm"
                            >Go to order page
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['id', 'findaname', 'data', 'url'],

        data() {
            return {
                identifier: this.id,
                title: this.findaname,
                method: this.action,
                items: this.$props.data,
                endpoint: this.url
            }
        },

        computed: {
            URI() {
                return window.location.pathname;
            },

            deleteBtnMethod() {
                return window.location.pathname == '/customer-orders' ? 'Mark As Processed' : 'Delete'
            },

            class() {
                return this.classes(name)
            }
        },

        methods: {
            classes(name) {
                return name == 'Out for Delivery' ? 'alert-success' : 'text-primary'
            },

            async deleteResource(id) {
                await this.$emit('erase', id);
            },

            async showResource(id) {
                await this.$emit('show', id);
            },
        }
    }
</script>

<style>
    .text-white {
        color: white;
    }
    table {
        width: 100%;
    }
    .table > thead > tr > td {
        padding: 1em;
    }
    .table > tbody > tr > td {
        padding: 0.5em;
    }
    thead {
        background-color: #605CA8;
    }

    .mb-100 {
        margin-bottom: 100px;
    }
</style>