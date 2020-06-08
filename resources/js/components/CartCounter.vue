<template>
    <li class="active" v-if="this.count > 0" @productadded="change" @cartempty="reset()">
        <a href="/cart">Cart : {{ this.count }} items</a>
    </li>
</template>

<script>
    export default {
        props: ['numberofitems'],

        data() {
            return {
                count: this.numberofitems
            }
        },

        created() {
            window.events.$on(
                'productadded', () => {
                    this.change()
                },
            );

            window.events.$on(
                'cartempty', count => {
                    this.reset()
                }
            );
        },

        methods: {
            async change() {
                await axios.get('/count')
                    .then( response => {
                        this.count = response.data;
                    });
            },

            reset() {
                this.count = 0
            }
        }
    }
</script>