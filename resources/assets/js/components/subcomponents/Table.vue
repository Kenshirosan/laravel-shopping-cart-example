<template>
    <div>
        <table class="table table-hover table-striped table-bordered even">
            <thead>
                <tr class="text-white">
                    <td><h4>{{ this.identifier }}</h4></td>
                    <td><h4>{{ this.title}}</h4></td>
                    <td><h4>Action</h4></td>
                </tr>
            </thead>
            <tbody >
                <tr class="text-info" v-for="item in this.$props.data">
                    <td>{{ item.id }}</td>
                    <td>{{ item.reward || item.name || item.holiday_page_title || item.products.name}}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" @click.prevent="deleteResource(item.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['id', 'findaname', 'data', 'url'],

        data() {
            return {
                identifier: this.id,
                title: this.findaname,
                method: this.action,
                items: this.$props.data,
                endpoint: this.url
            }
        },

        methods: {
            async deleteResource(id) {
                this.$emit('erase', id);
            },
        }
    }
</script>

<style>
    .text-white {
        color: white;
    }
    table {
        width: 100%;
    }
    .table > thead > tr > td {
        padding: 1em;
    }
    .table > tbody > tr > td {
        padding: 0.5em;
    }
    thead {
        background-color: #605CA8;
    }

    .mb-100 {
        margin-bottom: 100px;
    }
</style>