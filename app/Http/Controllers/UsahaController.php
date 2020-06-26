<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usaha;
use App\UsulanUpdate;
use DB;

class UsahaController extends Controller
{
    public $data;

    public function __construct(){
        $this->middleware('admin')->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'confirm']);
        $this->middleware('web')->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'confirm']);
    }

    public function index()
    {
        $usahas = Usaha::all();
        $updates = UsulanUpdate::all();
        $judul = "Kelola Data Usaha";
        return view('admin.usaha.index', compact('usahas', 'judul', 'updates'));
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

    public function ubah($id){
        $usaha = Usaha::findOrFail($id);
        $judul = "Usulan Update Data Usaha";
        $latlng = explode(" ", substr(Usaha::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $id)->first()->latlng, 6, -1));
        $jenisUsahas = DB::table('jenis_usaha')->get()->keyBy('id')->pluck('nama');
        return view('admin.usaha.edit', compact('usaha', 'latlng', 'jenisUsahas', 'judul'));
    }

    public function perbarui(Request $request, $id){
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

        $usaha = UsulanUpdate::create([
            'usaha_id' => $id,
            'jenis_usaha_id' => $request->jenis_usaha_id,
            'nama' => $request->nama,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'alamat' => $request->alamat,
            'foto' => $saveName,
            'geom' => DB::raw("ST_GeomFromText('POINT($request->longitude $request->latitude)')"),
            'barang_jasa' => $request->barang_jasa,
            'ket' => $request->ket,
            'status' => 0,
            'pengusul' => $request->pengusul,
        ]);

        toastr()->success("Berhasil mengusulkan pengeditan usaha $usaha->nama");
        return redirect(route('home'));
    }

    public function detail($id){
        global $data;
        $usulan = UsulanUpdate::findOrFail($id);
        $usaha = Usaha::findOrFail($usulan->usaha_id);

        $usulan->geom = explode(" ", substr(UsulanUpdate::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $id)->first()->latlng, 6, -1));
        $usaha->geom = explode(" ", substr(Usaha::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $usulan->usaha_id)->first()->latlng, 6, -1));
        $data['pengusul'] = $usulan->pengusul;
        
        function checkUpdate($usulan, $usaha, $name){
            global $data;
            if($usaha->$name != $usulan->$name){
                $data["$name"][0] = $usulan->$name;
                $data["$name"][1] = 1;
            }else{
                $data["$name"][0] = $usaha->$name;
                $data["$name"][1] = 0;
            }
        }

        checkUpdate($usulan, $usaha, 'jenis_usaha_id');
        $data['jenis_usaha_id'][0] = $usulan->jenis->nama;
        checkUpdate($usulan, $usaha, 'nama');
        checkUpdate($usulan, $usaha, 'foto');
        checkUpdate($usulan, $usaha, 'jam_buka');
        checkUpdate($usulan, $usaha, 'jam_tutup');
        checkUpdate($usulan, $usaha, 'alamat');
        checkUpdate($usulan, $usaha, 'foto');
        checkUpdate($usulan, $usaha, 'geom');
        checkUpdate($usulan, $usaha, 'barang_jasa');
        checkUpdate($usulan, $usaha, 'ket');

        $usaha = (object) $data;
        $judul = "Detail Usulan Update Usaha";
        $latlng = explode(" ", substr(UsulanUpdate::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $id)->first()->latlng, 6, -1));
        return view('admin.usaha.detailUsulan', compact('usaha', 'latlng', 'judul'));
    }

    public function konfirmasiUsulan(Request $request){
        $usulan = UsulanUpdate::findOrFail($request->id);
        if($request->status == 1){
            $usaha = Usaha::findOrFail($usulan->usaha_id);
            $usaha->update([
                'jenis_usaha_id' => $usulan->jenis_usaha_id,
                'nama' => $usulan->nama,
                'jam_buka' => $usulan->jam_buka,
                'jam_tutup' => $usulan->jam_tutup,
                'alamat' => $usulan->alamat,
                'foto' => $usulan->foto,
                'geom' => $usulan->geom,
                'barang_jasa' => $usulan->barang_jasa,
                'ket' => $usulan->ket,
            ]);
        }
        $usulan->update(['status' => $request->status]);
        toastr()->success("Berhasil mengkonfirmasi usulan update usaha $usaha->nama");
        return redirect(route('usaha.index'));
    }
}
