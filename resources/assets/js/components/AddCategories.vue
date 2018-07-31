<template>
    <div>
        <h1 class="text-center text-info">Create a Category</h1>
    <hr>
    <form @submit.prevent="addCategory()" class="form-horizontal" method="POST">
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Category name</label>
            <div class="col-md-6">
                <input id="name" type="text" min="0" step="5" class="form-control" placeholder="category name" name="name" v-model="category" autofocus required>

                    <span class="help-block alert alert-danger" v-if="error">
                        <strong>{{ error }}</strong>
                    </span>

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
            <table class="table table-hover even" >
                <thead>
                <tr class="text-white">
                    <td><h4>ID</h4></td>
                    <td><h4>Category Name</h4></td>
                    <td><h4>Action</h4></td>
                </tr>
                </thead>
                <tbody v-for="item in categories">
                    <tr class="text-info">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td><button class="btn btn-danger btn-sm" v-on:click="deleteCategory(item.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

    <div v-else class="text-center">
        <h1 class="text-info">No Categories created</h1>
    </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                category: '',
                categories: [],
                error: ''
            }
        },

        created() {
            this.fetchCategories();
        },

        methods: {
            async fetchCategories() {
                await axios.get('/add-category')
                    .then(res => {
                        this.categories = res.data;
                    })
                    .catch(err => {
                        this.showError(err);
                    });
            },

            async addCategory() {
                const data = { name : this.category };

                await axios.post('/add-category', data)
                    .then(res => {
                        this.fetchCategories();
                        flash('Category added');
                        this.category = '';
                    })
                    .catch(err => {
                        this.showError(err);
                    });
            },

            async deleteCategory(id) {
                await axios.delete(`/delete-category/${id}`)
                    .then(res => {
                        this.fetchCategories();
                        flash('Category deleted');
                    })
                    .catch(err => {
                        this.showError(err);
                    });
            },

            showError(err) {
                return this.error = err.response.data.message
            }
        }
    }
</script>

<style>
    .text-white {
        color: white;
    }
    thead {
        background-color: #605CA8;
    }
    tbody > tr:nth-child(odd) {
        background-color: white;
    }
    .mb-100 {
        margin-bottom: 100px;
    }
</style>