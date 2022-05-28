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
        $reservations = $request->user()->reservations;
        // $operation = fn (Reservation $r) => $r->date >= now()->startOfDay() && intval($r->hour) >= now()->hour;
        $operation = function (Reservation $r) {
            if ($r->date > now()->startOfDay()) {
                return true;
            }
            if ($r->date == now()->startOfDay() && intval($r->hour) >= now()->hour) {
                return true;
            }
            return false;
        };

        return view('reservations', [
            'reservations_new' => $reservations->filter($operation),
            'reservations_old' => $reservations->reject($operation)->sortbyDesc('id')->take(15),
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
     * Return hours already reserved from a specific date.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show_statistic_values(Reservation $reservation)
    {
        $machines = array();
        $hours = array();
        $total_machines = [1,2,3,4,5,6];
        $total_hours = ['08-09','09-10','10-11','11-12','15-16','16-17','17-18','18-19','19-20','20-21'];
        foreach ($total_machines as $machine) {
            $count = $reservation->where('machine_id', $machine)->count();
            array_push($machines, $count);
        }
        foreach ($total_hours as $hour) {
            $count = $reservation->where('hour', $hour)->count();
            array_push($hours, $count);
        }
        return view('statistics', [
            'array_machines' => $machines,
            'array_hours' => $hours,
        ]);
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
