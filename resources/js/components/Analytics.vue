<template>
    <div>
        <canvas width="600" height="200"></canvas>
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
                            backgroundColor: 'rgba(0, 255, 0, 0.1)',
                            borderColor: 'transparent',
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
