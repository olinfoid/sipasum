<?php

namespace App\Http\Controllers\Frontend\beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConBeranda extends Controller
{
    public function index()
    {
        $kecamatan = DB::table('tbl_reff_kode_kecamatan')->orderBy('nm_kecamatan', 'ASC')->get();
        $desa = DB::table('tbl_reff_kode_kecamatan')->orderBy('nm_kecamatan', 'ASC')->get();
        $perumahan = DB::table('tbl_perumahan')
            ->join('tbl_perusahaan_pengembang', 'tbl_perumahan.id_pengembang', '=', 'tbl_perusahaan_pengembang.id')
            ->join('tbl_reff_kode_kecamatan', 'tbl_perumahan.id_kecamatan', '=', 'tbl_reff_kode_kecamatan.id')
            ->join('tbl_reff_kode_desa', 'tbl_perumahan.id_desa', '=', 'tbl_reff_kode_desa.id')
            ->leftJoin('tbl_psu_permohonan','tbl_perumahan.id','=','tbl_psu_permohonan.id_perumahan')
            ->select('tbl_perumahan.*',
                'tbl_perusahaan_pengembang.nm_perusahaan',
                'tbl_reff_kode_kecamatan.nm_kecamatan','tbl_reff_kode_desa.nm_desa',
                'tbl_psu_permohonan.status_permohonan')
            ->orderBy('tbl_perumahan.nm_perumahan', 'ASC')
            ->get();

        $perumahan_prasarana = DB::table('tbl_perumahan_prasarana')->get();
        $perumahan_sarana = DB::table('tbl_perumahan_sarana')->get();
        $perumahan_utilitas = DB::table('tbl_perumahan_utilitas')->get();
        
        $total_perumahan = DB::table('tbl_perumahan')->count();
        $total_perumahan_serah_terima_psu = DB::table('tbl_perumahan')
            ->leftJoin('tbl_psu_permohonan','tbl_perumahan.id','=','tbl_psu_permohonan.id_perumahan')
            ->select('tbl_perumahan.*','tbl_psu_permohonan.status_permohonan')
            ->where('tbl_psu_permohonan.status_permohonan', 'serah_terima_psu')->count();
        $total_perumahan_belum_serah_terima_psu = DB::table('tbl_perumahan')
            ->leftJoin('tbl_psu_permohonan','tbl_perumahan.id','=','tbl_psu_permohonan.id_perumahan')
            ->select('tbl_perumahan.*','tbl_psu_permohonan.status_permohonan')
            ->where('tbl_psu_permohonan.status_permohonan',null)->count();

        return view('frontend.pages.beranda.index',
            compact(
                'kecamatan',
                'perumahan','total_perumahan','total_perumahan_serah_terima_psu','total_perumahan_belum_serah_terima_psu',
                'perumahan_prasarana','perumahan_sarana','perumahan_utilitas'
            )
        );
    }
}
