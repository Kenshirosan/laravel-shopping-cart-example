<template>
    <div class="card">
        <div class="card-content">
            <h5 class="cyan-text pr-10">
                <span>Sous-total : $</span>{{ subtotal }}
            </h5>
            <h5 class="cyan-text pr-10"><span>TVA : $</span>{{ tax }}</h5>
            <h5 v-if="discount == 0" class="cyan-text pr-10">
                <span>Total : $</span>{{ total }}
            </h5>
            <div v-if="discount != 0">
                <p class="mb-10">
                    <span class="text-info"
                        >Congratulations ! {{ discount }}€ discount applied with
                        code {{ code }}</span
                    >
                </p>
                <button class="btn red pr-10" @click="deleteCode">
                    Delete code
                </button>
                <input type="hidden" name="code" :value="code" />
                <h5 class="cyan-text pr-10">
                    <span>Total including discount: $</span>{{ total }}
                </h5>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                code: '',
                tax: '',
                subtotal: '',
                discount: 0,
                total: '',
            };
        },

        created() {
            this.getCartData();

            window.events.$on('discount-applied', payload => {
                this.code = payload.data.code;
                this.tax = payload.data.tax;
                this.subtotal = payload.data.subtotal;
                this.total = payload.data.total;
                this.discount = payload.data.discount;
            });
        },

        methods: {
            getCartData() {
                axios
                    .get('/cart-data')
                    .then(res => {
                        if (res.status === 200) {
                            this.code =
                                res.data.code ||
                                localStorage.getItem('promocode');
                            this.tax = res.data.tax;
                            this.subtotal = res.data.subtotal;
                            this.total = res.data.total;
                            this.discount = res.data.discount;
                        }
                    })
                    .catch(err => console.log(err));
            },

            deleteCode() {
                axios
                    .delete('/user-coupons')
                    .then(res => {
                        if (res.status === 200) {
                            localStorage.removeItem('promocode');
                            this.getCartData();
                        }
                    })
                    .catch(err => console.error(err));
            },
        },
    };
</script>
