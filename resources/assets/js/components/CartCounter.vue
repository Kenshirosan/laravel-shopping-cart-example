<template>
    <li class="active" v-if="count > 0" @productadded="change()" @cartempty="reset()">
        <a href="/cart">Cart : {{ count }} items</a>
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
                'productadded', count => {
                    this.change(this.count)
                },
            );

            window.events.$on(
                'cartempty', count => {
                    this.reset(this.count)
                }
            );
        },

        methods: {
            async change(count) {
                await axios.get('/count').then( response => {
                    this.count = response.data
                });
            },

            reset(count) {
                this.count = 0
            }
        }
    }
</script>