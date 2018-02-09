<template>
    <li class="active" v-if="count" v-on:productadded="change()">
        <a href="/cart">Items in Cart : {{ count }}</a>
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
                }
            );
        },

        methods: {
            change(count) {
                this.count++;
            }
        }
    }
</script>