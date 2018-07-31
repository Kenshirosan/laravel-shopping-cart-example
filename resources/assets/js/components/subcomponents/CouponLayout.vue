<template>
    <div>
        <div class="text-center">
            <h1 class="text-info">Create unique coupons</h1>
            <p><small><em> {{ message }}</em></small></p>
        </div>
        <hr>
        <form @submit.prevent="addCoupons()" class="form-horizontal">
            <div class="form-group">
                <label for="quantity" class="col-md-4 control-label">How many coupons ?</label>
                <div class="col-md-6">
                    <input id="quantity" type="number" min="0" step="1" class="form-control" placeholder="number of coupons to create" name="quantity" v-model="quantity" autofocus required>
                </div>
                <span class="help-block" v-if="error">
                    <strong class="alert alert-danger">{{ error }}</strong>
                </span>
            </div>

            <div class="form-group">
                <label for="reward" class="col-md-4 control-label">Coupons percentage</label>
                <div class="col-md-6">
                    <input id="reward" type="number" min="0" step="1" class="form-control" placeholder="reward percentage" name="reward" v-model="reward" autofocus required>
                </div>
                <span class="help-block" v-if="error">
                    <strong class="alert alert-danger">{{ error }}</strong>
                </span>
            </div>

            <div class="form-group">
            <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    <input type=submit value='Submit' class="btn btn-primary">
                </div>
            </div>
        </form>
        <div class="mb-100"></div>

        <div class="container" v-if="coupons.length > 0">
                <table class="table table-hover even" >
                    <thead>
                    <tr class="text-white">
                        <td><h4>ID</h4></td>
                        <td><h4>Reward</h4></td>
                        <td><h4>Action</h4></td>
                    </tr>
                    </thead>
                    <tbody v-for="item in coupons">
                        <tr class="text-info">
                            <td>{{ item.id }}</td>
                            <td>{{ item.reward }}%</td>
                            <td><button class="btn btn-danger btn-sm" v-on:click="deleteCoupon(item.id)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <div v-else class="text-center">
            <h1 class="text-info">No Global coupons created</h1>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['info', 'url'],

        data() {
            return {
                message: this.info,
                endpoint: this.url,
                coupons: '',
                reward: '',
                quantity: '',
                error: ''
            }
        },

        created() {
            this.getCoupons();
        },

        methods: {
            async getCoupons() {
                await axios.get(this.endpoint)
                    .then(res => {
                        this.coupons = res.data;
                    })
                    .catch(err => {
                        this.showError(err);
                    })
            },

            async addCoupons() {
                const data = { quantity: this.quantity, reward: this.reward };

                await axios.post(this.endpoint, data)
                .then(res => {
                    this.coupons = res.data;
                    flash('Coupon added')
                    this.resetForm();
                    this.getCoupons();
                })
                .catch(err => {
                    this.showError(err);
                });
            },

            async deleteCoupon(id) {
                await axios.delete(`/coupons/${id}/delete`)
                    .then(res => {
                        this.getCoupons();
                        flash('Coupon deleted');
                    })
            },

            resetForm() {
                this.quantity = '';
                this.reward = '';
            },

            showError(err) {
                return this.error = err.response.data.message;
            }
        }
    }
</script>

<style>
    .text-white {
        color: white;
    }
    thead {
        background-color: #605CA8;
    }
    tbody > tr:nth-child(odd) {
        background-color: white;
    }
    .mb-100 {
        margin-bottom: 100px;
    }
</style>