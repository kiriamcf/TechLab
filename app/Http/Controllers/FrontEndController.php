<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class FrontEndController extends Controller

{
    public function rfid(Request $request) {
        // { 'id': '1234 1234 1234 1234' }

        $id = $request->get('id');
        $now = now();
        $user = User::where('targeta', $id)->firstOrFail();
        $reservation = $user
            ->reservations()
            ->whereDate('date', $now->startOfDay())
            ->where('hour', strval($now->hour) . '-' . strval($now->hour + 1))
            ->firstOrFail();
            
        return [
            'temps_restant' => 60 - $now->minute,
        ];
    }
}