<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendataanPasien;
use App\Models\Pemeriksaan;


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
    public function tambah_data(Request $req){
        
        $validate = $req->validate([
            'keluhan' => 'required',
            'keterangan_penyakit' => 'required',
            'resep_obat' => 'required',
            'status_dirawat' => 'required',
            'pasien_id' => 'required',
        ]);

        $pemeriksaan = new Pemeriksaan;
        $pemeriksaan->keluhan = $req->get('keluhan');
        $pemeriksaan->keterangan_penyakit = $req->get('keterangan_penyakit');
        $pemeriksaan->resep_obat = $req->get('resep_obat');
        $pemeriksaan->status_dirawat = $req->get('status_dirawat');
        $pemeriksaan->pasien_id = $req->get('pasien_id');


        $pemeriksaan->save();

        $notification = array(
            'message' => 'Data berhasil di tambahkan',
            'alert-type' =>('success')
        );

        return redirect()->route('dokter.pemeriksaan')->with($notification);

    }
}
