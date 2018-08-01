<template>
    <div>
        <div class="text-center">
            <h1 class="text-info">{{ this.$props.title }}</h1>
            <p><small><em> {{ message }}</em></small></p>
            <error :message="`${this.$data.error}`"> Some coupons did not load correctly, please contact your webmaster</error>
        </div>
        <hr>
        <form @submit.prevent="addCoupons()" class="form-horizontal">
            <div class="form-group">
                <label for="quantity" class="col-md-4 control-label">How many coupons ?</label>
                <div class="col-md-6">
                    <input
                        @focus="clearError()"
                        id="quantity"
                        type="number"
                        min="0"
                        step="1"
                        class="form-control"
                        placeholder="number of coupons to create"
                        name="quantity"
                        v-model="quantity" autofocus required>
                </div>
            </div>

            <div class="form-group">
                <label for="reward" class="col-md-4 control-label">Coupons percentage</label>
                <div class="col-md-6">
                    <input
                        @focus="clearError()"
                        id="reward"
                        type="number"
                        min="0"
                        step="1"
                        class="form-control"
                        placeholder="reward percentage"
                        name="reward"
                        v-model="reward" autofocus required>
                </div>
            </div>

            <div class="form-group">
            <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    <input type=submit value='Submit' class="btn btn-primary">
                </div>
            </div>
        </form>
        <div class="mb-100"></div>

        <div v-if="coupons.length > 0">
            <data-table
                @erase="deleteItem($event)"
                id="ID"
                findaname="Reward"
                :url="this.endpoint"
                :data="this.coupons"
            >
            </data-table>
        </div>

        <div v-else class="text-center">
            <h1 class="text-info">No Global coupons created</h1>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['info', 'url', 'title'],

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
            this.getItems();
        },

        methods: {
            async getItems() {
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
                    this.getItems();
                })
                .catch(err => {
                    this.showError(err);
                });
            },

            async deleteItem(id) {
                await axios.delete(`/coupons/${id}/delete`)
                    .then(res => {
                        this.getItems();
                        flash('Coupon deleted');
                    })
                    .catch(err => this.showError(err))
            },

            resetForm() {
                this.quantity = '';
                this.reward = '';
            },

            showError(err) {
                return this.error = err.response.data.message;
            },

            clearError() {
                this.error = ''
            },

            resetForm() {
                this.quantity = '';
                this.reward = '';
            },
        }
    }
</script>