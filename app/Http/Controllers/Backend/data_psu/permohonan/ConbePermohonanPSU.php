<?php

namespace App\Http\Controllers\Backend\data_psu\permohonan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ConbePermohonanPSU extends Controller
{
    public function index()
    {
        $getSession = Session::get('users_session');
        $id_users = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        $query_psu = DB::table('tbl_psu_permohonan')
            ->join('tbl_perumahan','tbl_psu_permohonan.id_perumahan','=','tbl_perumahan.id')
            ->join('tbl_reff_kode_kecamatan','tbl_perumahan.id_kecamatan','=','tbl_reff_kode_kecamatan.id')
            ->join('tbl_reff_kode_desa','tbl_perumahan.id_desa','=','tbl_reff_kode_desa.id')
            ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
            ->join('tbl_users','tbl_perusahaan_pengembang.id_users','=','tbl_users.id')
            ->select('tbl_psu_permohonan.id as id_permohonan_psu','tbl_perumahan.id_pengembang',
                'tbl_perusahaan_pengembang.nm_perusahaan','tbl_perusahaan_pengembang.alamat_perusahaan',
                'tbl_perusahaan_pengembang.id_users','tbl_users.nm_user','tbl_users.jns_kelamin',
                'tbl_psu_permohonan.id_perumahan',
                'tbl_perumahan.nm_perumahan','tbl_perumahan.luas_lahan_perumahan','tbl_perumahan.jml_unit',
                'tbl_reff_kode_kecamatan.nm_kecamatan','tbl_reff_kode_desa.nm_desa',
                'tbl_psu_permohonan.status_permohonan');
        if ($nm_role == 'superadmin') {
            $psu = $query_psu
                ->orderBy('tbl_psu_permohonan.id', 'DESC')
                ->get();
        }else if ($nm_role == 'developer') {
            $psu = $query_psu
                ->where('tbl_perusahaan_pengembang.id_users',$id_users)
                ->orderBy('tbl_psu_permohonan.id', 'DESC')
                ->get();
        }
        
        return view('backend.pages.data_psu.permohonan.index',compact('psu'));
    }

    public function index_tambah_permohonan()
    {
        $getSession = Session::get('users_session');
        $id_users = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        $query_perumahan = DB::table('tbl_perumahan')
            ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
            ->select('tbl_perumahan.id as id_perumahan','tbl_perumahan.nm_perumahan',
                'tbl_perumahan.id_pengembang','tbl_perusahaan_pengembang.nm_perusahaan'
                ,'tbl_perusahaan_pengembang.id_users');

        if ($nm_role == 'superadmin') {
            $perumahan = $query_perumahan
                ->get();
            $pengembang = DB::table('tbl_perusahaan_pengembang')->get();
        }else if ($nm_role == 'developer') {
            $perumahan = $query_perumahan
                ->where('tbl_perusahaan_pengembang.id_users',$id_users)
                ->get();
            $pengembang = DB::table('tbl_perusahaan_pengembang')->where('id_users',$id_users)->get();
        } 
        $kecamatan = DB::table('tbl_reff_kode_kecamatan')->get();

        return view('backend.pages.data_psu.permohonan.tambah_permohonan',compact('perumahan','pengembang','kecamatan'));
    }

    public function index_edit_permohonan($id)
    {
        $getSession = Session::get('users_session');
        $id_users = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        $id_permohonan_psu = base64_decode($id);

        $permohonan_psu = DB::table('tbl_psu_permohonan')
            ->join('tbl_psu_dokumen','tbl_psu_permohonan.id','=','tbl_psu_dokumen.id_permohonan_psu')
            ->select('tbl_psu_permohonan.*',
                'tbl_psu_dokumen.surat_permohonan','tbl_psu_dokumen.surat_rekom_izin',
                'tbl_psu_dokumen.foto_siteplan','tbl_psu_dokumen.surat_pernyataan_pemakaman'
            )->where('tbl_psu_permohonan.id',$id_permohonan_psu)->first();
        $id_perumahan = $permohonan_psu->id_perumahan;

        $query_perumahan = DB::table('tbl_perumahan')
            ->join('tbl_reff_kode_kecamatan','tbl_perumahan.id_kecamatan','=','tbl_reff_kode_kecamatan.id')
            ->join('tbl_reff_kode_desa','tbl_perumahan.id_desa','=','tbl_reff_kode_desa.id')
            ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
            ->select('tbl_perumahan.id as id_perumahan','tbl_perumahan.*',
                'tbl_perumahan.id_pengembang','tbl_perusahaan_pengembang.nm_perusahaan'
                ,'tbl_perusahaan_pengembang.id_users','tbl_reff_kode_kecamatan.kd_kecamatan','tbl_reff_kode_desa.kd_desa'
            );
        
        if ($nm_role == 'superadmin') {
            $pengembang = DB::table('tbl_perusahaan_pengembang')->get();
            $select_perumahan = $query_perumahan->where('tbl_perumahan.id',$id_perumahan)->get();
        }else if ($nm_role == 'developer') {
            $pengembang = DB::table('tbl_perusahaan_pengembang')->where('id_users',$id_users)->get();
            $select_perumahan = $query_perumahan->where('tbl_perumahan.id',$id_perumahan)->get();
        } 

        $perumahan = $query_perumahan->where('tbl_perumahan.id',$id_perumahan)->first();
        $prasarana = DB::table('tbl_perumahan_prasarana')->where('id_perumahan',$id_perumahan)->first();
        $sarana = DB::table('tbl_perumahan_sarana')->where('id_perumahan',$id_perumahan)->first();
        $utilitas = DB::table('tbl_perumahan_utilitas')->where('id_perumahan',$id_perumahan)->first();

        $kecamatan = DB::table('tbl_reff_kode_kecamatan')->get();
        $desa = DB::table('tbl_reff_kode_desa')->where('kd_kecamatan',$perumahan->kd_kecamatan)->get();
        
        return view('backend.pages.data_psu.permohonan.edit_permohonan',
            compact('id','select_perumahan','perumahan','pengembang','kecamatan','desa',
                'prasarana','sarana','utilitas'
            ));
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Tambah Data
    //--------------------------------------------------------------------------
    public function act_tambah_permohonan_psu(Request $request)
    {
        $id_perumahan               = $request->perumahan;
        $surat_permohonan           = $request->file('surat_permohonan');
        $surat_rekom_izin           = $request->file('surat_rekom_izin');
        $foto_siteplan              = $request->file('foto_siteplan');
        $surat_pernyataan_pemakaman = $request->file('surat_pernyataan_pemakaman');

        //custom notif validasi
        $messages = [
            'required' => ':attribute harus di unggah !',
            'not_in'   => ':attribute belum di pilih !',
        ];

        $attribute = array(
            'perumahan'                  => 'Perumahan',
            'surat_permohonan'           => 'Surat Permohonan',
            'surat_rekom_izin'           => 'Surat Rekomendasi/Izin',
            'foto_siteplan'              => 'Foto Siteplan',
            'surat_pernyataan_pemakaman' => 'Surat Pernyataan Menyediakan  Pemakaman',
        );
        // Terima Data request kemudian validasi dulu
        $validator = Validator::make($request->all(),[
            'perumahan'                  => 'required|not_in:0',
            'surat_permohonan'           => 'required',
            'surat_rekom_izin'           => 'required',
            'foto_siteplan'              => 'required',
            'surat_pernyataan_pemakaman' => 'required',
        ], $messages, $attribute);

        $validated = $validator->validated();
        if ($validated) {
            $cek_perumahan = DB::table('tbl_perumahan')->where('id',$id_perumahan)->count();
            if ($cek_perumahan > 0) {
                $cek_psu_perumahan = DB::table('tbl_psu_permohonan')
                    ->where('id_perumahan',$id_perumahan)->count();
                if ($cek_psu_perumahan > 0) {
                    return  redirect()->route('be.psu.permohonan.index')->with('failed', 'Perumahan, sudah melakukan permohonan PSU!');
                }else{
                    $get_perumahan = DB::table('tbl_perumahan')
                        ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
                        ->select('tbl_perumahan.id as id_perumahan','tbl_perumahan.nm_perumahan','tbl_perumahan.id_pengembang','tbl_perusahaan_pengembang.nm_perusahaan')
                        ->where('tbl_perumahan.id',$id_perumahan)
                        ->first();
                    $id_pengembang = $get_perumahan->id_pengembang; 

                    if(($request->hasFile('surat_permohonan')) && ($request->hasFile('surat_rekom_izin'))
                        && ($request->hasFile('foto_siteplan')) && ($request->hasFile('surat_pernyataan_pemakaman'))){

                        //Validasi File Surat Permohonan
                        $ori_ekstensi_surat_permohonan = $surat_permohonan->getClientOriginalExtension();
                        $ori_sizeSurat_permohonan      = number_format($surat_permohonan->getSize() / 1024, 0);
                        $size_surat_permohonan         = str_replace(',', '', $ori_sizeSurat_permohonan);

                        $pdf_surat_permohonan = "";
                        if ($ori_ekstensi_surat_permohonan == "pdf") {
                            if (($size_surat_permohonan < 100) || ($size_surat_permohonan > 1024)) {
                                $validator->errors()->add('surat_permohonan', 'file maksimal 1mb, minimal 100kb!');
                                return redirect()->back()->withInput($request->all())->withErrors($validator);
                            }else{
                                $nm_surat_permohonan = "doc-".$id_pengembang."-".$id_perumahan."-surat_permohonan".".". $ori_ekstensi_surat_permohonan;
                                $pdf_surat_permohonan = $nm_surat_permohonan;
                            }
                        } else {
                            $validator->errors()->add('surat_permohonan', 'Ekstensi file harus .pdf!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }

                        //Validasi File Surat Rekomendasi / Izin
                        $ori_ekstensi_surat_rekom_izin = $surat_rekom_izin->getClientOriginalExtension();
                        $ori_sizeSurat_rekom_izin      = number_format($surat_rekom_izin->getSize() / 1024, 0);
                        $size_surat_rekom_izin         = str_replace(',', '', $ori_sizeSurat_rekom_izin);

                        $pdf_surat_rekom_izin = "";
                        if ($ori_ekstensi_surat_rekom_izin == "pdf") {
                            if (($size_surat_rekom_izin < 100) || ($size_surat_rekom_izin > 1024)) {
                                $validator->errors()->add('surat_rekom_izin', 'file maksimal 1mb, minimal 100kb!');
                                return redirect()->back()->withInput($request->all())->withErrors($validator);
                            }else{
                                $nm_surat_rekom_izin = "doc-".$id_pengembang."-".$id_perumahan."-surat_rekom_izin".".". $ori_ekstensi_surat_rekom_izin;
                                $pdf_surat_rekom_izin = $nm_surat_rekom_izin;
                            }
                        } else {
                            $validator->errors()->add('surat_rekom_izin', 'Ekstensi file harus .pdf!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }

                        //Validasi File Siteplan
                        $ori_ekstensi_foto_siteplan = $foto_siteplan->getClientOriginalExtension();
                        $ori_sizefoto_siteplan      = number_format($foto_siteplan->getSize() / 1024, 0);
                        $size_foto_siteplan         = str_replace(',', '', $ori_sizefoto_siteplan);

                        $images_siteplan = "";
                        if (($ori_ekstensi_foto_siteplan == "jpg")||($ori_ekstensi_foto_siteplan == "png")) {
                            if (($size_foto_siteplan < 100) || ($size_foto_siteplan > 1024)) {
                                $validator->errors()->add('foto_siteplan', 'file Siteplan maksimal 1mb, minimal 100kb!');
                                return redirect()->back()->withInput($request->all())->withErrors($validator);
                            }else{
                                $nm_foto_siteplan = "doc-".$id_pengembang."-".$id_perumahan."-siteplan".".". $ori_ekstensi_foto_siteplan;
                                $images_siteplan = $nm_foto_siteplan;
                            }
                        } else {
                            $validator->errors()->add('foto_siteplan', 'Ekstensi file harus .jpg/.png!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }

                        //Validasi File surat pernyataan pemakaman
                        $ori_ekstensi_surat_pernyataan_pemakaman = $surat_pernyataan_pemakaman->getClientOriginalExtension();
                        $ori_sizeSurat_pernyataan_pemakaman      = number_format($surat_pernyataan_pemakaman->getSize() / 1024, 0);
                        $size_surat_pernyataan_pemakaman         = str_replace(',', '', $ori_sizeSurat_pernyataan_pemakaman);

                        $pdf_surat_pernyataan_pemakaman = "";
                        if ($ori_ekstensi_surat_pernyataan_pemakaman == "pdf") {
                            if (($size_surat_pernyataan_pemakaman < 100) || ($size_surat_pernyataan_pemakaman > 1024)) {
                                $validator->errors()->add('surat_pernyataan_pemakaman', 'file maksimal 1mb, minimal 100kb!');
                                return redirect()->back()->withInput($request->all())->withErrors($validator);
                            }else{
                                $nm_surat_pernyataan_pemakaman = "doc-".$id_pengembang."-".$id_perumahan."-surat_pernyataan_pemakaman".".". $ori_ekstensi_surat_pernyataan_pemakaman;
                                $pdf_surat_pernyataan_pemakaman = $nm_surat_pernyataan_pemakaman;
                            }
                        } else {
                            $validator->errors()->add('surat_pernyataan_pemakaman', 'Ekstensi file harus .pdf!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }

                        $arr_psu_permohonan = array(
                            "id_perumahan"      => $id_perumahan,
                            "tgl_permohonan"    => new \DateTime(),
                            "status_permohonan" => "permohonan"
                        );
                        $id_permohonan_psu = DB::table('tbl_psu_permohonan')->insertGetId($arr_psu_permohonan);

                        $arr_psu_dokumen = array(
                            "id_permohonan_psu"          => $id_permohonan_psu,
                            "surat_permohonan"           => $pdf_surat_permohonan,
                            "surat_rekom_izin"           => $pdf_surat_rekom_izin,
                            "foto_siteplan"              => $images_siteplan,
                            "surat_pernyataan_pemakaman" => $pdf_surat_pernyataan_pemakaman
                        );
                        $add_psu_dokumen = DB::table('tbl_psu_dokumen')->insert($arr_psu_dokumen);

                        //Simpan file ke storage
                        $path = public_path('storage/perumahan/').$id_pengembang.'/'.$id_perumahan;
                        if(!is_dir($path)) {
                            mkdir($path);
                            $surat_permohonan->move($path, $pdf_surat_permohonan);
                            $surat_rekom_izin->move($path, $pdf_surat_rekom_izin);
                            $foto_siteplan->move($path, $images_siteplan);
                            $surat_pernyataan_pemakaman->move($path, $pdf_surat_pernyataan_pemakaman);
                        }else{
                            $surat_permohonan->move($path, $pdf_surat_permohonan);
                            $surat_rekom_izin->move($path, $pdf_surat_rekom_izin);
                            $foto_siteplan->move($path, $images_siteplan);
                            $surat_pernyataan_pemakaman->move($path, $pdf_surat_pernyataan_pemakaman);
                        }
                        
                        return redirect()->route('be.psu.permohonan.index')->with('success', 'Data Permohonan : Berhasil di tambahkan.');
                    }else{
                        return redirect()->back()->withInput($request->all())->with('failed', 'Dokumen Persayaratan : belum di unggah!');
                    }
                }
            } else{
                return redirect()->back()->withInput($request->all())->with('failed', 'ID Perumahan : tidak ditemukan!');
            }  
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Edit Data
    //--------------------------------------------------------------------------
    public function act_edit_permohonan_psu(Request $request)
    {
        $id_permohonan_psu          = base64_decode($request->id_permohonan_psu);
        $id_perumahan               = $request->perumahan;
        $surat_permohonan           = $request->file('surat_permohonan');
        $surat_rekom_izin           = $request->file('surat_rekom_izin');
        $foto_siteplan              = $request->file('foto_siteplan');
        $surat_pernyataan_pemakaman = $request->file('surat_pernyataan_pemakaman');
        
        //custom notif validasi
        $messages = [
            'required' => ':attribute harus di unggah !',
            'not_in'   => ':attribute belum di pilih !',
        ];

        $attribute = array(
            'id_permohonan_psu'          => 'ID Permohonan PSU',
            'perumahan'                  => 'Perumahan',
            'surat_permohonan'           => 'Surat Permohonan',
            'surat_rekom_izin'           => 'Surat Rekomendasi/Izin',
            'foto_siteplan'              => 'Foto Siteplan',
            'surat_pernyataan_pemakaman' => 'Surat Pernyataan Menyediakan  Pemakaman',
        );
        // Terima Data request kemudian validasi dulu
        $validator = Validator::make($request->all(),[
            'id_permohonan_psu'          => 'required',
            'perumahan'                  => 'required|not_in:0',
            // 'surat_permohonan'           => 'required',
            // 'surat_rekom_izin'           => 'required',
            // 'foto_siteplan'              => 'required',
            // 'surat_pernyataan_pemakaman' => 'required',
        ], $messages, $attribute);

        $validated = $validator->validated();
        if ($validated) {
            $cek_psu_perumahan = DB::table('tbl_psu_permohonan')->where('id',$id_permohonan_psu)->count();
            if ($cek_psu_perumahan > 0) {

                $id_pengembang = DB::table('tbl_perumahan')->where('id',$id_perumahan)->first()->id_pengembang;

                $psu_dokumen = DB::table('tbl_psu_dokumen')
                    ->where('id_permohonan_psu',$id_permohonan_psu)->first();

                $pdf_surat_permohonan = "";
                $pdf_surat_rekom_izin = "";
                $images_siteplan = "";
                $pdf_surat_pernyataan_pemakaman = "";
                $path = public_path('storage/perumahan/').$id_pengembang.'/'.$id_perumahan;
                if($request->hasFile('surat_permohonan')){
                    //Validasi File Surat Permohonan
                    $ori_ekstensi_surat_permohonan = $surat_permohonan->getClientOriginalExtension();
                    $ori_sizeSurat_permohonan      = number_format($surat_permohonan->getSize() / 1024, 0);
                    $size_surat_permohonan         = str_replace(',', '', $ori_sizeSurat_permohonan);

                    if ($ori_ekstensi_surat_permohonan == "pdf") {
                        if (($size_surat_permohonan < 100) || ($size_surat_permohonan > 1024)) {
                            $validator->errors()->add('surat_permohonan', 'file maksimal 1mb, minimal 100kb!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }else{
                            //hapus dokumen sebelumnya
                            unlink($path.'/'. $psu_dokumen->surat_permohonan);
                            
                            //simpan dokumen baru
                            $nm_surat_permohonan = "doc-".$id_pengembang."-".$id_perumahan."-surat_permohonan".".". $ori_ekstensi_surat_permohonan;
                            $pdf_surat_permohonan = $nm_surat_permohonan;
                            $surat_permohonan->move($path, $pdf_surat_permohonan);
                        }
                    } else {
                        $validator->errors()->add('surat_permohonan', 'Ekstensi file harus .pdf!');
                        return redirect()->back()->withInput($request->all())->withErrors($validator);
                    }
                }else{
                    $pdf_surat_permohonan = $psu_dokumen->surat_permohonan;
                }

                if($request->hasFile('surat_rekom_izin')){
                    //Validasi File Surat Rekomendasi / Izin
                    $ori_ekstensi_surat_rekom_izin = $surat_rekom_izin->getClientOriginalExtension();
                    $ori_sizeSurat_rekom_izin      = number_format($surat_rekom_izin->getSize() / 1024, 0);
                    $size_surat_rekom_izin         = str_replace(',', '', $ori_sizeSurat_rekom_izin);

                    if ($ori_ekstensi_surat_rekom_izin == "pdf") {
                        if (($size_surat_rekom_izin < 100) || ($size_surat_rekom_izin > 1024)) {
                            $validator->errors()->add('surat_rekom_izin', 'file maksimal 1mb, minimal 100kb!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }else{
                            //hapus dokumen sebelumnya
                            unlink($path.'/'. $psu_dokumen->surat_rekom_izin);

                            //simpan dokumen baru
                            $nm_surat_rekom_izin = "doc-".$id_pengembang."-".$id_perumahan."-surat_rekom_izin".".". $ori_ekstensi_surat_rekom_izin;
                            $pdf_surat_rekom_izin = $nm_surat_rekom_izin;
                            $surat_rekom_izin->move($path, $pdf_surat_rekom_izin);
                        }
                    } else {
                        $validator->errors()->add('surat_rekom_izin', 'Ekstensi file harus .pdf!');
                        return redirect()->back()->withInput($request->all())->withErrors($validator);
                    }
                }else{
                    $pdf_surat_rekom_izin = $psu_dokumen->surat_rekom_izin;
                }

                if($request->hasFile('foto_siteplan')){
                    //Validasi File Siteplan
                    $ori_ekstensi_foto_siteplan = $foto_siteplan->getClientOriginalExtension();
                    $ori_sizefoto_siteplan      = number_format($foto_siteplan->getSize() / 1024, 0);
                    $size_foto_siteplan         = str_replace(',', '', $ori_sizefoto_siteplan);

                    if (($ori_ekstensi_foto_siteplan == "jpg")||($ori_ekstensi_foto_siteplan == "png")) {
                        if (($size_foto_siteplan < 100) || ($size_foto_siteplan > 1024)) {
                            $validator->errors()->add('foto_siteplan', 'file Siteplan maksimal 1mb, minimal 100kb!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }else{
                            //hapus dokumen sebelumnya
                            unlink($path.'/'. $psu_dokumen->foto_siteplan);

                            //simpan dokumen baru
                            $nm_foto_siteplan = "doc-".$id_pengembang."-".$id_perumahan."-siteplan".".". $ori_ekstensi_foto_siteplan;
                            $images_siteplan = $nm_foto_siteplan;
                            $foto_siteplan->move($path, $images_siteplan);
                            
                        }
                    } else {
                        $validator->errors()->add('foto_siteplan', 'Ekstensi file harus .jpg/.png!');
                        return redirect()->back()->withInput($request->all())->withErrors($validator);
                    }
                }else{
                    $images_siteplan = $psu_dokumen->foto_siteplan;
                }

                if($request->hasFile('surat_pernyataan_pemakaman')){
                    //Validasi File surat pernyataan pemakaman
                    $ori_ekstensi_surat_pernyataan_pemakaman = $surat_pernyataan_pemakaman->getClientOriginalExtension();
                    $ori_sizeSurat_pernyataan_pemakaman      = number_format($surat_pernyataan_pemakaman->getSize() / 1024, 0);
                    $size_surat_pernyataan_pemakaman         = str_replace(',', '', $ori_sizeSurat_pernyataan_pemakaman);

                    if ($ori_ekstensi_surat_pernyataan_pemakaman == "pdf") {
                        if (($size_surat_pernyataan_pemakaman < 100) || ($size_surat_pernyataan_pemakaman > 1024)) {
                            $validator->errors()->add('surat_pernyataan_pemakaman', 'file maksimal 1mb, minimal 100kb!');
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }else{
                            //hapus dokumen sebelumnya
                            unlink($path.'/'. $psu_dokumen->surat_pernyataan_pemakaman);

                            //simpan dokumen baru
                            $nm_surat_pernyataan_pemakaman = "doc-".$id_pengembang."-".$id_perumahan."-surat_pernyataan_pemakaman".".". $ori_ekstensi_surat_pernyataan_pemakaman;
                            $pdf_surat_pernyataan_pemakaman = $nm_surat_pernyataan_pemakaman;
                            $surat_pernyataan_pemakaman->move($path, $pdf_surat_pernyataan_pemakaman);
                        }
                    } else {
                        $validator->errors()->add('surat_pernyataan_pemakaman', 'Ekstensi file harus .pdf!');
                        return redirect()->back()->withInput($request->all())->withErrors($validator);
                    }
                }else{
                    $pdf_surat_pernyataan_pemakaman = $psu_dokumen->surat_pernyataan_pemakaman;
                }

                $arr_psu_permohonan = array(
                    "id_perumahan"      => $id_perumahan
                );
                $upd_permohonan_psu = DB::table('tbl_psu_permohonan')->where('id',$id_permohonan_psu)->update($arr_psu_permohonan);

                $arr_psu_dokumen = array(
                    "surat_permohonan"           => $pdf_surat_permohonan,
                    "surat_rekom_izin"           => $pdf_surat_rekom_izin,
                    "foto_siteplan"              => $images_siteplan,
                    "surat_pernyataan_pemakaman" => $pdf_surat_pernyataan_pemakaman
                );
                $upd_psu_dokumen = DB::table('tbl_psu_dokumen')->where('id_permohonan_psu',$id_permohonan_psu)->update($arr_psu_dokumen);
                

                return redirect()->route('be.psu.permohonan.index')->with('success', 'Data Permohonan : Berhasil di ubah.');
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'ID Permohonan PSU : tidak ditemukan!');
            }  
        }
    }

    public function act_edit_status_permohonan_psu(Request $request)
    {
        $id_permohonan_psu = $request->id_permohonan_psu;
        $status_psu        = $request->status_psu;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_permohonan_psu' => 'Id Permohonan PSU',
            'status_psu'        => 'Status Permohonan PSU'
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_permohonan_psu' => 'required',
            'status_psu'        => 'required'
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_permohonan_psu = DB::table('tbl_psu_permohonan')->where('id',$id_permohonan_psu)->count();
            if ($cek_id_permohonan_psu > 0) {

                if ($status_psu == "permohonan") {
                    $arr_update = array(
                        "status_permohonan" => $status_psu
                    );
                }elseif ($status_psu == "verifikasi") {
                    $arr_update = array(
                        "tgl_verifikasi"    => new \DateTime(),
                        "status_permohonan" => $status_psu
                    );
                }elseif ($status_psu == "pengesahan") {
                    $arr_update = array(
                        "tgl_pengesahan"    => new \DateTime(),
                        "status_permohonan" => $status_psu
                    );
                }elseif ($status_psu == "penerbitan") {
                    $arr_update = array(
                        "tgl_penerbitan"    => new \DateTime(),
                        "status_permohonan" => $status_psu
                    );
                }elseif ($status_psu == "serah_terima_psu") {
                    $arr_update = array(
                        "status_permohonan" => $status_psu
                    );
                }
                $upd_status_psu = DB::table('tbl_psu_permohonan')->where('id',$id_permohonan_psu)->update($arr_update);
                
                return redirect()->back()->with('success', 'Data Permohonan PSU : Berhasil di ubah statusnya.');
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Permohonan PSU : tidak ditemukan!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Hapus Data
    //--------------------------------------------------------------------------
    public function act_hapus_permohonan_psu(Request $request)
    {
        $id_permohonan_psu = $request->id_permohonan_psu;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_permohonan_psu'    => 'Id Permohonan PSU',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_permohonan_psu'    => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_permohonan_psu = DB::table('tbl_psu_permohonan')->where('id',$id_permohonan_psu)->count();
            if ($cek_id_permohonan_psu > 0) {
                $get_psu = DB::table('tbl_psu_permohonan')
                    ->join('tbl_perumahan','tbl_psu_permohonan.id_perumahan','=','tbl_perumahan.id')
                    ->join('tbl_psu_dokumen','tbl_psu_permohonan.id','=','tbl_psu_dokumen.id_permohonan_psu')
                    ->select('tbl_psu_permohonan.id as id_permohonan_psu','tbl_psu_permohonan.id_perumahan',
                        'tbl_perumahan.id_pengembang','tbl_psu_dokumen.surat_permohonan','tbl_psu_dokumen.surat_rekom_izin',
                        'tbl_psu_dokumen.foto_siteplan','tbl_psu_dokumen.surat_pernyataan_pemakaman')
                    ->where('tbl_psu_permohonan.id',$id_permohonan_psu)->first();

                //Hapus Dokument terupload
                $path = public_path('storage/perumahan/').$get_psu->id_pengembang.'/'.$get_psu->id_perumahan;
                unlink($path.'/'. $get_psu->surat_permohonan);
                unlink($path.'/'. $get_psu->surat_rekom_izin);
                unlink($path.'/'. $get_psu->foto_siteplan);
                unlink($path.'/'. $get_psu->surat_pernyataan_pemakaman);

                $del_dokumen = DB::table('tbl_psu_dokumen')->where('id_permohonan_psu',$id_permohonan_psu)->delete();
                $del_permohonan = DB::table('tbl_psu_permohonan')->where('id',$id_permohonan_psu)->delete();
                
                return redirect()->back()->with('success', 'Data Permohonan PSU : Berhasil di hapus.');
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Permohonan PSU : tidak ditemukan!');
            }
        }
    }
}
