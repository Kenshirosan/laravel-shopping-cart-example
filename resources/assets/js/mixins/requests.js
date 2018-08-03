export default {

    computed: {
        URI() {
            return window.location.pathname;
        }
    },

    methods: {
        async getItems() {
            await axios.get('/sales')
                .then(res => {
                    this.products = res.data[0];
                    this.sales = res.data[1];
                })
                .catch(err => this.error = err.message);
        },

        async addItems() {
            const data = { percentage: this.percentage, product_id: this.id};

            await axios.post('/sales', data)
                .then(res => {
                    flash('Success');
                    this.getItems();
                    this.resetForm();
                })
                .catch(err => this.error = err.message);
        },

        async deleteItems(id) {
            await axios.delete(`/delete-sales/${id}`)
                .then(res => {
                    flash('Sucess');
                    this.getItems();
                })
                .catch(err => this.error = err.message);
        },

        clearError() {
            this.error = '';
        }
    }
}
