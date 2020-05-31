<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usaha;
use DB;

class UsahaController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
        $this->middleware('web');
    }

    public function index()
    {
        $usahas = Usaha::all();
        return view('admin.usaha.index', compact('usahas'));
    }

    public function create()
    {
        $jenisUsahas = DB::table('jenis_usaha')->get()->keyBy('id')->pluck('nama');
        return view('admin.usaha.create', compact('jenisUsahas'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
