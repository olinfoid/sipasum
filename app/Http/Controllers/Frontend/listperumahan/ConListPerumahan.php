<?php

namespace App\Http\Controllers\Frontend\listperumahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConListPerumahan extends Controller
{
    public function index()
    {
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
            ->paginate(16);
        $perumahan_prasarana = DB::table('tbl_perumahan_prasarana')->get();
        $perumahan_sarana = DB::table('tbl_perumahan_sarana')->get();
        $perumahan_utilitas = DB::table('tbl_perumahan_utilitas')->get();

        return view('frontend.pages.list_perumahan.index',
        compact('perumahan',
            'perumahan_prasarana','perumahan_sarana','perumahan_utilitas'
        ));
    }
}
