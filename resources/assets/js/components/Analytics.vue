<template>
    <canvas width="600" height="200"></canvas>
</template>
<!-- need to figure out how to parse the response I get and display it with Chartjs, so that I can get rid of google graphs crap-->
<script>
    import Chart from 'chart.js';

    export default {
        props: ['sessions', 'pageviews', 'labels'],

        mounted() {
            let data = {
                labels: this.labels,

                datasets: [
                    {
                        label: 'Sessions',
                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                        borderColor: 'rgba(255, 100, 100)',
                        data: this.sessions
                    },
                    {
                        label: 'Page Views',
                        backgroundColor: 'rgba(0, 199, 0, 0.5)',
                        borderColor: 'rgba(0, 0, 132)',
                        data: this.pageviews
                    },
                ]
            };
            let context = this.$el.getContext('2d');
            const chart = new Chart(context,{
                type: 'line',
                data: data
            });
        }
    }
</script>