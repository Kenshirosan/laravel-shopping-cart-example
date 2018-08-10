import Error from '../models/Error';

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
            const data = {
                option_group_id: this.option_group_id,
                name:this.name,
                percentage: this.percentage,
                product_id: this.id,
                quantity: this.quantity,
                reward: this.reward
            };

            await axios.post(this.URI, data)
                .then(res => {
                    flash('Success');
                    this.getItems();
                    this.resetForm();
                })
                .catch(err => this.showError(err));
        },

        async deleteItems(id) {
            await axios.delete(this.URI + '/' + id)
                .then(res => {
                    flash('Success');
                    this.getItems();
                })
                .catch(err => this.showError(err));
        },

        async addItem(id) {
            await axios.post(this.URI + '/' + id)
                .then(res => {
                    flash('Success');
                    this.getItems();
                })
                .catch(err => this.showError(err));
        },

        clearError() {
            this.errors = new Error();
        },

        showError(err) {
            console.log('toto');
            return this.errors.record(err.response.data.errors);
        },

        resetForm() {
            this.option_group_id = '',
            this.name = '';
            this.percentage = '';
            this.id = '';
            this.quantity = '';
            this.reward = '';
        }
    }
}
