<template>
    <div>
        <div class="row">
            <div class="container">
                <h1 class="text-center text-primary">Add a special's title</h1>
                <form class="form-horizontal" @submit.prevent="addTitle()">
                    <div class="form-group">
                        <label for="holiday_page_title" class="col-md-4 control-label">Enter a title</label>
                        <div class="col-md-6">
                            <input id="holiday_page_title" type="text" class="form-control" name="holiday_page_title" v-model="holiday_page_title" autofocus required>

                                <span class="help-block" v-if="error">
                                    <strong class="text-danger" v-html="error"></strong>
                                </span>

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
        <div class="row">
            <div class="container" v-if="titles.length > 0">
                <div class="col-md-6" v-for="item in titles">
                    <p v-html="item.holiday_page_title"></p>
                    <form @submit.prevent="deleteTitle(item.id)">
                        <input type="hidden" name="itemid" id="itemid" v-model="item.id" value="item.id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
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

        data() {
            return {
                holiday_page_title: this.value,
                titles: '',
                error: ''
            }
        },

        mounted() {
            this.getTitles();
        },

        methods: {

            async addTitle() {
            const title = { holiday_page_title: this.holiday_page_title };

                await axios.post('/add-holiday-title', title)
                    .then(res => flash('Success'))
                    .then(this.getTitles())
                    .then(this.holiday_page_title = '')
                    .catch(err => {
                        this.error = err.response.data.message
                    });
            },

            async getTitles() {
                await axios.get('/add-holiday-title')
                    .then(res => {
                        if(res != []) this.titles = res.data
                    })
                    .catch(err => {
                        this.error = err.response.data;
                    });
            },

            async deleteTitle(id) {
                await axios.delete(`/holiday/${id}/delete`)
                    .then(res => flash('success'))
                    .then(this.getTitles())
                    .catch(err => {
                        this.error = err.message
                    });
            }
        }
    }
</script>