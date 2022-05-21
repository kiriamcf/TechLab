<x-app-layout>
    <script>
        function handler(e) {
            const data = { maquina: '{{ $machine->id }}', date: e.target.value, array_h: ['15-16','16-17','17-18','18-19','19-20','20-21'] };
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
                    console.log(document.getElementById("answer_".concat(data.array_h[i])));
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
                        console.log(data.array_h);
                    }
                }
                var ele = document.getElementsByName("answer");
                for (var i = 0; i < ele.length; i++) {
                    ele[i].checked = false;
                }
            })
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="font-semibold text-3xl underline underline-offset-8 decoration-2 text-center">RESERVA</p>
                    <br>
                    <p class="text-xl text-center">Màquina seleccionada: {{ $machine->name }}</p>
                    <div class="flex justify-center">
                        <form class ="flex flex-col justify-center pt-8" action="{{ route('reservation.show', $machine) }}" enctype="multipart/form-data" method="POST">  
                            @csrf
                            <div class="flex justify-center">
                                <p class="font-semibold pr-8 pt-2">Dia</p>
                                <input type="date" onchange="handler(event);" name="date" min={{ now()->toDateString('Y-m-d') }}>
                            </div>
                            <p class="font-semibold pt-8 text-center">Selecciona l'hora</p>
                            <ul class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-5 m-10 max-w-mlg mx-auto">
                                <li class="relative">
                                    <input class="sr-only peer" type="radio" value="15-16" name="answer" id="answer_15-16">
                                    <label id="label_15-16" class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100" for="answer_15-16">15:00 - 16:00</label>
                                <li class="relative">
                                    <input class="sr-only peer" type="radio" value="16-17" name="answer" id="answer_16-17">
                                    <label id="label_16-17" class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100" for="answer_16-17">16:00 - 17:00</label>
                                </li>
                                <li class="relative">
                                    <input class="sr-only peer" type="radio" value="17-18" name="answer" id="answer_17-18">
                                    <label id="label_17-18" class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100" for="answer_17-18">17:00 - 18:00</label>
                                </li>
                                <li class="relative">
                                    <input class="sr-only peer" type="radio" value="18-19" name="answer" id="answer_18-19">
                                    <label id="label_18-19" class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100" for="answer_18-19">18:00 - 19:00</label>
                                </li>
                                <li class="relative">
                                    <input class="sr-only peer" type="radio" value="19-20" name="answer" id="answer_19-20">
                                    <label id="label_19-20" class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-50 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100" for="answer_19-20">19:00 - 20:00</label>
                                </li>
                                <li class="relative">
                                    <input class="sr-only peer" type="radio" value="20-21" name="answer" id="answer_20-21">
                                    <label id="label_20-21" class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-blue-100 peer-checked:ring-blue-500 peer-checked:ring-2 peer-checked:border-transparent peer-checked:bg-blue-100" for="answer_20-21">20:00 - 21:00</label>
                                </li>
                            </ul>
                            <div class="flex justify-center">
                                <input type="submit" value="Reserva!" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>