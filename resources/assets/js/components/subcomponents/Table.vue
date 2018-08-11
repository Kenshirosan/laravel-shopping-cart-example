<template>
    <div>
        <div class="text-center mb-100" v-if="URI != '/customer-orders'">
            <a href="/customer-orders" class="btn btn-success btn-lg"><h1>Go to Orders Page</h1></a>
        </div>
        <div class="alert alert-warning text-center mb-100" v-if="URI == '/customer-orders'">
            <span><h1>Your Customers Ordered</h1></span>
        </div>

        <!-- AddOptions.vue Component -->
        <div v-if="URI == '/add-options' || URI == '/add-second-options'">
            <table class="table table-hover even" v-for="optiongroup in data">
                <thead>
                <tr class="text-white">
                    <td><h4>{{ optiongroup.id }}</h4></td>
                    <td><h4>{{ optiongroup.name }}</h4></td>
                    <td><h4>Action</h4></td>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="option in optiongroup.options" class="text-info">
                        <td>{{ option.id }}</td>
                        <td>{{ option.name }}</td>
                        <td><button class="btn btn-danger btn-sm" @click.prevent="deleteResource(option.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sales.vue Component -->

        <div v-else-if="URI == '/sales'">
            <table class="table table-hover even">
                <thead>
                <tr class="text-white">
                    <td><h4>ID</h4></td>
                    <td><h4>Sales</h4></td>
                    <td><h4>Action</h4></td>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-info" v-for="product in data" v-if="product.is_on_sale">
                        <td>{{ product.id }}</td>
                        <td>
                            <p>{{ product.name }}</p>
                            <p>{{ product.sales.percentage * 100 }}% Off</p>
                        </td>
                        <td><button class="btn btn-danger btn-sm" @click.prevent="deleteResource(product.sales.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table used in the folowing components -->
        <!-- AddOptionGroup.vue, BestCustomers.vue, AddCategories.vue, CouponLayout.vue, UserOrders.vue -->
        <div v-else>
            <table class="table table-hover table-striped table-bordered even">
                <thead>
                    <tr class="text-white">
                        <td><h4>{{ this.identifier }}</h4></td>
                        <td><h4>{{ this.title}}</h4></td>
                        <td v-if="URI == '/best-customers'"><h4>Email</h4></td>
                        <td v-if="URI == '/best-customers'"><h4>Amount this Year</h4></td>
                        <td v-if="URI == '/customer-orders'"><h4>Order Status</h4></td>
                        <td v-if="URI == '/customer-orders'"><h4>Order Type</h4></td>
                        <td><h4>Action</h4></td>
                        <td v-if="URI == '/customer-orders'"><h4>See Order</h4></td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-info" v-for="item in data">
                        <td>{{ item.id || item.user_id }}</td>
                        <td v-if="URI == '/best-customers'">{{ item.name + ' ' + item.last_name }}</td>
                        <td v-else>{{ item.reward || item.name || item.holiday_page_title || item.products.name}}
                        </td>
                        <td v-if="URI == '/best-customers'"><strong>{{ item.email }}</strong></td>
                        <td v-if="URI == '/best-customers'" class="text-success">${{ item.total/100 }}</td>
                        <td v-if="URI == '/customer-orders'" :class="classes(item.hiddenOrder || item.status.name)">
                            <h4 class="text-info"><strong>{{ item.status.name }}</strong></h4>
                            <h4 class="text-white"><strong>{{ item.items | regex }}</strong></h4>
                            <p class="text-primary">
                                <small>{{ item.created_at | moment }} at {{ item.created_at | time }} </small>
                            </p>
                            <p class="text-danger"><small>${{ item.price | formatted }}</small></p>
                        </td>
                        <td v-if="URI == '/customer-orders'">
                            <h4>{{ item.order_type }}</h4>
                            <p v-if="item.order_type == 'Pick-up'">at {{ item.pickup_time }}</p>
                        </td>
                        <td>
                            <button
                                v-if="item.hiddenOrder"
                                class="btn btn-info btn-sm"
                                @click.prevent="showResource(item.id)">Show
                            </button>
                            <button
                                v-else-if="URI == '/best-customers'"
                                class="btn btn-primary btn-sm"
                                @click.prevent="email(item.email)">Email
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
    </div>
</template>

<script>
    export default {
        props: ['id', 'findaname', 'url', 'data'],

        data() {
            return {
                identifier: this.id,
                title: this.findaname,
                items: this.data,
                endpoint: this.url,
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
                return this.classes()
            }
        },

        methods: {
            classes(name) {
                if (name === true) {
                    return 'alert-success';
                }

                return name === 'Out for Delivery' ? 'alert-success' : 'alert-warning';
            },

            email(emailAddress) {
                return window.location.href = `mailto:${email}`;
            },

            async deleteResource(id) {
                await this.$emit('erase', id);
            },

            async showResource(id) {
                await this.$emit('show', id);
            }
        },

        filters: {
            moment: date => {
                return moment(date).format('Y, ddd, MMM Mo');
            },

            time: date => {
                return moment(date).format('H:mm:ss');
            },

            regex: string => {
                return string.replace( /[\[\]\:"]/g, ' ');
            },

            formatted: price => {
                return price / 100;
            }
        },
    }
</script>

<style scoped>
    body {
        overflow: scroll;
    }
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