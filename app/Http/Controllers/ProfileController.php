<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    
    public function show()
    {
        $id = Auth::user()->id;
        $user = DB::table('users')->find($id);
        $judul = "Profil";
        return view('owner.profile.show', compact('user', 'judul'));
    }

    public function edit($id)
    {
        // $user = DB::table('users')->find($id);
        $user = User::where('id',$id)->get();
        $judul = "Ubah Profil";
        return view('owner.profile.edit', compact('user', 'judul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::where('id','=', $id)->first();
        $user->update($request->all());
        toastr()->success('Data '.$user->username.' berhasil diupdate');
        return redirect('/profile');
    }

    public function password(){
        $judul = "Ubah Password";
        return view('owner.profile.pass', compact('judul'));
    }

    public function changePass(Request $request){
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        if(Auth::guard('admin')->check()){
            $user = Auth::guard('admin')->user();
        }else{
            $user = Auth::guard('web')->user();
        }

        if(Hash::check($request->oldpass, $user->password)){
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            toastr()->success('Berhasil mengganti password');
            return redirect(route('home'));
        }
        toastr()->error('Password lama tidak sesuai/salah');
        return redirect()->back();
    }
}
