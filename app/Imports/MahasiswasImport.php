<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Kelas;

class MahasiswasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fakultas = Fakultas::where('slug', $row['fakultas'])->first();
        $jurusan = Jurusan::where('slug', $row['jurusan'])->first();

        // Belum selesai
        if(!isset($fakultas) || !isset($jurusan))
        {
            return null;
        }

        $kelas = Kelas::where('jurusan_id', $jurusan->id)
            ->where('tahun_ajaran_id', 1)
            ->where('name', $row['kelas'])
            ->first();

        if(is_null($kelas)){
            $kelas = new Kelas;
            $kelas->name = $row['kelas'];
            $kelas->jurusan_id = $jurusan->id;
            $kelas->tahun_ajaran_id = 1;
            $kelas->save();
        }

        $nim = sprintf("%d", $row['nim']);
        $angkatan = substr($nim, 0, 4);
        $photo = "https://krs.umm.ac.id/Poto/".$angkatan."/".$nim.".JPG";
        
        return new Mahasiswa([
            'fakultas_id' => $fakultas->id,
            'jurusan_id' => $jurusan->id,
            'kelas_id' => $kelas->id,
            'remember_token' => Str::random(60),
            'nim' => $row['nim'],
            'name' => $row['nama'], 
            'photo' => $photo, 
        ]);
    }
}
