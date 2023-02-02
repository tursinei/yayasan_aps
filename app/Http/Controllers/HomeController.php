<?php

namespace App\Http\Controllers;

use App\Models\AnakAsuh;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function jumlah(Request $request)
    {
        $isAlumni = $request->get('alumni');
        $return = AnakAsuh::when($isAlumni, function ($query) {
            return $query->where('is_alumni', true);
        })->count();
        return response()->json(['count' => $return]);
    }
}
