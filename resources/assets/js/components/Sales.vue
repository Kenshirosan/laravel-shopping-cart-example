<template>
    <div class="container">
        <div class="row">
            <div class="panel-body">

                <form @submit.prevent="addProductSale"class="form-horizontal">
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
                                        type="number"
                                        name="percentage"
                                        class="form-control"
                                        v-model="percentage"
                                        placeholder="Percentage" required/>
                                </div>

                                    <span class="help-block">
                                        <strong class="text-dager">{{ error }}</strong>
                                    </span>

                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <select v-model="id" class="options" required autofocus>
                                        <option value="" class="reset">Choose</option>
                                            <option
                                                v-for="product in products"
                                                v-if="! product.is_on_sale"
                                                class="options"
                                                name="product_id"
                                                v-text="product.name"
                                                v-bind:value="product.id">
                                            </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" value="Add Sale" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            <div class="row" v-if="!sales">
                <div class="container">
                    No product on sale.
                </div>
            </div>

            <div class="row" v-else>
                <div class="container">
                    <data-table
                        @erase="deleteItems($event)"
                        id="ID"
                        findaname="Product on Sale"
                        action="Action"
                        :data="this.sales"
                    >
                    </data-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                percentage: '',
                id: '',
                error: '',
                products: [],
                sales: []
            }
        },

        created() {
            this.getItems();
        },

        methods: {
            async getItems() {
                await axios.get('/sales')
                    .then(res => {
                        this.products = res.data[0];
                        this.sales = res.data[1];
                    })
                    .catch(err => console.log(err));
            },

            async addProductSale() {
                const data = { percentage: this.percentage, product_id: this.id};

                await axios.post('/sales', data)
                    .then(res => {
                        flash('Success');
                        this.getItems();
                        this.resetForm();
                    })
                    .catch(err => console.log(err));
            },

            async deleteItems(id) {
                await axios.delete(`/delete-sales/${id}`)
                    .then(res => {
                        flash('Sucess');
                        this.getItems();
                    })
                    .catch(err => console.log(err));
            },

            resetForm() {
                this.percentage = '';
                this.id = '';
            }
        }

    }
</script>