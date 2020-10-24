<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-success" @click="show = !show">
                    Add An Address
                </button>

                <form
                    v-if="show"
                    class="form-horizontal"
                    @submit.prevent="addAddress"
                >
                    <h4>All fields are mandatory</h4>
                    <div class="form-group">
                        <label>Address Name :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="addressName"
                            class="form-control"
                            v-model="address.name"
                            placeholder="Address Name"
                            required
                        />
                    </div>
                    <error :error="errors.get('name')"></error>
                    <div class="form-group">
                        <label>Address :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="address"
                            class="form-control"
                            v-model="address.address"
                            placeholder="Address"
                            required
                        />
                    </div>
                    <error :error="errors.get('address')"></error>
                    <div class="form-group">
                        <label>Address :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="address_2"
                            class="form-control"
                            v-model="address.address_2"
                            placeholder="Address 2"
                            required
                        />
                    </div>
                    <error :error="errors.get('address_2')"></error>
                    <div class="form-group">
                        <label>Zipcode :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="zipcode"
                            class="form-control"
                            v-model="address.zipcode"
                            placeholder="Zipcode"
                            required
                        />
                    </div>
                    <error :error="errors.get('zipcode')"></error>
                    <div class="form-group">
                        <label>City :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="city"
                            class="form-control"
                            v-model="address.city"
                            placeholder="City"
                            required
                        />
                    </div>
                    <error :error="errors.get('city')"></error>
                    <div class="form-group">
                        <label>State :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="state"
                            class="form-control"
                            v-model="address.state"
                            placeholder="State"
                            required
                        />
                    </div>
                    <error :error="errors.get('state')"></error>
                    <div class="form-group">
                        <label>Country :</label>
                        <input
                            @focus="clearError"
                            type="text"
                            name="country"
                            class="form-control"
                            v-model="address.country"
                            placeholder="Country"
                            required
                        />
                    </div>
                    <error :error="errors.get('country')"></error>
                    <div class="form-group">
                        <label>Default Address ?</label>
                        <label class="radio-inline"
                            ><input
                                v-model="address.is_primary"
                                v-bind:value="1"
                                type="radio"
                                name="optradio"
                                checked
                            />Yes</label
                        >
                        <label class="radio-inline"
                            ><input
                                v-model="address.is_primary"
                                v-bind:value="0"
                                type="radio"
                                name="optradio"
                            />No</label
                        >
                    </div>
                    <error :error="errors.get('is_primary')"></error>
                    <div class="form-group">
                        <input
                            type="submit"
                            value="Add an address"
                            class="btn btn-primary"
                        />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import requests from '../../mixins/requests';

    export default {
        mixins: [requests],

        data() {
            return {
                address: {
                    name: '',
                    address: '',
                    address_2: '',
                    city: '',
                    zipcode: '',
                    state: '',
                    country: '',
                    is_primary: '',
                },
                show: false,
            };
        },

        methods: {
            addAddress() {
                axios
                    .post('/create/address', this.address)
                    .then(res => {
                        addressAdded(res.data.address);
                        this.address = {};
                        this.show = false;
                        flash(res.data.message.success_message);
                    })
                    .catch(err => {
                        this.showError(err);
                    });
            },
        },
    };
</script>
