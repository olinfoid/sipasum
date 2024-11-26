<?php

namespace App\Http\Controllers\Api\KodeWilayah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConKodeWilayah extends Controller
{
    public function getDesa_byKd_kecamatan($kd_kec)
    {
        $kd_kecamatan = $kd_kec;

        $cek_kd_kecamatan = DB::table('tbl_reff_kode_desa')
            ->where('kd_kecamatan', $kd_kecamatan)
            ->count();
        if ($cek_kd_kecamatan > 0) {
            $get_desa =  DB::table('tbl_reff_kode_desa')
                ->where('kd_kecamatan', $kd_kecamatan)
                ->get();

            $data = array(
                "status" => "200",
                "message" => "Data Desa ditemukan!",
                "records" => $get_desa
            );
        }else{
            $data = array(
                "status" => "204",
                "message" => "Kode Kecamatan tidak ditemukan!",
            );
        }
        
        return response($data);
    }
}
