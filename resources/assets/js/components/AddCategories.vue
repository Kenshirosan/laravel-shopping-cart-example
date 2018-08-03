<template>
    <div>
        <h1 class="text-center text-info">Create a Category</h1>
    <hr>
    <form @submit.prevent="addCategory()" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Category name</label>
            <div class="col-md-6">
                <input
                    @focus="clearError"
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="category name"
                    name="name"
                    v-model="category" autofocus required>

                <error :message="`${this.$data.error}`"></error>

            </div>
        </div>

        <div class="form-group">
        <label for="submit" class="col-md-4 control-label"></label>
            <div class="col-md-6">
                <input type="submit" value='Submit' class="btn btn-primary">
            </div>
        </div>
    </form>

    <!-- spacer -->
    <div class="mb-100"></div>

    <div class="container" v-if="categories.length > 0">
        <data-table
            @deleted="getItems()"
            @erase="deleteItems($event)"
            id="ID"
            findaname="Category"
            :url="this.endpoint"
            :data="this.categories"
        >
        </data-table>
    </div>

    <div v-else class="text-center">
        <h1 class="text-info">No Categories created</h1>
    </div>

    </div>
</template>

<script>
    export default {

        props: ['message', 'url'],

        data() {
            return {
                category: '',
                categories: [],
                endpoint: this.url,
                error: ''
            }
        },

        created() {
            this.getItems();
        },

        methods: {
            async getItems() {
                await axios.get('/add-category')
                    .then(res => {
                        this.categories = res.data;
                    })
                    .catch(err => {
                        this.showError(err);

                        setTimeout(()=> this.clearError(), 3000);
                    });
            },

            async addCategory() {
                const data = { name : this.category };

                await axios.post('/add-category', data)
                    .then(res => {
                        this.getItems();
                        flash('Category added');
                        this.category = '';
                    })
                    .catch(err => {
                        this.showError(err);

                        setTimeout(()=> this.clearError(), 3000);
                    });
            },

            async deleteItems(id) {
                await axios.delete(`/delete-category/${id}`)
                    .then(res => {
                        this.getItems();
                        flash('Category deleted');
                    })
                    .catch(err => {
                        this.showError(err);
                    });
            },

            showError(err) {
                return this.error = err.response.data.message
            },

            clearError() {
                this.error = ''
            }
        }
    }
</script>