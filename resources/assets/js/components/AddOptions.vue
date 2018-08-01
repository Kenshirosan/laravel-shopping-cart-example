<template>
    <div>
        <div class="text-center">
            <h1>Items</h1>
            <error :message="`${this.$data.error}`"></error>
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
        <!-- spacer -->
        <div class="mb-100"></div>

        <div class="container" v-if="items[0]">
            <table class="table table-hover even" v-for="optiongroup in items[0]">
                <thead>
                <tr class="text-white">
                    <td><h4>{{ optiongroup.id }}</h4></td>
                    <td><h4>{{ optiongroup.name }}</h4></td>
                    <td><h4>Action</h4></td>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="option in optiongroup.options" class="text-info">
                        <td>{{ option.id }}</td>
                        <td>{{ option.name }}</td>
                        <td><button class="btn btn-danger btn-sm" v-on:click="deleteItem(option.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['action', 'message'],

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

                await axios.post(this.$props.action, option).then(res => {
                    this.fetchItems();
                    this.resetForm();
                    flash(`${res.data.name} succesfully added`);
                })
                .catch(err => {
                    flash('Something went wrong', 'danger');
                    this.showError(err);
                })
            },

            async fetchItems() {
                await axios.get(this.$props.action).then(response => {
                    this.items = response.data;
                })
                .catch(err => {
                    flash('Something went wrong', 'danger');
                    this.showError(err);
                    setTimeout(()=> this.clearError(), 3000);
                });
            },

            async deleteItem(id) {
                await axios.delete(`${this.$props.action}/${id}`)
                            .then(res => {
                                flash('success');
                                this.fetchItems();
                            })
                            .catch(err => {
                                flash('Something went wrong', 'danger');
                                this.showError(err);
                                setTimeout(()=> this.clearError(), 3000);
                            });
            },

            resetForm() {
                this.option_group_id = '',
                this.name = ''
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