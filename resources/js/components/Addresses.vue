<template>
    <div>
        <h3>Your Addresses :</h3>
        <p>
            <small class="text-info">Click on an address to edit it</small>
        </p>
        <ul v-for="(address, index) in addresses">
            <li>
                <a href="!#" @click.prevent="switchAddress(index)">{{
                    address.name
                }}</a>
                <button
                    class="pull-right btn btn-xs btn-danger"
                    @click="deleteAddress(address.id, index)"
                >
                    Delete Address
                </button>
            </li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form class="form-horizontal" @submit.prevent="updateUser">
                        <h4>All fields are mandatory</h4>
                        <div class="form-group">
                            <label>First Name:</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                v-model="userObj.name"
                                placeholder="First Name"
                                required
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.name }}</strong>
                        </span>

                        <div class="form-group">
                            <label>Last Name:</label>
                            <input
                                type="text"
                                name="last_name"
                                class="form-control"
                                v-model="userObj.last_name"
                                placeholder="Last Name"
                                required
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.last_name }}</strong>
                        </span>

                        <div class="form-group">
                            <label>Phone Number:</label>
                            <input
                                type="text"
                                name="phone_number"
                                class="form-control"
                                v-model="userObj.phone_number"
                                placeholder="Phone Number"
                                required
                            />
                            <small class="text-info">
                                {{ userObj.phone_number }}
                            </small>
                        </div>

                        <span class="help-block">
                            <strong>{{ errors.phone_number }}</strong>
                        </span>

                        <label>Email Address:</label>
                        <div class="form-group">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="form-control"
                                v-model="userObj.email"
                                placeholder="Your Email"
                                required
                            />
                            <small class="text-info">
                                Please note you'll need to verify your email
                                address again should you choose to update it
                            </small>
                        </div>

                        <span class="help-block">
                            <strong>{{ errors.email }}</strong>
                        </span>

                        <label>Password:</label>
                        <div class="form-group">
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                v-model="userObj.password"
                                placeholder="Your Password"
                                required
                            />
                        </div>

                        <label>Confirm Password:</label>
                        <div class="form-group">
                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                v-model="userObj.password_confirmation"
                                placeholder="Password Confirmation"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <input
                                type="submit"
                                value="Update your credentials"
                                class="btn btn-primary"
                            />
                            <p>
                                To change your password, logout, go to the login
                                page and click forgot password
                            </p>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 col-md-offset-1">
                    <form
                        class="form-horizontal"
                        method="POST"
                        @submit.prevent="updateAddress"
                    >
                        <h4>All fields are mandatory</h4>
                        <label>Name :</label>
                        <div class="form-group">
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                v-model="addressObj.name"
                                placeholder="Name"
                                required
                            />
                        </div>
                        <label>Address:</label>
                        <div class="form-group">
                            <input
                                type="text"
                                name="address"
                                class="form-control"
                                v-model="addressObj.address"
                                placeholder="Address"
                                required
                            />
                        </div>

                        <span class="help-block">
                            <strong>{{ errors.address }}</strong>
                        </span>

                        <label>Address 2:</label>
                        <div class="form-group">
                            <input
                                type="text"
                                name="address2"
                                class="form-control"
                                v-model="addressObj.address_2"
                                placeholder="Address 2"
                                required
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.address2 }}</strong>
                        </span>

                        <label>City :</label>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="City"
                                v-model="addressObj.city"
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.city }}</strong>
                        </span>

                        <label>Country :</label>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Country"
                                v-model="addressObj.country"
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.country }}</strong>
                        </span>

                        <label>State :</label>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="State"
                                v-model="addressObj.state"
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.state }}</strong>
                        </span>

                        <label>Zipcode:</label>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Zipcode"
                                v-model="addressObj.zipcode"
                            />
                        </div>

                        <span class="help-block" v-if="errors">
                            <strong>{{ errors.zipcode }}</strong>
                        </span>

                        <div class="form-group">
                            <label>Default Address ?</label>
                            <label class="radio-inline"
                                ><input
                                    v-model="addressObj.is_primary"
                                    v-bind:value="1"
                                    type="radio"
                                    name="is_primary"
                                    checked
                                />Yes</label
                            >
                            <label class="radio-inline"
                                ><input
                                    v-model="addressObj.is_primary"
                                    v-bind:value="0"
                                    type="radio"
                                    name="is_primary"
                                />No</label
                            >
                        </div>

                        <div class="form-group">
                            <input
                                type="submit"
                                value="Update your address"
                                class="btn btn-primary"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import filters from '../mixins/filters';

    export default {
        mixins: [filters],

        props: ['user'],

        data() {
            return {
                addresses: [],
                addressObj: {
                    name: '',
                    address: '',
                    address_2: '',
                    city: '',
                    zipcode: '',
                    state: '',
                    country: '',
                    is_primary: '',
                },
                errors: [],
                userObj: {},
            };
        },

        created() {
            window.events.$on('address-added', payload => {
                this.updateAddresses(payload);
            });
        },

        mounted() {
            this.userObj = JSON.parse(this.$props.user);
            this.addresses = this.userObj.addresses;
            this.addressObj = this.addresses[0];
        },

        methods: {
            switchAddress(id) {
                this.addressObj = this.addresses[id];
            },

            updateAddresses(data) {
                this.addresses.push(data);
            },

            updateAddress() {
                axios
                    .patch(
                        `/address/${this.userObj.id}/${this.addressObj.id}/update`,
                        this.addressObj
                    )
                    .then(res => {
                        flash(res.data.success_message);
                    })
                    .catch(err => console.error(err));
            },

            updateUser() {
                axios
                    .patch(`/edit-profile/${this.userObj.id}`, this.userObj)
                    .then(res => console.log(res))
                    .catch(err => console.error(err));
            },

            deleteAddress(addressId, index) {
                axios
                    .delete(
                        `/delete-address/${this.userObj.id}/${addressId}/address`
                    )
                    .then(res => {
                        flash(res.data.success_message);
                        this.addresses.splice(index, 1);
                    })
                    .catch(err => console.error(err));
            },
        },
    };
</script>
