<?php

namespace App\Http\Controllers\Api\ListPerumahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConPerumahan extends Controller
{
    public function getPerumahan_byId($id)
    {
        $id_perumahan = base64_decode($id);

        $cek_perumahan = DB::table('tbl_perumahan')
            ->where('id',$id_perumahan)
            ->count();
        if ($cek_perumahan > 0) {

            $perumahan = DB::table('tbl_perumahan')
                ->join('tbl_reff_kode_kecamatan','tbl_perumahan.id_kecamatan','=','tbl_reff_kode_kecamatan.id')
                ->join('tbl_reff_kode_desa','tbl_perumahan.id_desa','=','tbl_reff_kode_desa.id')
                ->select('tbl_perumahan.*','tbl_reff_kode_kecamatan.kd_kecamatan','tbl_reff_kode_desa.kd_desa')
                ->where('tbl_perumahan.id',$id_perumahan)->first();
            
            $prasarana = DB::table('tbl_perumahan_prasarana')->where('id_perumahan',$id_perumahan)->first();
            $sarana = DB::table('tbl_perumahan_sarana')->where('id_perumahan',$id_perumahan)->first();
            $utilitas = DB::table('tbl_perumahan_utilitas')->where('id_perumahan',$id_perumahan)->first();

            $data = array(
                "status" => "200",
                "message" => "Data Perumahan ditemukan!",
                "records" => array(
                    "perumahan" => $perumahan,
                    'prasarana' => $prasarana,
                    'sarana'    => $sarana,
                    'utilitas'  => $utilitas
                )
            );
        }else{
            $data = array(
                "status" => "204",
                "message" => "Perumahan tidak ditemukan!",
            );
        }
        return response($data);
    }

    public function getPerumahan_byKd_Kec_Desa($kd_kec,$kd_des)
    {
        $kd_kecamatan = $kd_kec;
        $kd_desa = $kd_des;

        $cek_kd_desa = DB::table('tbl_reff_kode_desa')
            ->where('kd_desa',$kd_desa)
            ->where('kd_kecamatan', $kd_kecamatan)
            ->count();
        if ($cek_kd_desa > 0) {
            $get_id =  DB::table('tbl_reff_kode_desa')
                ->where('kd_kecamatan', $kd_kecamatan)
                ->where('kd_desa',$kd_desa)
                ->first();
            
            $id_kecamatan = $get_id->id_kd_kecamatan;
            $id_desa = $get_id->id;

            $get_perumahan = DB::table('tbl_perumahan')
                ->join('tbl_perusahaan_pengembang', 'tbl_perumahan.id_pengembang', '=', 'tbl_perusahaan_pengembang.id')
                ->join('tbl_reff_kode_kecamatan', 'tbl_perumahan.id_kecamatan', '=', 'tbl_reff_kode_kecamatan.id')
                ->join('tbl_reff_kode_desa', 'tbl_perumahan.id_desa', '=', 'tbl_reff_kode_desa.id')
                ->leftJoin('tbl_psu_permohonan','tbl_perumahan.id','=','tbl_psu_permohonan.id_perumahan')
                ->select('tbl_perumahan.*',
                    'tbl_perusahaan_pengembang.nm_perusahaan',
                    'tbl_reff_kode_kecamatan.nm_kecamatan','tbl_reff_kode_desa.nm_desa',
                    'tbl_psu_permohonan.status_permohonan')
                ->where('tbl_perumahan.id_kecamatan', $id_kecamatan)
                ->where('tbl_perumahan.id_desa',$id_desa)
                ->get();

            $data = array(
                "status" => "200",
                "message" => "Data Perumahan ditemukan!",
                "records" => $get_perumahan
            );
        }else{
            $data = array(
                "status" => "204",
                "message" => "Kode Kecamatan dan Kode Desa tidak ditemukan!",
            );
        }
        return response($data);
    }

    public function getPerumahan_byNm_perumahan($nm_perumahan)
    {
        $cek_nm_perumahan = DB::table('tbl_perumahan')
            ->where('nm_perumahan', 'LIKE', '%' . $nm_perumahan . '%')
            ->count();
        if ($cek_nm_perumahan > 0) {

            $get_perumahan = DB::table('tbl_perumahan')
                ->join('tbl_perusahaan_pengembang', 'tbl_perumahan.id_pengembang', '=', 'tbl_perusahaan_pengembang.id')
                ->join('tbl_reff_kode_kecamatan', 'tbl_perumahan.id_kecamatan', '=', 'tbl_reff_kode_kecamatan.id')
                ->join('tbl_reff_kode_desa', 'tbl_perumahan.id_desa', '=', 'tbl_reff_kode_desa.id')
                ->leftJoin('tbl_psu_permohonan','tbl_perumahan.id','=','tbl_psu_permohonan.id_perumahan')
                ->select('tbl_perumahan.*',
                    'tbl_perusahaan_pengembang.nm_perusahaan',
                    'tbl_reff_kode_kecamatan.nm_kecamatan','tbl_reff_kode_desa.nm_desa',
                    'tbl_psu_permohonan.status_permohonan')
                ->where('tbl_perumahan.nm_perumahan', 'LIKE', '%' . $nm_perumahan . '%')
                ->get();

            $data = array(
                "status" => "200",
                "message" => "Data Perumahan ditemukan!",
                "records" => $get_perumahan
            );
        }else{
            $data = array(
                "status" => "204",
                "message" => "Nama Perumahan tidak ditemukan!",
            );
        }
        return response($data);
    }
}
