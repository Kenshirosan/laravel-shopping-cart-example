<template>
    <div>
        <canvas width="600" height="200"></canvas>
        <form @submit.prevent="exportCSV">
            <button type="submit">Exportez les donnees brut</button>
        </form>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: ['label', 'type', 'color'],

        data() {
            return {
                analytics: [],
                labels: [],
                count: []
            }
        },

        computed: {
            totalCount() {
                let total = 0;

                this.analytics.map(a => {
                     total += a.count || a.total;
                });

                return total;
            },
        },

        mounted() {
            this.getAnalytics();
        },

        methods: {
            exportCSV() {
                axios.get(`/analytics/export/${this.type}`)
                    .then(res => flash('Telechargement OK'))
                    .catch(err => console.error(err));
            },

            async getAnalytics() {
                await axios.get(`/analytics/${this.type}`)
                    .then(res => {
                        this.analytics = res.data

                        this.setUpChart();
                    })
                    .catch(err => console.error(err));
            },

            setUpChart() {
                let options = {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    barPercentage: 1,
                    categoryPercentage: 1,
                };

                let analytics = this.analytics.map(a => a.count || a.total)
                let data = {
                    labels: this.analytics.map(a => a.day || a.annee),
                    datasets: [
                        {
                            label: `${this.label} : ${this.totalCount}`,
                            data: analytics,
                            backgroundColor: this.color,
                            borderColor: this.color,
                        },
                        {
                            label: `${this.label} : ${this.totalCount}`,
                            data: analytics,
                            // Changes this dataset to become a line
                            backgroundColor: 'transparent',
                            borderColor: 'red',
                            type: 'line'
                        }
                    ],
                };

                let context = this.$el.firstChild.getContext('2d');
                new Chart(context,{
                    type: 'bar',
                    data,
                    options
                });
            }
        },



    }
</script>
