@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = [
                'Maquina 3D',
                'Torn',
                'Fresadora',
                'Maquina de Cosir',
                'Talladora laser',
                'Trepant',
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Reserves',
                    backgroundColor: 'rgb(59, 130, 246)',
                    borderColor: 'rgb(59, 130, 246)',
                    data: @json($array_machines),
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Numero de reserves'
                            },
                            ticks: {
                                stepSize: 1,
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Maquines disponibles'
                            }
                        }
                    }
                }
            };

            const myChart = new Chart(
                document.getElementById('myChart_machines'),
                config
            );
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = [
                '8-9 AM',
                '9-10 AM',
                '10-11 AM',
                '11-12 AM',
                '3-4 PM',
                '4-5 PM',
                '5-6 PM',
                '6-7 PM',
                '7-8 PM',
                '8-9 PM',
            ];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Reserves',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: @json($array_hours),
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Numero de reserves'
                            },
                            ticks: {
                                stepSize: 1,
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Hores disponibles'
                            }
                        }
                    }
                }
            };

            const myChart = new Chart(
                document.getElementById('myChart_hours'),
                config
            );
        });
    </script>
@endpush


<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="font-semibold text-3xl uppercase underline underline-offset-8 decoration-2 text-center">
                        Estadistiques sobre màquines</p>
                    <br>
                    <div>
                        <canvas id="myChart_machines" class="h-64"></canvas>
                    </div>
                    <p
                        class="mt-10 font-semibold text-3xl uppercase underline underline-offset-8 decoration-2 text-center">
                        Estadistiques sobre hores</p>
                    <br>
                    <div>
                        <canvas id="myChart_hours" class="h-64"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
