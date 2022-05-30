<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="font-semibold text-3xl underline underline-offset-8 decoration-2 text-center">MÀQUINES
                        DISPONIBLES</p>
                    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-6 pt-6 m-6">
                        @foreach ($machines as $machine)
                            <div class="bg-gray-100 rounded p-4 border-2">
                                <div class="text-center underline underline-offset-4 decoration-2">{{ $machine->name }}
                                </div>
                                <div class="text-justify pt-4">{{ $machine->description }}</div>
                                <div class="flex justify-center w-1/2 mx-auto pt-4">
                                    <a href={{ route('machine.show', $machine) }}>
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Selecciona
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
