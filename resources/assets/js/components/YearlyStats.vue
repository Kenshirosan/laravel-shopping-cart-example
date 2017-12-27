<template>
    <canvas width="600" height="200"></canvas>
</template>

<script>
    import Chart from 'chart.js'

    export default {
        props: ['labels', 'values', 'taxes', 'profit'],

        mounted() {
            var data = {
                labels: this.labels,

                datasets: [
                    {
                        label: 'Yearly Sales',
                        backgroundColor: 'rgba(0, 0, 255, 0.5)',
                        borderColor: 'rgba(0, 0, 132)',
                        data: this.values,
                    },
                    {
                        label: 'Yearly Taxes',
                        backgroundColor: 'rgba(255, 0, 0, .5)',
                        borderColor: 'rgba(0, 0, 132)',
                        data: this.taxes,
                    },
                    {
                        label: 'Raw Profit',
                        backgroundColor: 'rgba(0, 199, 0, 0.5)',
                        borderColor: 'rgba(0, 0, 132)',
                        data: this.profit,
                    },
                ]
            };
            let context = this.$el.getContext('2d');
            const chart = new Chart(context,{
                type: 'bar',
                data: data,
            });
        },
    }
</script>