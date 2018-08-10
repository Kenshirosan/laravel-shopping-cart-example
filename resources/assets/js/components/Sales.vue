<template>
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1 class="text-info">Create a Sale</h1>
            </div>

            <form @submit.prevent="addItems"class="form-horizontal">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Add sale
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <div class="col-md-12">
                                <h4>All fields are mandatory</h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <strong>Percentage</strong>
                                <input
                                    @focus="clearError"
                                    type="number"
                                    name="percentage"
                                    class="form-control"
                                    v-model="percentage"
                                    placeholder="Percentage" required/>
                            </div>
                        </div>
                        <error :error="errors.get('percentage')"></error>

                        <div class="form-group">
                            <div class="col-md-12">
                                <select v-model="id" class="options" required autofocus>
                                    <option value="" class="reset">Choose</option>
                                    <option
                                        v-for="product in items"
                                        v-if="!product.is_on_sale"
                                        class="options"
                                        name="product_id"
                                        v-text="product.name"
                                        v-bind:value="product.id"
                                        >
                                    </option>
                                </select>
                                <error :error="errors.get('product_id')"></error>
                            </div>
                        </div>
                        <error></error>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Add Sale" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

            <div class="row" v-if="!items">
                <div class="container">
                    No product on sale.
                </div>
            </div>

            <div class="row" v-else>
                <div class="container">
                    <data-table
                        @erase="deleteItems($event)"
                        findaname="Product on Sale"
                        :data="this.items"
                    >
                    </data-table>
                </div>
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
                percentage: '',
                id: '',
                items: [],
            }
        }
    }
</script>