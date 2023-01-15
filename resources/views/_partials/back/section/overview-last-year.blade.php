{{-- Last year overview --}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Evolution des trajets et des réservations</h3>
    </div>
    <div class="card-body">
        <div class="chart-wrapper">
            <canvas id="sales-status" class="chart-dropshadow h-280"></canvas>
        </div>
    </div>
</div>


@once
    @push('footer')
        <script id="chart-data-script">

            (function($){
                $(function(e){
                'use strict'


                /* chartjs (#sales-status) */

                const labels = [];
                @foreach (DashboardManager::getDates(true) as $date)
                labels.push("{{ $date->month . ' ' . $date->y }}");
                @endforeach

                var ctx = $('#sales-status');
                    ctx.height(310);
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            type: 'line',
                            datasets: [{
                                label: "Trajets",
                                data: {{ json_encode(DashboardManager::trajets(true)) }},
                                backgroundColor: 'transparent',
                                borderColor: '#ec296b ',
                                borderWidth: 3,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: '#ec296b',
                            }, {
                                label: "Reservations",
                                data: {{ json_encode(DashboardManager::reservations(true)) }},
                                backgroundColor: 'transparent',
                                borderColor: '#4801ff',
                                borderWidth: 3,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: '#4801ff',
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: 'index',
                                titleFontSize: 12,
                                titleFontColor: '#000',
                                bodyFontColor: '#000',
                                backgroundColor: '#fff',
                                cornerRadius: 3,
                                intersect: false,
                            },
                            legend: {
                                display: true,
                                labels: {
                                    usePointStyle: false,
                                },
                            },
                            scales: {
                                xAxes: [{
                                    ticks: {
                                    },
                                    display: true,
                                    gridLines: {
                                        display: true,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: false,
                                        labelString: 'Mois',
                                        fontColor: 'transparent'
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        fontColor: "",
                                    },
                                    display: true,
                                    gridLines: {
                                        display: true,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: false,
                                        labelString: 'Nombre',
                                        fontColor: 'transparent'
                                    }
                                }]
                            },
                            title: {
                                display: false,
                                text: 'Normal Legend'
                            }
                        }
                    });
                    /* chartjs (#sales-status) closed */

                });
            }(window.jQuery));

        </script>
    @endpush
@endonce
