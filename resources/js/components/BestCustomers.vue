<template>
    <div>
        <data-table
            id="ID"
            findaname="Best Customers"
            :data="this.items"
        >
        </data-table>
    </div>
</template>

<script>
    import requests from '../mixins/requests';

    export default {
        mixins: [requests],

        data() {
            return {
                items: '',
            }
        }
    }
</script>