<div>
    <div class="p-5 card-theme">
        <p class="mb-4 text-lg font-semibold text-center">
            Porcentaje de solicitudes
        </p>

        @if (count($label) && count($data))
            <div class="w-[70%] mx-auto">
                <canvas id="myChart"></canvas>
            </div>
        @else
            <div class="h-[251px] mx-auto center-content">
                <x-utils.not-search message="Aún no hay datos" />
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($label) !!},
                datasets: [{
                    label: '%',
                    data: {!! json_encode($data) !!},

                    borderWidth: 3
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return ' Porcentaje' + ': ' + {!! json_encode($data) !!}[tooltipItem.dataIndex] + '%';
                            }
                        }
                    },
                }
            }
        });
    </script>
</div>
