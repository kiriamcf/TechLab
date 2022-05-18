<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller

{
    public function rfid(Request $request) {
        // { 'id': '1234 1234 1234 1234' }
        $id = $request->get('id');
        $id_prova = "D4 FB DA 33";
        if (strcmp($id,$id_prova) == 0) {
            //return response()->json($request->get('id'));
            return response()->json("AUTORITZAT");
        } else {
            return response()->json("NO AUTORITZAT");
        }
        //return $request->all();
    }
}