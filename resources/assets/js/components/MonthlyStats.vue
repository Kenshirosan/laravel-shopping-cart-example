<template>
    <canvas width="600" height="200"></canvas>
</template>

<script>
    import Chart from 'chart.js'

    export default {
        props: ['labels', 'values', 'taxes'],

        mounted() {
            let data = {
                labels: this.labels,

                datasets: [
                    {
                        label: 'Monthly Taxes',
                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                        borderColor: 'rgba(255, 100, 100)',
                        data: this.taxes
                    },
                    {
                        label: 'Monthly Sales',
                        backgroundColor: 'rgba(0, 199, 0, 0.5)',
                        borderColor: 'rgba(0, 0, 132)',
                        data: this.values
                    },
                ]
            };
            let context = this.$el.getContext('2d');
            const chart = new Chart(context,{
                type: 'line',
                data: data
            });
        },
    }
</script>