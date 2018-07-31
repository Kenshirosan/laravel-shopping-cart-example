<template>
    <div class="container">
        <form class="form-horizontal" @submit.prevent="addOptionGroup()">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Option Group Name</label>
                <div class="col-md-6">
                    <input
                        id="name"
                        placeholder="Steak, Eggs,something that have many ways of serving.."
                        type="text"
                        class="form-control"
                        name="name"
                        v-model="name" autofocus required
                    >
                        <span class="help-block" v-if="error">
                            <strong class="text-danger" v-html="error"></strong>
                        </span>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    <input type="submit" value='Submit' class="btn btn-primary">
                </div>
            </div>
        </form>

        <div class="mb-100"></div>

        <div class="container" >
            <table class="table table-hover even" v-if="optiongroups">
                <thead>
                <tr class="text-white">
                    <td><h4>ID</h4></td>
                    <td><h4>Group Name</h4></td>
                    <td><h4>Action</h4></td>
                </tr>
                </thead>

                <tbody>
                    <tr v-for="group in optiongroups" class="text-info">
                        <td>{{ group.id }}</td>
                        <td>{{ group.name }}</td>
                        <td><button class="btn btn-danger btn-sm" v-on:click="deleteGroup(group.id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['action'],

        data() {
            return {
                error: '',
                optiongroups: '',
                name: '',
                deletepath: ''
            }
        },

        created() {
            this.fetchItems();
        },

        methods: {
            async fetchItems() {
                await axios.get(this.$props.action).then(response => {
                    this.optiongroups = response.data[0];
                    this.deletepath = response.data[1];
                })
                .catch(err => {
                    this.error = err.message;
                    flash('Something went wrong', 'danger')
                });
            },

            async addOptionGroup() {
                const group = { name: this.$data.name }
                await axios.post(this.$props.action, group)
                    .then(res => {
                        this.fetchItems();
                        this.resetForm();
                        return flash(`${group.name} successfully added`);
                    })
                    .catch(err => {
                        this.error = err.message;

                        setTimeout(err => {
                            this.error = '';
                        }, 2000)

                        flash(`${err.message} an option with the same name probably exists`, 'danger')
                    });
            },

            async deleteGroup(id) {
                await axios.delete(`${this.deletepath}${id}`)
                            .then(res => {
                                flash(`${res.data[1]}`);
                                this.fetchItems();
                                this.resetForm();
                            })
                            .catch(err => console.log(err))
            },

            resetForm() {
                this.name = ''
            },
        }
    }
</script>

<style>
    .mb-100 {
        margin-bottom: 100px;
    }
    .text-white {
        color: white;
    }
    thead {
        background-color: #605CA8;
    }
    tbody > tr:nth-child(odd) {
        background-color: white;
    }
</style>