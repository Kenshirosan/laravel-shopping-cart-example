import Error from '../utilities/Error';

export default {

    data() {
        return {
            errors: new Error()
        }
    },

    computed: {
        URI() {
            return this.endpoint || window.location.pathname;
        }
    },

    created() {
        this.getItems();
    },

    methods: {
        async getItems() {
            await axios.get(this.URI)
                .then(res => {
                    this.items = res.data;
                })
                .catch(err => this.showError());
        },

        async addItems() {
            await axios.post(this.URI, this.$data)
                .then(res => {
                    this.items = res.data;

                    if (this.URI == '/contact-us') {
                        flash('Thank you! Your message was received, we will contact you ASAP.', 'green', '5000');
                    } else {
                        adminflash('Success');
                    }

                    this.resetForm();
                })
                .catch(err => this.showError(err));
        },

        async deleteItems(id) {
            await axios.delete(this.URI + '/' + id)
                .then(res => {
                    adminflash('Success');
                    this.items = res.data;
                })
                .catch(err => this.showError(err));
        },

        async addItem(id) {
            await axios.post(this.URI + '/' + id)
                .then(res => {
                    adminflash('Success');
                    this.items = res.data;
                })
                .catch(err => this.showError(err));
        },

        clearError() {
            this.errors = new Error();
        },

        showError(err) {
            return this.errors.record(err.response.data.errors);
        },

        resetForm() {
            this.option_group_id = '',
            this.name = '';
            this.percentage = '';
            this.id = '';
            this.quantity = '';
            this.reward = '';
            this.phone = '';
            this.email = '';
            this.message = '';
        }
    }
}
