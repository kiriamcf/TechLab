<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Reservation;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('reservations', [
            'reservations' => $request->user()->reservations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Machine $machine)
    {
        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'answer' => [
                'required',
                Rule::in(Reservation::$hours),
                Rule::unique(Reservation::class, 'hour')->where(function (Builder $query) use ($request) {
                    return $query->where('date', $request->date);
                })
            ]
        ]);

        Reservation::create([
            'user_id' => $request->user()->id,
            'machine_id' => $machine->id,
            'date' => $validated['date'],
            'hour' => $validated['answer'],
        ]);

        return redirect()
            ->route('machine.show', $machine)
            ->with('message', "S'ha fet la reserva");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservation', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * Return hours already reserved from a specific date.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show_reserved_hours(Request $request, Reservation $reservation)
    {
        $array_hours = array();
        foreach ($request->array_h as $hora) {
            if ($reservation->where('user_id',$request->user()->id)->where('machine_id',$request->maquina)->where('date',$request->date)->where('hour',$hora)->first() != null) {
                array_push($array_hours, $hora);
            }
        }
        return json_encode($array_hours);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
