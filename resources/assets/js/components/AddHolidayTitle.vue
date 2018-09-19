<template>
    <div>
        <div class="row">
            <div class="container">
                <h1 class="text-center text-primary">Add a special's title</h1>
                <form class="form-horizontal" @submit.prevent="addTitle()">
                    <div class="form-group">
                        <label for="holiday_page_title" class="col-md-4 control-label">Enter a title</label>
                        <div class="col-md-6">
                            <input
                                @focus="clearError()"
                                id="holiday_page_title"
                                type="text"
                                class="form-control"
                                name="holiday_page_title"
                                v-model="holiday_page_title" autofocus required>

                                <error :message="`${this.$data.error}`"></error>

                            <br>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" value='Submit' class="btn btn-info">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mb-100"></div>
        <div class="row text-center">
            <div class="container" v-if="titles.length > 0">
                <data-table
                    @deleted="getItems()"
                    @erase="deleteItems($event)"
                    id="ID"
                    findaname="Title"
                    :data="this.titles"
                >
                </data-table>
            </div>
            <div class="container" v-else>
                <div class="col-md-6">
                    <h3 class="text-info">No Holiday page</h3>
                    <p class="text-primary">Please check you deleted your <strong><a class="text-danger" href="/holidays-special">specials</a></strong></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                holiday_page_title: this.value,
                titles: '',
                error: '',
                endpoint: ''
            }
        },

        mounted() {
            this.getTitles();
        },

        methods: {

            async addTitle() {
                const title = { holiday_page_title: this.holiday_page_title };

                await axios.post('/add-holiday-title', title)
                    .then(res => {
                        if(res.status === 200) {
                            adminflash('Success');
                            this.getTitles();
                            return this.holiday_page_title = '';
                        }
                    })
                    .catch(err => {
                        return
                        this.showError(err);
                    });
            },

            async getTitles() {
                await axios.get('/add-holiday-title')
                    .then(res => {
                        if(res.status === 200) {
                            return this.titles = res.data
                        }
                    })
                    .catch((err) => {
                        return this.showError(err);
                    });
            },

            async deleteItems(id) {
                await axios.delete(`/holiday/${id}/delete`)
                    .then(res => {
                        if(res.status === 200) {
                            adminflash('success');
                            return this.getTitles();
                        }
                    })
                    .catch(err => {
                        return this.showError(err);
                    });
            },

            showError(err) {
                return this.error = err.response.data.error || err.response.data.message
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