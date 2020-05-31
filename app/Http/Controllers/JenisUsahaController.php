<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisUsaha;

class JenisUsahaController extends Controller
{
       public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $jenisusahas = JenisUsaha::all();
         return view('admin/jenisusaha/index', ['jenisusahas' => $jenisusahas]);
    }


    public function create()

    {

        //

    }



    public function store(Request $request)

    {

        $jenisusahas = JenisUsaha::create([
            'nama' => $request->nama,
        ]);
        $jenisusahas->save();
        return redirect(route('jenisusaha.index'));

    }



    public function show(JenisUsaha $jenisusaha)

    {

        //

    }



    public function edit(JenisUsaha $jenisusaha)

    {

        //

    }



    public function update(Request $request, $id)

    {

        $jenisusaha = JenisUsaha::findOrFail($request->id_edit);

        $jenisusaha->nama = $request->nama;

        $jenisusaha->update();

        

        return redirect(route('jenisusaha.index'));

    }

     public function destroy($id)
    {
        $jenisusaha = JenisUsaha::findOrFail($id);
        $jenisusaha->delete();
        return redirect()->route('jenisusaha.index');
    }
}
