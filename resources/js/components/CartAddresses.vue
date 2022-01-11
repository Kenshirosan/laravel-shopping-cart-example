<template>
    <div class="row">
        <p class="mb-10">
            <small class="green-text">Where should we deliver ?</small>
        </p>
        <ul v-for="address in addresses" v-bind:key="address.id">
            <li>
                <a
                    href="#!"
                    v-text="address.name"
                    @click.prevent="changeAddress(address.id)"
                ></a>
            </li>
        </ul>

        <div class="input-field col m4 s12">
            <i class="material-icons prefix">account_circle</i>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control black-text"
                v-model="user.name"
            />
            <label for="name">Your Name</label>
        </div>

        <div class="input-field col m4 s12">
            <i class="material-icons prefix">account_circle</i>
            <input
                type="text"
                id="last_name"
                name="last_name"
                class="form-control black-text"
                v-model="user.last_name"
            />
            <label for="last_name">Last Name</label>
        </div>

        <div class="input-field col m12 s12">
            <i class="material-icons prefix">my_location</i>
            <input
                type="text"
                id="address"
                name="address"
                class="form-control black-text"
                v-model="addressObj.address"
            />
            <label for="address">Address</label>
        </div>

        <div class="input-field col m12 s12">
            <i class="material-icons prefix">my_location</i>
            <input
                type="text"
                id="address2"
                name="address2"
                class="form-control black-text"
                v-model="addressObj.address_2"
            />
            <label for="address2">Address 2</label>
        </div>

        <div class="input-field col m6 s12">
            <i class="material-icons prefix">my_location</i>
            <input
                type="text"
                id="zipcode"
                name="zipcode"
                class="form-control black-text"
                v-model="addressObj.zipcode"
            />
            <label class="select-label" for="zipcode">Zipcode</label>
        </div>

        <div class="input-field col m12 s12">
            <i class="material-icons prefix">phone</i>
            <input
                class="form-control black-text"
                id="tel"
                type="tel"
                name="phone_number"
                v-model="user.phone_number"
            />
            <label for="tel">Phone</label>
        </div>

        <div class="input-field col m4 s12">
            <i class="material-icons prefix">email</i>
            <input
                type="email"
                class="form-control black-text"
                id="email"
                readonly
                name="email"
                v-model="user.email"
            />
            <label for="email">Email</label>
        </div>

        <div class="input-field col m12 s12">
            <i class="material-icons prefix">message</i>
            <textarea
                maxlength="500"
                id="comments"
                name="comments"
                class="black-text materialize-textarea"
                placeholder="Anything we need ton know? Allergies? A name on the order ? 500 characters max"
            ></textarea>
            <label for="comments">Comments</label>
        </div>
        <!--        <label class="radio-inline"-->
        <!--            ><toggle v-model="checked" class="ml-30"></toggle>-->
        <!--        </label>-->
    </div>
</template>

<script>
    export default {
        name: 'CartAddresses',

        props: ['addresses', 'user'],

        data() {
            return {
                checked: false,
                addressObj: {
                    name: '',
                    address: '',
                    address_2: '',
                    zipcode: '',
                    city: '',
                    state: '',
                    country: '',
                },
            };
        },

        mounted() {
            this.assignAddress();
        },

        methods: {
            changeAddress(addressId) {
                this.$props.addresses.map(address => {
                    if (address.id === addressId) {
                        this.addressObj = address;
                    }
                });
            },

            assignAddress() {
                const addresses = this.$props.addresses;
                addresses.forEach(address => {
                    if (address.is_primary) {
                        this.addressObj = address;
                    }
                });
            },
        },
    };
</script>
