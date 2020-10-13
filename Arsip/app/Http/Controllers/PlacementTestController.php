<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Kelas;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Str;

class PlacementTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DataTables $dataTables, Request $request)
    {
        if(request()->ajax())
        {
            if($request->kelas)
            {
                $model = Mahasiswa::where('kelas_id', $request->kelas)->get();
            }
            elseif($request->jurusan)
            {
                $model = Mahasiswa::where('jurusan_id', $request->jurusan)->get();
            }
            elseif($request->fakultas)
            {
                $model = Mahasiswa::where('fakultas_id', $request->fakultas)->get();
            }
            else
            {
                $model = Mahasiswa::all();            
            }
    
            return $dataTables->collection($model)
                    ->addColumn('jurusan', function(Mahasiswa $mahasiswa) {
                        return Str::upper($mahasiswa->fakultas->slug." / ".$mahasiswa->jurusan->slug);
                    })
                    ->addColumn('action', function (Mahasiswa $mahasiswa) {
                        return '<a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                    })
                    ->addIndexColumn()
                    ->toJson();    
        }

        $fakultas = Fakultas::all();
        $jurusans = Jurusan::all()->groupBy('fakultas_id');
        $kelas = Kelas::where('tahun_ajaran_id', 1)->get()->groupBy('jurusan_id');

        return view('placement-test.index', compact(['fakultas', 'jurusans', 'kelas']));
    }

    public function store(Request $request)
    {
		// validasi
        $request->validate([
            'file' => 'required'
        ]);

        Excel::import(new MahasiswasImport, $request->file('file'));
 
        return redirect()->route('placement-test.index')->with('sukses', "Data Mahasiswa Berhasil Diimport!");
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->name = $request->name;
        $mahasiswa->email = $request->email;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->save();

        return redirect()->route('placement-test.index');
    }

}
