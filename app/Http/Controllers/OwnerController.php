<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index()
    {
        $users = User::where('status', 1)->get();
        return view('admin.kelolaowner.index', compact('users'));
    }
    public function create()
    {
        return view('admin.kelolaowner.create');
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
        return redirect()->route('owners.index');
    }
    public function show($id)
    {
        $users = User::find($id);
        return view('admin.kelolaowner.show', compact('users'));
    }
    public function edit($id)
    {
        $user = User::where('id',$id)->get();

        return view('admin.kelolaowner.edit', compact('user'));
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
        return redirect()->route('owners.show', [$user->id]);
    }
    public function destroy($id)
    {
        $user = User::where('id','=',$id)->first();
        toastr()->success('Data '.$user->username.' berhasil dihapus');
        $user->delete();
        return redirect()->route('owners.index');
    }
}
