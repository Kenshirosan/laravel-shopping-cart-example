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
                            type="text"
                            name="addressName"
                            class="form-control"
                            v-model="address.name"
                            placeholder="Address Name"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>Address :</label>
                        <input
                            type="text"
                            name="address"
                            class="form-control"
                            v-model="address.address"
                            placeholder="Address"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>Address :</label>
                        <input
                            type="text"
                            name="address_2"
                            class="form-control"
                            v-model="address.address_2"
                            placeholder="Address 2"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>Zipcode :</label>
                        <input
                            type="text"
                            name="zipcode"
                            class="form-control"
                            v-model="address.zipcode"
                            placeholder="Zipcode"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>City :</label>
                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            v-model="address.city"
                            placeholder="City"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>State :</label>
                        <input
                            type="text"
                            name="state"
                            class="form-control"
                            v-model="address.state"
                            placeholder="State"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>Country :</label>
                        <input
                            type="text"
                            name="country"
                            class="form-control"
                            v-model="address.country"
                            placeholder="Country"
                            required
                        />
                    </div>
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
    export default {
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
                        console.log(res);
                        this.$emit('addressAdded');
                        this.address = {};
                        this.show = false;
                    })
                    .catch(err => console.error(err));
            },
        },
    };
</script>
