<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PendataanPasien;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Pemeriksaan;
use App\Models\RawatInap;
use Barryvdh\DomPDF\Facade\Pdf;


class PerawatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }


    public function pasiendata()
    {
        $user   = Auth::user();
        $pasien  = PendataanPasien::all(); // menarik semua (all) data dari models 
        return view('perawat.input_pasien', compact('user', 'pasien'));
    }


    public function submit_data(Request $req)
    {
        $validate = $req->validate([
            'nama' => 'required',
            'umur' => 'required',
            'NoKtp' => 'required',
            'jk' => 'required',
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
        $Pasien->umur = $req->get('umur');
        $Pasien->NoKtp = $req->get('NoKtp');
        $Pasien->jk = $req->get('jk');
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
            'alert-type' => ('success')
        );

        return redirect()->route('perawat.input')->with($notification);
    }

   
    public function getDataPasien($id){
        $pasien1 = PendataanPasien::find($id);

        return response()->json($pasien1);
    }
    
    public function update_data(Request $req)
    {
        $pasien = PendataanPasien::find($req->get('id'));

        $validate = $req->validate([
            'nama' => 'required',
            'umur' => 'required',
            'NoKtp' => 'required',
            'jk' => 'required',
            'goldar' => 'required',
            'pekerjaan' => 'required',
            'NoTlp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'TBadan' => 'required',
            'BBadan' => 'required',
        ]);

        $pasien->nama = $req->get('nama');
        $pasien->umur = $req->get('umur');
        $pasien->NoKtp = $req->get('NoKtp');
        $pasien->jk = $req->get('jk');
        $pasien->goldar = $req->get('goldar');
        $pasien->pekerjaan = $req->get('pekerjaan');
        $pasien->NoKtp = $req->get('NoKtp');
        $pasien->email = $req->get('email');
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



    public function delete_pasien($id)
    {
        $pasien = PendataanPasien::find($id);


        $pasien->delete();

        $success = true;
        $message = "Data pasien berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }


    public function dokter_data(){
        $user   = Auth::user();
        $dokter  = User::where('roles_id', 3)->get();
        return view('perawat.data_dokter', compact('user', 'dokter'));
    }
    public function sortir_pasien($id){
        $user   = Auth::user();

        $sortir = User::find($id)->sortir_pasien;
        return view('perawat.data_pasien_sortir', compact('user', 'sortir'));
    }


    public function exportpdf(){
        $pasien = PendataanPasien::all();

        view()->share('pasien', $pasien);
        $pdf = PDF::loadview('perawat/print-pdf');
        return $pdf->download('Data Pasien.pdf');
    }

    
    public function recycle_bin()
    {
        $user   = Auth::user();

        $pasien = PendataanPasien::onlyTrashed()->get(); // menarik semua (all) data dari models 
        return view('perawat.trash', compact('user','pasien'));
    }

    public function restore($id = null)
    {
        if($id != null){
        $pasien = PendataanPasien::onlyTrashed()
        ->where('id', $id)   
        ->restore();
        } else {
            $pasien = PendataanPasien::onlyTrashed()->restore();
        }
        return redirect()->route('recycle.bin');
    }

    public function delete($id = null)
    {
        if($id != null){
            $pasien = PendataanPasien::onlyTrashed()
            ->where('id', $id)   
            ->forceDelete();
            } else {
                $pasien = PendataanPasien::onlyTrashed()->forceDelete();
            }
            return redirect()->route('recycle.bin');
            
        $pasien  = PendataanPasien::onlyTrashed()->get(); // menarik semua (all) data dari models 
        return view('perawat.trash', compact('user', 'pasien'));
    }

    //pemeriksaan
    public function pemeriksaan_data(){
        $user   = Auth::user();
        $periksa  = Pemeriksaan::all();
        return view('perawat.data_pemeriksaan', compact('user', 'periksa'));
    }
    

    public function delete_pemeriksaan($id)
    {
        $periksa = Pemeriksaan::find($id);


        $periksa->delete();

        $success = true;
        $message = "Data pasien berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function recycle_bin_pemeriksaan()
    {
        $user   = Auth::user();

        $periksa = Pemeriksaan::onlyTrashed()->get(); // menarik semua (all) data dari models 
        return view('perawat.sampah', compact('user','periksa'));
    }

    public function restore_pemeriksaan($id = null)
    {
        if($id != null){
            $periksa = Pemeriksaan::onlyTrashed()
        ->where('id', $id)   
        ->restore();
        } else {
            $periksa = Pemeriksaan::onlyTrashed()->restore();
        }
        return redirect()->route('recycle.bin');
    }

    public function delete_periksa($id = null)
    {
        if($id != null){
            $periksa = Pemeriksaan::onlyTrashed()
            ->where('id', $id)   
            ->forceDelete();
            } else {
                $periksa = Pemeriksaan::onlyTrashed()->forceDelete();
            }
            return redirect()->route('bin.recycle');
            
            $periksa = Pemeriksaan::onlyTrashed()->get(); // menarik semua (all) data dari models 
        return view('perawat.sampah', compact('user', 'periksa'));
    }

    public function exportpdf1(){
        $periksa = Pemeriksaan::all();

        view()->share('periksa', $periksa);
        $pdf1 = PDF::loadview('perawat/print-pemeriksaan');
        return $pdf1->download('Data pemeriksaan.pdf');
    }

    //Rawat Inap

    public function perawatan_data(){
        $user   = Auth::user();
        $perawatan  = Pemeriksaan::where('status_dirawat', 1)->get();
        return view('perawat.data_rawat_inap', compact('user', 'perawatan'));
    }

    public function data_input_RawatInap(){
        $user   = Auth::user();
        $rawat_inap  = RawatInap::all();
        return view('perawat.data_input_RawatInap', compact('user', 'rawat_inap'));
    }

    public function getDataRawatInap($id){
        $perawatan1 = Pemeriksaan::find($id);

        return response()->json($perawatan1);
    }
    public function input_rawat_inap(Request $req)
    {
        $validate = $req->validate([
            'nama_pasien' => 'required',
            'kelas' => 'required',
            'nama_ruangan' => 'required',
            'pemeriksaan_id' => 'required',
        ]);

        $RawatInap = new RawatInap();
        $RawatInap->nama_pasien = $req->get('nama_pasien');
        $RawatInap->kelas = $req->get('kelas');
        $RawatInap->nama_ruangan = $req->get('nama_ruangan');
        $RawatInap->pemeriksaan_id = $req->get('pemeriksaan_id');


        $RawatInap->save();

        $notification = array(
            'message' => 'Data RawatInap berhasil di tambahkan',
            'alert-type' => ('success')
        );

        return redirect()->route('perawatan.home')->with($notification);
    }
    public function delete_rawatInap($id)
    {
        $rawat_inap  = RawatInap::find($id);


        $rawat_inap->delete();

        $success = true;
        $message = "Data pasien berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function recycle_bin_rawatinap()
    {
        $user   = Auth::user();

        $rawat_inap  = RawatInap::onlyTrashed()->get(); // menarik semua (all) data dari models 
        return view('perawat.trash1', compact('user','rawat_inap'));
    }
    public function restore_rawatinap($id = null)
    {
        if($id != null){
            $rawat_inap  = RawatInap::onlyTrashed()
        ->where('id', $id)   
        ->restore();
        } else {
            $rawat_inap  = RawatInap::onlyTrashed()->restore();
        }
        return redirect()->route('rawatinap.recycle');
    }
    public function delete_rawatinapPermanen($id = null)
    {
        if($id != null){
            $rawat_inap  = RawatInap::onlyTrashed()
            ->where('id', $id)   
            ->forceDelete();
            } else {
                $rawat_inap  = RawatInap::onlyTrashed()->forceDelete();
            }
            return redirect()->route('rawatinap.recycle');
            
            $rawat_inap  = RawatInap::onlyTrashed()->get(); // menarik semua (all) data dari models 
        return view('perawat.trash1', compact('user', 'rawat_inap'));
    }
    public function exportpdf2(){
        $rawat_inap  = RawatInap::all();

        view()->share('rawat_inap', $rawat_inap);
        $pdf2 = PDF::loadview('perawat/print-rawatinap');
        return $pdf2->download('Data rawat inap.pdf');
    }
}
