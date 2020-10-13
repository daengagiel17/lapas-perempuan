<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Proses;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Lapas Wanita',
            'email' => 'admin@lapas.com',
            'password' => bcrypt('lapas123'),
            'photo' => 'img/profile/default.png',
            'remember_token' => Str::random(60)
        ]);

        $prosess = [
            'surat_rt_dibuat',
            'surat_rt_kembali',
            'assesment',
            'kronologi',
            'permintaan_litmas',
            'interview_bapas',
            'litmas_datang',
        ];

        foreach ($prosess as $key => $proses) {
            Proses::create([
                'name' => $proses
            ]);
        }        
    }
}
