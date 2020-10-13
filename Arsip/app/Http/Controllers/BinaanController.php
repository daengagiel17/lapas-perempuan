<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Binaan;
use App\Models\Proses;
use App\Models\PetugasInterview;
use Str;
use Auth;
use DB;

class BinaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(DataTables $dataTables, Request $request)
    {
        if(request()->ajax())
        {
            // if($request->kelas)
            // {
            //     $model = Mahasiswa::where('kelas_id', $request->kelas)->get();
            // }
            // elseif($request->jurusan)
            // {
            //     $model = Mahasiswa::where('jurusan_id', $request->jurusan)->get();
            // }
            // elseif($request->fakultas)
            // {
            //     $model = Mahasiswa::where('fakultas_id', $request->fakultas)->get();
            // }
            // else
            // {
                $model = Binaan::all();            
            // }
    
            return $dataTables->collection($model)
                    ->addColumn('surat_rt_dibuat', function (Binaan $model) {
                        return $this->button($model, 0);
                    })
                    ->addColumn('surat_rt_kembali', function(Binaan $model) {
                        return $this->button($model, 1);
                    })
                    ->addColumn('assesment', function(Binaan $model) {
                        return $this->button($model, 2);
                    })
                    ->addColumn('kronologi', function(Binaan $model) {
                        return $this->button($model, 3);
                    })
                    ->addColumn('permintaan_litmas', function(Binaan $model) {
                        return $this->button($model, 4);
                    })
                    ->addColumn('interview_bapas', function(Binaan $model) {
                        return $this->button($model, 5);
                    })
                    ->addColumn('litmas_datang', function(Binaan $model) {
                        return $this->button($model, 6);
                    })
                    ->addColumn('action', function (Binaan $model) {
                        return '<a href="'.route('binaan.show', ['id' => $model->id]).'" class="btn btn-sm btn-info"><span class="fa fa-bars"></span></a>';
                    })
                    ->rawColumns([
                        'surat_rt_dibuat', 'surat_rt_kembali', 'assesment', 
                        'kronologi', 'permintaan_litmas', 'interview_bapas', 
                        'litmas_datang', 'action'])
                    ->addIndexColumn()
                    ->toJson();    
        }


        // $binaan = Binaan::all();     
        // $tanggal = $binaan[0]->proses[0]->pivot->tanggal;
        // $tanggal = date_create($tanggal);
        // $interval = $tanggal->diff(date_create());      
        // dd(isset($binaan[0]->petugasInterview->asal_petugas));

        $fakultas = 1;
        $jurusans = 1;
        $kelas =1;

        return view('binaan.index', compact(['fakultas', 'jurusans', 'kelas']));
        // return view('binaan.index');
    }

    public function button(Binaan $binaan, $id)
    {        
        $pra_tanggal = $binaan->proses[$id==0?0:$id-1]->pivot->tanggal;
        $pasca_tanggal = $binaan->proses[$id==6?6:$id+1]->pivot->tanggal;
        $tanggal = $binaan->proses[$id]->pivot->tanggal;

        if(isset($tanggal))
        {
            if($id < 4 || isset($pasca_tanggal))
            {
                return $tanggal;
            }

            $color = 'warning';
            
            $tanggal_b = date_create($tanggal);
            $interval = $tanggal_b->diff(date_create());
            if($id == 4)
            {
                $color = $interval->d > 7?'danger':'warning';
            }
            elseif($id == 5)
            {

                if($binaan->petugasInterview->asal_petugas == 'luar malang')
                {
                    $color = $interval->d > 14 ? 'danger' : 'warning';
                }
                else
                {
                    $color = $interval->d > 7 ? 'danger' : 'warning';
                }
            }
            
            return '<a href="#" class="btn btn-sm btn-'.$color.'">'.$tanggal.'</a>';
        }
        else
        {
            if($id == 0)
            {
                return '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$binaan->id.'" data-id-proses="'.($id+1).'" class="btn btn-sm btn-success update-proses"><span class="fa fa-edit"></span> Input</a>';
            }
            
            return isset($pra_tanggal)?'<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$binaan->id.'" data-id-proses="'.($id+1).'" class="btn btn-sm btn-success update-proses"><span class="fa fa-edit"></span> Input</a>':'-';
        }
    }

    public function updateProses(Request $request)
    {
        // return response()->json($request);
        $request->validate([
            'tanggal' => 'required',
        ]);

        $binaan = Binaan::find($request->binaan_id);
        $binaan->proses()->updateExistingPivot($request->proses_id, ['tanggal' => $request->tanggal, 'user_id' => Auth::user()->id]);

        return response()->json($binaan);
    }

    public function updateProsesPetugas(Request $request)
    {
        $request->validate([
            'tanggal_petugas' => 'required',
            'nama_petugas' => 'required',
            'asal_petugas' => 'required',
        ]);

        $binaan = Binaan::find($request->binaan_id_petugas);
        $binaan->proses()->updateExistingPivot($request->proses_id_petugas, ['tanggal' => $request->tanggal_petugas, 'user_id' => Auth::user()->id]);

        PetugasInterview::create([
            'binaan_id' => $request->binaan_id_petugas,
            'nama_petugas' => $request->nama_petugas,
            'asal_petugas' => $request->asal_petugas,
        ]);

        return response()->json($binaan);
    }

    public function show($id)
    {
        $binaan = Binaan::find($id);
        $prosess = DB::table('proses_binaans')
            ->join('proses', 'proses.id', 'proses_binaans.proses_id')
            ->join('users', 'users.id', 'proses_binaans.user_id')
            ->select('users.name as name_user','proses.name as name_proses', 'proses_binaans.tanggal', 'proses_binaans.updated_at')
            ->where('binaan_id', $id)
            ->where('tanggal', '!=', null)
            ->get();

        // dd($binaan, $prosess);
        // dd($binaan->petugasInterview->nama_petugas);
        return view('binaan.show', compact('binaan', 'prosess'));
    }

    public function create()
    {
        return view('binaan.create');
    }

    public function store(Request $request)
    {
		// validasi
        $request->validate([
            'name' => 'required',
            'no_register' => 'required'
        ]);

        $binaan = Binaan::create([
            'nama' => $request->name,
            'no_register' => $request->no_register,
            'pidana' => $request->pidana,
            'expirasi' => $request->expirasi,
            'seperdua_mp' => $request->seperdua_mp,
            'duapertiga_mp' => $request->duapertiga_mp,
        ]);

        $proses = Proses::all();

        $binaan->proses()->attach($proses);

        return redirect()->route('binaan.index')->with('sukses', "Data binaan baru berhasil disimpan");
    }

    public function getData($id, $proses_id)
    {
        return response()->json($id, $proses_id);
    }

    public function edit($id)
    {
        $binaan = Binaan::findOrFail($id);
        return view('binaan.edit', compact('binaan'));
    }

    public function update(Request $request, $id)
    {
        $binaan = Binaan::findOrFail($id);
        $binaan->nama = $request->nama;
        $binaan->no_register = $request->no_register;
        $binaan->pidana = $request->pidana;
        $binaan->expirasi = $request->expirasi;
        $binaan->seperdua_mp = $request->seperdua_mp;
        $binaan->duapertiga_mp = $request->duapertiga_mp;
        $binaan->save();

        return redirect()->route('binaan.show', ['id' => $binaan->id]);
    }

    public function destroy($id)
    {
        $binaan = Binaan::findOrFail($id);
        $binaan->proses()->detach();
        $binaan->delete();

        return redirect()->route('binaan.index');
    }

}
