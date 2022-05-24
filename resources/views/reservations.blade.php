<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="font-semibold text-3xl uppercase underline underline-offset-8 decoration-2 text-center">Totes les Reserves</p>
                    <br>
                    @foreach ($reservations_old as $reservation)
                        <div class="flex justify-center space-x-2">
                            <div>Maquina: {{ $reservation->machine_id }}</div>
                            <div>Dia: {{ substr($reservation->date, 0, 10) }}</div>
                            <div>Hora: {{ $reservation->hour }}</div>
                        </div>
                    @endforeach
                    <br>
                    <p class="font-semibold text-3xl uppercase underline underline-offset-8 decoration-2 text-center">Reserves Actives</p>
                    <br>
                    @forelse($reservations_new as $reservation)
                        <div class="flex justify-center space-x-2">
                            <div>Maquina: {{ $reservation->machine_id }}</div>
                            <div>Dia: {{ substr($reservation->date, 0, 10) }}</div>
                            <div>Hora: {{ $reservation->hour }}</div>
                        </div>
                    @empty
                        <div class="flex justify-center">No hi han reserves</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>