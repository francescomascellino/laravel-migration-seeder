<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Train;

class PageController extends Controller
{
    public function home()
    {
        $trains = Train::all();
        $sorted_trains = $trains->sortBy('departure_time')->values()->all();

        // RETURNS THE VIEW 'home' (home.blade.php)
        // return view('home', ['trains' => Train::all()]);
        //compact() CREATES AN ARRAY FROM THE $sorted_trains COLLECTION
        return view('home', compact('sorted_trains'));
    }
}
