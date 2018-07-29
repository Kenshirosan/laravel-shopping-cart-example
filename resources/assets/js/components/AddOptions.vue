<template>
    <div>
        <div class="text-center">
            <h1>Items</h1>
            <span class="help-block" v-if="error">
                <strong class="text-danger">{{ error }}</strong>
                <strong class="text-danger">{{ errorMessage }}</strong>
            </span>
        </div>

        <div class="row">
            <form class="form-horizontal" @submit.prevent="addOptions()">
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Option Name</label>
                    <div class="col-md-6">
                        <input
                            @focus="clearError"
                            id="name"
                            placeholder="ex: Long sleeve, Short sleeve..."
                            type="text"
                            class="form-control"
                            name="name"
                            v-model="name" autofocus required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="option" class="col-md-4 control-label">Option Group</label>
                    <div class="col-md-6">
                        <select id="option_group_id" class="form-control" v-model="option_group_id" required>
                            <option value="" class="reset">Choose</option>
                            <option v-for="optiongroup in items[0]"
                                    name="option_group_id"
                                    v-bind:value="optiongroup.id"
                            >{{ optiongroup.name }}
                            </option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label"></label>
                    <div class="col-md-6">
                        <input type=submit value='Submit' class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="col-md-4" v-for="optiongroup in items[0]">
            <ul class="list-group">
                <li class="list-group-item list-group-item-heading">
                    <h3 class="text-primary">Group: {{ optiongroup.name }}</h3>
                </li>
                <li class="list-group-item" v-for="option in optiongroup.options">{{ option.name }}
                    <button @click.prevent="deleteItem(option.id)" type="button" class="btn btn-danger btn-xs pull-right">Delete</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                option_group_id: '',
                name: '',
                items: [],
                error: '',
            }
        },

        created() {
            this.fetchItems();
        },

        methods: {

            async addOptions() {
                const option = {
                    name: this.$data.name,
                    option_group_id: this.$data.option_group_id
                }
                await axios.post('/add-options', option).then(res => {
                    this.fetchItems();
                    this.resetForm();
                    flash('Success');
                })
                .catch(err => {
                    flash('Something went wrong', 'danger');
                    this.error = err.response.data.message;
                })
            },

            async fetchItems() {
                await axios.get('/add-options').then(response => {
                    this.items = response.data;
                })
                .catch(err => flash('Something went wrong'));
            },

            async deleteItem(id) {
                await axios.delete(`/delete/option/${id}`)
                            .then(res => flash('success'))
                            .catch(err => flash('Something went wrong', 'danger'));

                await this.fetchItems();
            },

            resetForm() {
                this.option_group_id = '',
                this.name = ''
            },

            clearError() {
                this.error = ''
            }
        }
    }
</script>