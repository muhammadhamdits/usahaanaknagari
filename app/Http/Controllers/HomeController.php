<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usaha;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $judul = "Dashboard";
        return view('dashboard', compact('judul'));
    }

    public function create(){
        $jenisUsahas = DB::table('jenis_usaha')->get()->keyBy('id')->pluck('nama');
        $judul = "Usulkan Data Usaha";
        return view('guest.usulanusaha', compact('jenisUsahas', 'judul'));
    }

    public function store(Request $request){
        $request->validate([
            'pengusul' => 'required',
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
            'pengusul' => $request->pengusul,
            'nama' => $request->nama,
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'alamat' => $request->alamat,
            'foto' => $saveName,
            'geom' => DB::raw("ST_GeomFromText('POINT($request->longitude $request->latitude)')"),
            'barang_jasa' => $request->barang_jasa,
            'ket' => $request->ket,
            'status' => 0,
            'pemilik' => $request->pemilik,
        ]);

        toastr()->success("Berhasil mengusulkan data usaha $usaha->nama");
        return redirect(route('home'));
    }

    public function usahaJson(){
        $data = Usaha::all();
        $output = [];
        foreach($data as $d){
            $latlng = explode(" ", substr(Usaha::select(DB::raw("ST_AsText(geom) AS latlng"))->where('id', $d->id)->first()->latlng, 6, -1));
            $output[] = [
                'title' => $d->nama,
                'lat' => $latlng[1],
                'lng' => $latlng[0]
            ];
        }
        echo(json_encode($output));
    }
}
