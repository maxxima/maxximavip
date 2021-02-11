<?php


namespace App\Http\Controllers;


class HealthController extends Controller
{
    public function health(){
        return response()->json([
            "tag"=>"1.0.0.3"
        ]);
    }
}
