<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendataanPasien;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('home', compact('user'));
    }
    public function Pemeriksaan(){
        $user = Auth::user();
        $pasien = PendataanPasien::all();
        return view('dokter.input_pemeriksaan', compact('user','pasien'));
    }
    public function getDataPasien($id){
        $pasien1 = PendataanPasien::find($id);

        return response()->json($pasien1);
    }
}
