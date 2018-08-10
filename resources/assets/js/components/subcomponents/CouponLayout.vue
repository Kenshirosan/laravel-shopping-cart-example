<template>
    <div>
        <div class="text-center">
            <h1 class="text-info">{{ this.$props.title }}</h1>
            <p><small><em> {{ message }}</em></small></p>
            <error :message="error"> Some coupons did not load correctly, please contact your webmaster</error>
        </div>
        <hr>
        <form @submit.prevent="addItems()" class="form-horizontal">
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
                        <error :error="errors.get('quantity')"></error>
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
                        <error :error="errors.get('reward')"></error>
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

        <div v-if="items.length > 0">
            <data-table
                @erase="deleteItems($event)"
                id="ID"
                findaname="Reward"
                :url="this.endpoint"
                :data="this.items"
            >
            </data-table>
        </div>

        <div v-else class="text-center">
            <h1 class="text-info">No Global coupons created</h1>
        </div>
    </div>
</template>

<script>
    import requests from '../../mixins/requests';

    export default {
        mixins: [requests],

        props: ['info', 'url', 'title'],

        data() {
            return {
                message: this.info,
                endpoint: this.url,
                coupons: '',
                reward: '',
                quantity: '',
                error: '',
                items: ''
            }
        }
    }
</script>