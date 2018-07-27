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

                                <span class="help-block">
                                    <strong>error span</strong>
                                </span>

                            <br>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type=submit value='Submit' class="btn btn-info">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-6" v-if="title" v-for="item in title">
                    <p v-html="item.holiday_page_title"></p>
                    <form @submit.prevent="deleteTitle()">
                        <input type="hidden" name="item" id="id" v-model="id" value="item.id">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

                <div class="col-md-6" v-else>
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
                title: '',
                id: ''
            }
        },

        mounted() {
            this.getTitle();
        },

        methods: {

            async addTitle() {
            const title = { holiday_page_title: this.holiday_page_title };

                await axios.post('/add-holiday-title', title)
                    .then(res => flash('Success'))
                    .then(this.getTitle())
                    .then(this.holiday_page_title = '')
                    .catch(err => console.log(err));
            },

            async getTitle() {
                await axios.get('/add-holiday-title')
                    .then(res => {
                        this.title = res.data
                    })
                    .catch(err => console.log(err));
            },

            async deleteTitle() {
                const id = this.id;
                console.log(id);
                await axios.delete(`/holiday/${id}/delete`)
                    .then(res => console.log(res.data))
                    .catch(err => console.log(err))
            }
        }
    }
</script>