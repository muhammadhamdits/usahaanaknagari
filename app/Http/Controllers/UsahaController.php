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
        $judul = "Kelola Data Usaha";
        return view('admin.usaha.index', compact('usahas', 'judul'));
    }

    public function create()
    {
        $jenisUsahas = DB::table('jenis_usaha')->get()->keyBy('id')->pluck('nama');
        $judul = "Tambah Data Usaha";
        return view('admin.usaha.create', compact('jenisUsahas', 'judul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_usaha_id' => 'required',
            'barang_jasa' => 'required',
            'foto' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $foto = $request->file('foto');
        $nama_file = time() . "-usaha." . $foto->getClientOriginalExtension();

        $upload_path = 'img/usaha/';
        $saveName = $upload_path . $nama_file;
        $success = $foto->move($upload_path, $nama_file);

        $usaha = Usaha::create([
            'jenis_usaha_id' => $request->jenis_usaha_id,
            'nama' => $request->nama,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'alamat' => $request->alamat,
            'foto' => $saveName,
            'geom' => DB::raw("ST_GeomFromText('POINT($request->longitude $request->latitude)')"),
            'barang_jasa' => $request->barang_jasa,
            'ket' => $request->ket,
            'status' => 1,
            'pemilik' => $request->pemilik,
        ]);

        toastr()->success("Berhasil menambahkan data usaha $usaha->nama");
        return redirect(route('usaha.index'));
    }

    public function show($id)
    {
        $usaha = Usaha::findOrFail($id);
        $judul = "Detail Data Usaha";
        $latlng = explode(" ", substr(Usaha::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $id)->first()->latlng, 6, -1));
        return view('admin.usaha.show', compact('usaha', 'latlng', 'judul'));
    }
    
    public function edit($id)
    {
        $usaha = Usaha::findOrFail($id);
        $judul = "Edit Data Usaha";
        $latlng = explode(" ", substr(Usaha::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $id)->first()->latlng, 6, -1));
        $jenisUsahas = DB::table('jenis_usaha')->get()->keyBy('id')->pluck('nama');
        return view('admin.usaha.edit', compact('usaha', 'latlng', 'jenisUsahas', 'judul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_usaha_id' => 'required',
            'barang_jasa' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $usaha = Usaha::findOrFail($id);
        $foto = $request->file('foto');

        if($foto){
            $nama_file = time() . "-usaha." . $foto->getClientOriginalExtension();
            $upload_path = 'img/usaha/';
            $saveName = $upload_path . $nama_file;
            $success = $foto->move($upload_path, $nama_file);
        }else{
            $saveName = $usaha->foto;
        }

        $usaha->update([
            'jenis_usaha_id' => $request->jenis_usaha_id,
            'nama' => $request->nama,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'alamat' => $request->alamat,
            'foto' => $saveName,
            'geom' => DB::raw("ST_GeomFromText('POINT($request->longitude $request->latitude)')"),
            'barang_jasa' => $request->barang_jasa,
            'ket' => $request->ket,
            'status' => 1,
            'pemilik' => $request->pemilik,
        ]);

        toastr()->success("Berhasil memperbaharui data usaha $usaha->nama");
        return redirect(route('usaha.index'));
    }

    public function destroy($id)
    {
        $usaha = Usaha::findOrFail($id);
        toastr()->success("Usaha $usaha->nama berhasil dihapus");
        $usaha->delete();
        return redirect(route('usaha.index'));
    }

    public function confirm(Request $request){
        $usaha =  Usaha::findOrFail($request->id);
        $usaha->update(['status' => $request->status]);

        toastr()->success("Berhasil mengkonfirmasi usulan usaha $usaha->nama");
        return redirect(route('usaha.index'));
    }
}
