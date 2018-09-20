<template>
    <div class="mdl-cell mdl-cell--12-col chart-container">
        <highcharts class="chart" :options="chartOptions"></highcharts>
    </div>
</template>

<script>
    import { Chart } from "highcharts-vue"
    import * as axios from "axios"

    export default {
        name: 'ResourceGraphComponent',
        props: ['token', 'steps', 'refreshRate'],
        components: {
            highcharts: Chart
        },
        created: function() {
            let currentTime = (new Date()).getTime();

            for (let i = 0; i < this.steps; i++) {
                this.chartOptions.series[0].data.push([currentTime - (this.steps - i) * this.refreshRate, 0]);
                this.chartOptions.series[1].data.push([currentTime - (this.steps - i) * this.refreshRate, 0]);
                this.chartOptions.series[2].data.push([currentTime - (this.steps - i) * this.refreshRate, 0]);
            }

            setInterval(this.updateGraph, this.refreshRate);
        },
        methods: {
            updateGraph() {
                let cpuSeries = this.chartOptions.series[0];
                let memSeries = this.chartOptions.series[1];
                let storageSeries = this.chartOptions.series[2];

                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + this.token
                    }
                };

                axios.get("/api/system-resources", config)
                    .then(response => {
                        let x = (new Date()).getTime();
                        // First shift all points to the left
                        cpuSeries.data.shift();
                        memSeries.data.shift();
                        storageSeries.data.shift();

                        cpuSeries.data.push([x, response.data.cpu]);
                        memSeries.data.push([x, response.data.memory]);
                        storageSeries.data.push([x, response.data.storage]);
                    });
            }
        },
        data() {
            return {
                chartOptions: {
                    chart: {
                        height: 200,
                        animation: false,
                        type: 'spline',
                        backgroundColor: '#FAFAFA'
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        type: 'datetime',
                        labels: {
                            enabled: false
                        }
                    },
                    yAxis: {
                        title: {
                            text: '%'
                        }
                    },
                    plotOptions: {
                        series: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    series: [{
                        name: "CPU",
                        data: [],
                        pointInterval: this.refreshRate

                    }, {
                        name: "Memory",
                        data: [],
                        pointInterval: this.refreshRate
                    }, {
                        name: "Storage",
                        data: [],
                        pointInterval: this.refreshRate
                    }]
                }
            }
        }
    }
</script>

<style scoped>
</style>
