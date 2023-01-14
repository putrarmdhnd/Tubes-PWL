<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegisteredUserNotification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PDF;

class AdminController extends Controller
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

    public function input()
    {
        $user = Auth::user();
        $users = User::all();
        return view('admin.input_user', compact('user', 'users'));
    }

    public function submit_data(Request $req)
    {
        $validate = $req->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'jabatan' => 'required',
            'password' => 'required',
            'jk' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'roles_id' => 'required'
        ]);

        $password = $req->get('password');
        $hash_pass = Hash::make($password);
        
        $users = new User; 
        $users->nama = $req->get('nama');
        $users->email = $req->get('email');
        $users->no_hp = $req->get('no_hp');
        $users->jabatan = $req->get('jabatan');
        $users->password = $hash_pass;
        $users->jk = $req->get('jk');
        $users->umur = $req->get('umur');
        $users->alamat = $req->get('alamat');
        $users->roles_id = $req->get('roles_id');

        $users->save();

        $notification = array(
            'message' => 'Data buku berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.input')->with($notification);
    }

    public function getDataUser($id){
        $users = User::find($id);

        return response()->json($users);
    }

    public function update_book(Request $req){
        $users = User::find($req->get('id'));

        $validate = $req->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'jabatan' => 'required',
            'password' => 'required',
            'jk' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'roles_id' => 'required'
        ]);

        $users->nama = $req->get('nama');
        $users->email = $req->get('email');
        $users->no_hp = $req->get('no_hp');
        $users->jabatan = $req->get('jabatan');
        $users->password = $req->get('password');
        $users->jk = $req->get('jk');
        $users->umur = $req->get('umur');
        $users->alamat = $req->get('alamat');
        $users->roles_id = $req->get('roles_id');


        $users->save();

        $notification = array(
            'message' => 'Data buku berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.input')->with($notification);
    }

    public function delete_user($id){
        $users = User::find($id);

        $users->delete();

        $success = true;
        $message = "Data buku berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function exportPDF(){
        $users = User::all();

        view()->share('users', $users);
        $pdf = PDF::loadview('Admin/datauser-pdf');
        return $pdf->download('data.pdf');
    }

    // public function recycle_bin()
    // {
    //     $user   = Auth::user();

    //     $users = User::onlyTrashed()->get(); // menarik semua (all) data dari models 
    //     return view('admin.trash', compact('user','users'));
    // }

    // public function restore($id = null)
    // {
    //     if($id != null){
    //     $users = User::onlyTrashed()
    //     ->where('id', $id)   
    //     ->restore();
    //     } else {
    //         $users = User::onlyTrashed()->restore();
    //     }
    //     return redirect()->route('recycle.bin');
    // }

    // public function delete($id = null)
    // {
    //     if($id != null){
    //         $users = User::onlyTrashed()
    //         ->where('id', $id)   
    //         ->forceDelete();
    //         } else {
    //             $users = Users::onlyTrashed()->forceDelete();
    //         }
    //         return redirect()->route('recycle.bin');
            
    //     $users  = User::onlyTrashed()->get(); // menarik semua (all) data dari models 
    //     return view('admin.trash', compact('user', 'users'));
    // }
}
