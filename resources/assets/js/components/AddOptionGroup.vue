<template>
    <div>
        <h1 class="text-center text-primary">{{ this.$props.message }}</h1>
        <form class="form-horizontal" @submit.prevent="addOptionGroup()">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Option Group Name</label>
                <div class="col-md-6">
                    <input
                        @focus="clearError()"
                        id="name"
                        placeholder="Steak, Eggs,something that have many ways of serving.."
                        type="text"
                        class="form-control"
                        name="name"
                        v-model="name" autofocus required
                    >
                   <error :message="`${this.$data.error}`"></error>
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

        <div class="container" v-if="optiongroups">
            <data-table
                @erase="deleteItem($event)"
                id="ID"
                findaname="Option Group"
                :data="this.optiongroups"
            >
            </data-table>
        </div>
    </div>
</template>

<script>
    import Error from './subcomponents/Error';

    export default {
        components: { Error },

        props: ['action', 'message'],

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

                    this.showError(err);
                    setTimeout(()=> this.clearError(), 3000);
                    flash('Something went wrong', 'danger')
                });
            },

            async addOptionGroup() {
                const group = { name: this.$data.name }
                await axios.post(this.$props.action, group)
                    .then(res => {
                        this.fetchItems();
                        this.name = '';
                        return flash(`${group.name} successfully added`);
                    })
                    .catch(err => {
                        this.showError(err);

                        flash(`${err.message} an option with the same name probably exists`, 'danger')
                    });
            },

            async deleteItem(id) {
                await axios.delete(`${this.deletepath}${id}`)
                            .then(res => {
                                flash(`${res.data[1]}`);
                                this.fetchItems();
                            })
                            .catch(err => {
                                this.showError(err);
                                setTimeout(()=> this.clearError(), 3000);
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
</style>