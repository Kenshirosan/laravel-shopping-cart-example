<template>
    <div>
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

        <div class="container" v-if="optiongroups">
            <h2 class="text-info">Groups available :</h2>
            <div class="col-md-2" v-for="group in optiongroups">
                <p v-text="group.name"></p>
                <form @submit.prevent="deleteGroup(group.id)">
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>
            </div>
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