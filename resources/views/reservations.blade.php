<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="font-semibold text-3xl uppercase underline underline-offset-8 decoration-2 text-center">
                        Ultimes 15 Reserves</p>
                    <br>
                    @if ($reservations_old->count() != 0)
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Maquina
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dia
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Hora
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dia i hora de creació
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations_old as $reservation)
                                        <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-900">
                                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                                {{ $reservation->machine->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ substr($reservation->date, 0, 10) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $reservation->hour }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $reservation->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex justify-center">
                            <p class="bg-gray-100 border-2 p-2 rounded-md">Encara no has fet cap reserva</p>
                        </div>
                    @endif
                    <br>
                    <br>
                    <p class="font-semibold text-3xl uppercase underline underline-offset-8 decoration-2 text-center">
                        Reserves Actives</p>
                    <br>
                    @if ($reservations_new->count() != 0)
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Maquina
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dia
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Hora
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations_new as $reservation)
                                        <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-900">
                                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                                {{ $reservation->machine->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ substr($reservation->date, 0, 10) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $reservation->hour }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form action="{{ route('reservation.destroy', $reservation) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit"
                                                        class="font-medium text-blue-500 hover:underline"
                                                        value="Elimina">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex justify-center">
                            <p class="bg-gray-100 border-2 p-2 rounded-md">No hi han reserves actives</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
