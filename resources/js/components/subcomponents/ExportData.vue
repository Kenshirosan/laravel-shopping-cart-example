<template>
    <div>
        <form @submit.prevent="exportCSV">
            <select name="year" v-model="year">
                <option v-for="year in years" v-text="year"></option>
            </select>
            <button type="submit">Exportez les donnees brut</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            year: new Date().getFullYear(),
            years: [],
        }
    },

    created() {
        this.getYears();
    },

    methods: {
        exportCSV() {
            axios.get(`/analytics/export/${this.year}`, {responseType: 'blob'})
                .then(res => {
                    const url = URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', `data-${this.year}.csv`);
                    document.body.appendChild(link);
                    link.click();
                    adminflash('Telechargement OK');
                })
                .catch(err => console.error(err));
        },

        getYears() {
            axios.get(`/analytics/data/years`)
                .then(res => {
                    let years = res.data.map(year => {
                        return year.annee;
                    })

                    this.years = years;
                })
                .catch(err => console.error(err));
        },
    }
}
</script>

<style scoped>

</style>
