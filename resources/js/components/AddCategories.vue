<template>
    <div>
        <h1 class="text-center text-info">Create a Category</h1>
        <hr />
        <form @submit.prevent="addItems()" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label"
                    >Category name</label
                >
                <div class="col-md-6">
                    <input
                        @focus="clearError"
                        id="name"
                        type="text"
                        class="form-control"
                        placeholder="category name"
                        name="name"
                        v-model="name"
                        autofocus
                        required
                    />

                    <error :error="errors.get('name')"></error>
                </div>
            </div>

            <div class="form-group">
                <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    <input
                        id="submit"
                        type="submit"
                        value="Submit"
                        class="btn btn-primary"
                    />
                </div>
            </div>
        </form>

        <!-- spacer -->
        <div class="mb-100"></div>

        <div class="container" v-if="items.length > 0">
            <data-table
                @deleted="getItems()"
                id="ID"
                findaname="Category"
                :data="this.items"
            >
            </data-table>
        </div>

        <div v-else class="text-center">
            <h1 class="text-info">No Categories created</h1>
        </div>
    </div>
</template>

<script>
    import requests from '../mixins/requests';

    export default {
        mixins: [requests],

        data() {
            return {
                error: '',
                name: '',
                items: '',
            };
        },

        created() {
            this.getItems();
        },

        mounted() {
            window.events.$on('erase', data => this.deleteItems(data));
        },
    };
</script>
