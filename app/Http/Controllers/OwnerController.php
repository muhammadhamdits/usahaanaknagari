<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Mail;

class OwnerController extends Controller
{
    public function index()
    {
        $users = User::all();
        $judul = "Kelola Data Pemilik";
        return view('admin.kelolaowner.index', compact('users', 'judul'));
    }
    public function create()
    {
        $judul = "Tambah Data Pemilik";
        return view('admin.kelolaowner.create', compact('judul'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'unique:users|email|nullable',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'hp' => $request->hp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 1,
            'alamat' => $request->alamat,
        ]);
        toastr()->success('Data '.$user->username.' berhasil ditambahkan');
        return redirect()->route('pemilik.index');
    }
    public function show($id)
    {
        $users = User::find($id);
        $judul = "Detail Data Pemilik";
        return view('admin.kelolaowner.show', compact('users', 'judul'));
    }
    public function edit($id)
    {
        $user = User::where('id',$id)->get();
        $judul = "Edit Data Pemilik";
        return view('admin.kelolaowner.edit', compact('user', 'judul'));
    }
    public function update(Request $request, $id)
    {   
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required'
        ]);
        
        $user = User::where('id','=', $id)->first();
        $user->update($request->all());
        toastr()->success('Data '.$user->username.' berhasil diupdate');
        return redirect()->route('pemilik.show', [$user->id]);
    }
    public function destroy($id)
    {
        $user = User::where('id','=',$id)->first();
        toastr()->success('Data '.$user->username.' berhasil dihapus');
        $user->delete();
        return redirect()->route('pemilik.index');
    }
    
    public function confirm(Request $request){
        $user =  User::findOrFail($request->id);
        $user->update(['status' => $request->status]);

        $to_name = $user->nama;
        $to_email = $user->email;
        if($request->status == 1){
            $data = array(
                "name" => $to_name,
                "body" => "Selamat, akun anda telah aktif. Sekarang anda dapat login ke dalam aplikasi."
            );
        }else{
            $data = array(
                "name" => $to_name,
                "body" => "Maaf, akun anda tidak dapat diaktivasi. Mohon periksa kembali kelengkapan data anda."
            );
        }
        Mail::send("admin.mail", $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject("Registrasi Akun : Usaha Anak Nagari");
            $message->from("usahaanaknagari@gmail.com", "Usaha Anak Nagari");
        });

        toastr()->success("Berhasil mengkonfirmasi usulan pemilik dengan nama $user->nama");
        return redirect(route('pemilik.index'));
    }
}
