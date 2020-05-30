<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class OwnerController extends Controller
{
    public function index()
    {
        $no = 1;
        $users = User::all();
        return view('admin.kelolaowner.index', compact('users','no'));
    }
    public function create()
    {
        return view('admin.kelolaowner.create');
    }
    public function store(Request $request)
    {
        $user = User::create($request->all());
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
        $user = User::where('id','=', $id)->first();
        $user->update($request->all());
           
        return redirect()->route('owners.show', [$user->id]);
    }
    public function destroy($id)
    {
        $user = User::where('id','=',$id)->first();
        $user->delete();
        return redirect()->route('owners.index');
    }
}
