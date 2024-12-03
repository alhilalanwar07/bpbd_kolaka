<?php

namespace App\Http\Controllers;

use App\Models\Posko;
use App\Models\Barang;
use App\Models\Bencana;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logistik = Barang::count();
        $posko = Posko::count();
        $bencana = Posko::groupBy('bencana_id')->count();

        return view('home', compact('logistik', 'posko', 'bencana'));
    }
}
