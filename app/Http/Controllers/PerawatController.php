<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PendataanPasien;

class PerawatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function pasiendata(){
        $user   = Auth::user();
        $pasien  = PendataanPasien::all(); // menarik semua (all) data dari models 
        return view('perawat.input_pasien', compact('user','pasien'));
    }

    
    public function submit_data(Request $req){
        $validate = $req->validate([
            'nama' => 'required',
            'Tlahir' => 'required',
            'umur' => 'required',
            'NoKtp' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'goldar' => 'required',
            'pekerjaan' => 'required',
            'NoTlp' => 'required',
            'email' => 'email',
            'alamat' => 'required',
            'TBadan' => 'required',
            'BBadan' => 'required',
        ]);

        $Pasien = new PendataanPasien;
        $Pasien->nama = $req->get('nama');
        $Pasien->Tlahir = $req->get('Tlahir');
        $Pasien->umur = $req->get('umur');
        $Pasien->NoKtp = $req->get('NoKtp');
        $Pasien->jk = $req->get('jk');
        $Pasien->agama = $req->get('agama');
        $Pasien->goldar = $req->get('goldar');
        $Pasien->pekerjaan = $req->get('pekerjaan');
        $Pasien->NoTlp = $req->get('NoTlp');
        $Pasien->email = $req->get('email');
        $Pasien->alamat = $req->get('alamat');
        $Pasien->TBadan = $req->get('TBadan');
        $Pasien->BBadan = $req->get('BBadan');


        $Pasien->save();

        $notification = array(
            'message' => 'Data buku berhasil di tambahkan',
            'alert-type' =>('success')
        );

        return redirect()->route('perawat.input')->with($notification);

    }
    
    public function getDataPasien($id){
        $pasien1 = PendataanPasien::find($id);

        return response()->json($pasien1);
    }

    public function update_data(Request $req){
        $pasien = PendataanPasien::find($req->get('id'));

        $validate = $req->validate([
            'nama' => 'required',
            'Tlahir' => 'required',
            'umur' => 'required',
            'NoKtp' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'goldar' => 'required',
            'pekerjaan' => 'required',
            'NoTlp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'TBadan' => 'required',
            'BBadan' => 'required',
        ]);

        $Pasien = new PendataanPasien;
        $pasien->nama = $req->get('nama');
        $pasien->Tlahir = $req->get('Tlahir');
        $pasien->umur = $req->get('umur');
        $pasien->NoKtp = $req->get('NoKtp');
        $pasien->jk = $req->get('jk');
        $pasien->agama = $req->get('agama');
        $pasien->goldar = $req->get('goldar');
        $pasien->pekerjaan = $req->get('pekerjaan');
        $pasien->NoKtp = $req->get('NoKtp');
        $pasien->eamail = $req->get('email');
        $pasien->alamat = $req->get('alamat');
        $pasien->TBadan = $req->get('TBadan');
        $pasien->BBadan = $req->get('BBadan');

        $pasien->save();

        $notification = array(
            'message' => 'Data buku berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('perawat.input')->with($notification);
    }
    

    
    public function delete_pasien($id){
        $pasien = PendataanPasien::find($id);


        $pasien->delete();

        $success = true;
        $message = "Data buku berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

}
