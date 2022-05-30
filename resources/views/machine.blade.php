<x-app-layout>
    <script>
        function handler(e) {
            const data = {
                maquina: '{{ $machine->id }}',
                date: e.target.value,
                array_h: @json(\App\Models\Reservation::$hours)
            };
            fetch("{{ route('reservation.show_reserved_hours', $machine) }}", {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    method: 'POST',
                    credentials: 'same-origin',
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(response => {
                    for (let i = 0; i < data.array_h.length; i++) {
                        const boto = document.getElementById("answer_".concat(data.array_h[i]));
                        if (boto.hasAttribute('disabled') == true) {
                            const label_boto = document.getElementById("label_".concat(data.array_h[i]));
                            boto.removeAttribute('disabled');
                            label_boto.classList.remove("bg-red-50");
                            label_boto.classList.remove("hover:bg-red-100");
                            label_boto.classList.add("hover:bg-blue-50");
                            label_boto.classList.add("bg-white");
                        }
                    }
                    if (response != []) {
                        for (let i = 0; i < response.length; i++) {
                            const radio = document.getElementById("answer_".concat(response[i]));
                            radio.setAttribute('disabled', '');
                            const label_r = document.getElementById("label_".concat(response[i]));
                            label_r.classList.remove("hover:bg-blue-50");
                            label_r.classList.remove("bg-white");
                            label_r.classList.add("hover:bg-red-100");
                            label_r.classList.add("bg-red-50");
                        }
                    }
                    var ele = document.getElementsByName("answer");
                    for (var i = 0; i < ele.length; i++) {
                        ele[i].checked = false;
                    }
                    const d = new Date();
                    if (data.date == d.toLocaleDateString('en-CA')) {
                        for (let i = 0; i < data.array_h.length; i++) {
                            if (d.getHours() >= data.array_h[i].substring(3)) {
                                const boto = document.getElementById("answer_".concat(data.array_h[i]));
                                if (boto.hasAttribute('disabled') == false) {
                                    boto.setAttribute('disabled');
                                    const label_boto = document.getElementById("label_".concat(data.array_h[i]));
                                    label_boto.classList.remove("bg-red-50");
                                    label_boto.classList.remove("hover:bg-red-100");
                                    label_boto.classList.add("hover:bg-blue-50");
                                    label_boto.classList.add("bg-white");
                                }
                            }
                        }
                    }
                })
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session()->has('message'))
                        <div
                            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 text-center">
                            <span class="font-medium">{{ session('message') }}</span>
                        </div>
                    @endif

                    <p class="font-semibold text-3xl underline underline-offset-8 decoration-2 text-center">RESERVA</p>
                    <br>
                    <!-- <div>Errors: {{ $errors }}</div> -->
                    <p class="text-xl text-center">Màquina seleccionada: {{ $machine->name }}</p>
                    <div class="flex justify-center">
                        <form class="flex flex-col justify-center pt-8"
                            action="{{ route('reservation.show', $machine) }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <div class="flex justify-center">
                                <p class="font-semibold pr-4 pt-2">Dia</p>
                                <input required type="date" onchange="handler(event);" name="date"
                                    min={{ now()->toDateString('Y-m-d') }}>
                            </div>

                            @if ($errors->any())
                                @if ($errors->first('date') != '')
                                    <div class="flex justify-center">
                                        <div class="mt-4 text-center border rounded border-red-500 text-red-500 p-2">
                                            {{ $errors->first('date') }}
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <p class="font-semibold pt-8 text-center">Selecciona l'hora</p>
                            <ul
                                class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-5 m-4 max-w-mlg mx-auto">
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="08-09" name="answer"
                                        id="answer_08-09">
                                    <label id="label_08-09"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_08-09">08:00 - 09:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="09-10" name="answer"
                                        id="answer_09-10">
                                    <label id="label_09-10"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_09-10">09:00 - 10:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="10-11" name="answer"
                                        id="answer_10-11">
                                    <label id="label_10-11"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_10-11">10:00 - 11:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="11-12" name="answer"
                                        id="answer_11-12">
                                    <label id="label_11-12"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_11-12">11:00 - 12:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="15-16" name="answer"
                                        id="answer_15-16">
                                    <label id="label_15-16"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_15-16">15:00 - 16:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="16-17" name="answer"
                                        id="answer_16-17">
                                    <label id="label_16-17"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_16-17">16:00 - 17:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="17-18" name="answer"
                                        id="answer_17-18">
                                    <label id="label_17-18"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_17-18">17:00 - 18:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="18-19" name="answer"
                                        id="answer_18-19">
                                    <label id="label_18-19"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_18-19">18:00 - 19:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="19-20" name="answer"
                                        id="answer_19-20">
                                    <label id="label_19-20"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_19-20">19:00 - 20:00</label>
                                </li>
                                <li class="relative">
                                    <input required class="sr-only peer" type="radio" value="20-21" name="answer"
                                        id="answer_20-21">
                                    <label id="label_20-21"
                                        class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-100 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100"
                                        for="answer_20-21">20:00 - 21:00</label>
                                </li>
                            </ul>
                            <div class="flex justify-center">
                                <input type="submit" value="Reserva!"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            </div>

                            @if ($errors->any())
                                @if ($errors->first('answer') != '')
                                    <div class="flex justify-center">
                                        <div class="mt-4 text-center border rounded border-red-500 text-red-500 p-2">
                                            {{ $errors->first('answer') }}
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
