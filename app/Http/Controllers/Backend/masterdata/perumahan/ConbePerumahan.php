<?php

namespace App\Http\Controllers\Backend\masterdata\perumahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ConbePerumahan extends Controller
{
    public function index_semua_perumahan()
    {
        //get Session
        $getSession = Session::get('users_session');
        $id_users   = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        $query_perumahan = DB::table('tbl_perumahan')
            ->leftJoin('tbl_psu_permohonan','tbl_perumahan.id','=','tbl_psu_permohonan.id_perumahan')
            ->join('tbl_reff_kode_kecamatan','tbl_perumahan.id_kecamatan','=','tbl_reff_kode_kecamatan.id')
            ->join('tbl_reff_kode_desa','tbl_perumahan.id_desa','=','tbl_reff_kode_desa.id')
            ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
            ->join('tbl_users','tbl_perusahaan_pengembang.id_users','=','tbl_users.id')
            ->select('tbl_perumahan.id_pengembang',
                'tbl_perusahaan_pengembang.nm_perusahaan','tbl_perusahaan_pengembang.alamat_perusahaan',
                'tbl_perusahaan_pengembang.id_users','tbl_users.nm_user','tbl_users.jns_kelamin',
                'tbl_perumahan.id as id_perumahan',
                'tbl_perumahan.nm_perumahan','tbl_perumahan.luas_lahan_perumahan','tbl_perumahan.jml_unit',
                'tbl_reff_kode_kecamatan.nm_kecamatan','tbl_reff_kode_desa.nm_desa',
                'tbl_psu_permohonan.status_permohonan');

        if ($nm_role == 'superadmin') {
            $perumahan = $query_perumahan
                ->orderBy('tbl_perumahan.id', 'DESC')
                ->get();
        }else if ($nm_role == 'developer') {
            $perumahan = $query_perumahan
                ->where('tbl_perusahaan_pengembang.id_users',$id_users)
                ->orderBy('tbl_perumahan.id', 'DESC')
                ->get();
        }
        
        return view('backend.pages.data_master.perumahan.semua_perumahan',compact('perumahan'));
    }

    public function index_tambah_perumahan()
    {   
        //get Session
        $getSession = Session::get('users_session');
        $id_users   = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        if ($nm_role == 'superadmin') {
            $pengembang = DB::table('tbl_perusahaan_pengembang')->get();
        }else if ($nm_role == 'developer') {
            $pengembang = DB::table('tbl_perusahaan_pengembang')
                ->where('id_users',$id_users)->get();
        }
        
        $kecamatan = DB::table('tbl_reff_kode_kecamatan')->get();
        return view('backend.pages.data_master.perumahan.tambah_perumahan',compact('pengembang','kecamatan'));
    }

    public function index_edit_perumahan($id_perumahan)
    {   
        //get Session
        $getSession = Session::get('users_session');
        $id_users   = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        $id = base64_decode($id_perumahan);

        $perumahan = DB::table('tbl_perumahan')
            ->join('tbl_reff_kode_kecamatan','tbl_perumahan.id_kecamatan','=','tbl_reff_kode_kecamatan.id')
            ->join('tbl_reff_kode_desa','tbl_perumahan.id_desa','=','tbl_reff_kode_desa.id')
            ->select('tbl_perumahan.*','tbl_reff_kode_kecamatan.kd_kecamatan','tbl_reff_kode_desa.kd_desa')
            ->where('tbl_perumahan.id',$id)->first();
        $prasarana = DB::table('tbl_perumahan_prasarana')->where('id_perumahan',$id)->first();
        $sarana = DB::table('tbl_perumahan_sarana')->where('id_perumahan',$id)->first();
        $utilitas = DB::table('tbl_perumahan_utilitas')->where('id_perumahan',$id)->first();
        

        if ($nm_role == 'superadmin') {
            $pengembang = DB::table('tbl_perusahaan_pengembang')->get();
        }else if ($nm_role == 'developer') {
            $pengembang = DB::table('tbl_perusahaan_pengembang')
                ->where('id_users',$id_users)->get();
        }
        $kecamatan = DB::table('tbl_reff_kode_kecamatan')->get();
        $desa = DB::table('tbl_reff_kode_desa')->where('kd_kecamatan',$perumahan->kd_kecamatan)->get();

        return view('backend.pages.data_master.perumahan.edit_perumahan',compact(
            'id_perumahan','perumahan','prasarana','sarana','utilitas',
            'pengembang','kecamatan','desa'
        ));
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Tambah Data
    //--------------------------------------------------------------------------
    public function act_tambah_perumahan(Request $request)
    {   
        //Perumahan
        $perusahaan_pengembang = $request->perusahaan_pengembang;
        $nm_perumahan          = $request->nm_perumahan;
        $jml_unit              = $request->jml_unit;
        $kd_kecamatan          = $request->kd_kecamatan;
        $kd_desa               = $request->kd_desa;
        $luas_lahan_perumahan  = $request->luas_lahan_perumahan;
        $luas_lahan_efektif    = $request->luas_lahan_efektif;
        $luas_lahan_nonefektif = $request->luas_lahan_nonefektif;
        $foto                  = $request->file('foto');
        $maps_lokasi           = $request->maps_lokasi;

        //Prasarana
        $jaringan_jalan       = $request->jaringan_jalan;
        $jaringan_drainase    = $request->jaringan_drainase;
        $jaringan_sanitasi    = $request->jaringan_sanitasi;
        $jaringan_persampahan = $request->jaringan_persampahan;
        $prasarana_lainnya    = $request->prasarana_lainnya;

        //Sarana
        $peribadahan                     = $request->sarana_ibadah;
        $rekreasi_dan_olahraga           = $request->sarana_rekreasi_olaharaga;
        $pertamanan_dan_rth              = $request->sarana_pertamanan_rth;
        $perniagaan                      = $request->sarana_perniagaan;
        $fasilitas_sosial                = $request->sarana_fasilitas_sosial;
        $pendidikan                      = $request->sarana_pendidikan;
        $kesehatan                       = $request->sarana_kesehatan;
        $pemakaman                       = $request->sarana_pemakaman;
        $parkir                          = $request->sarana_parkir;
        $pelayanan_umum_dan_pemerintahan = $request->sarana_pelayananumum_pemerintah;
        $sarana_lainnya                  = $request->sarana_lainnya;

        //Utilitas
        $jaringan_penerangan        = $request->jaringan_penerangan;
        $jaringan_air_bersih        = $request->jaringan_air_bersih;
        $jaringan_listrik           = $request->jaringan_listrik;
        $jaringan_telepon           = $request->jaringan_telepon;
        $jaringan_pemadam_kebakaran = $request->jaringan_pemadam_kebakaran;
        $gas                        = $request->jaringan_gas;
        $transportasi               = $request->jaringan_transportasi;

        //custom notif validasi
        $messages = [
            'required' => ':attribute harus di isi !',
            'not_in'   => ':attribute belum di pilih !',
            'extensions'=> ':attribute harus JPG/PNG'
        ];
        $attribute = array(
            'perusahaan_pengembang' => 'Perusahaan Pengembang',
            'nm_perumahan'          => 'Nama Perusahaan',
            'jml_unit'              => 'Jumlah Unit',
            'kd_kecamatan'          => 'Kecamatan',
            'kd_desa'               => 'Desa',
            'luas_lahan_perumahan'  => 'Luas Lahan Perumahan',
            'luas_lahan_efektif'    => 'Luas Lahan Efektif',
            'luas_lahan_nonefektif' => 'Luas Lahan Non Efektif',
            'foto'                  => 'Foto',
            'maps_lokasi'           => 'Maps Lokasi',
            'jaringan_jalan'            => 'Jaringan Jalan',
            'jaringan_drainase'         => 'Jaringan Drainase',
            'jaringan_sanitasi'         => 'Jaringan Sanitasi',
            'jaringan_persampahan'      => 'Jaringan Persampahan',
            'prasarana_lainnya'         => 'Prasarana Lainnya',
            'sarana_ibadah'                   => 'Sarana Ibadah',
            'sarana_rekreasi_olaharaga'       => 'Sarana Rekreasi Olahraga',
            'sarana_pertamanan_rth'           => 'Sarana Pertamanan RTH',
            'sarana_perniagaan'               => 'Sarana Perniagaan',
            'sarana_fasilitas_sosial'         => 'Sarana Fasilitas Sosial',
            'sarana_pendidikan'               => 'Sarana Pendidikan',
            'sarana_kesehatan'                => 'Sarana Kesehatan',
            'sarana_pemakaman'                => 'Sarana Pemakaman',
            'sarana_parkir'                   => 'Sarana Parkir',
            'sarana_pelayananumum_pemerintah' => 'Sarana Pelayanan Umum Pemerintah',
            'sarana_lainnya'                  => 'Sarana Lainnya',
            'jaringan_penerangan'        => 'Jaringan Penerangan',
            'jaringan_air_bersih'        => 'Jaringan Air Bersih',
            'jaringan_listrik'           => 'Jaringan Listrik',
            'jaringan_telepon'           => 'Jaringan Telepon',
            'jaringan_pemadam_kebakaran' => 'Jaringan Pemadam Kebakaran',
            'jaringan_gas'               => 'Jaringan Gas',
            'jaringan_transportasi'      => 'Jaringan Transportasi',
        );
        // Terima Data request kemudian validasi dulu
        $validator = Validator::make($request->all(),[
            'perusahaan_pengembang' => 'required|not_in:0',
            'nm_perumahan'          => 'required',
            'jml_unit'              => 'required',
            'kd_kecamatan'          => 'required|not_in:0',
            'kd_desa'               => 'required|not_in:0',
            'luas_lahan_perumahan'  => 'required',
            'luas_lahan_efektif'    => 'required',
            'luas_lahan_nonefektif' => 'required',
            'foto'                  => 'required',
            'maps_lokasi'           => 'required',
            'jaringan_jalan'            => 'required',
            'jaringan_drainase'         => 'required',
            'jaringan_sanitasi'         => 'required',
            'jaringan_persampahan'      => 'required',
            'prasarana_lainnya'         => 'required',
            'sarana_ibadah'                   => 'required',
            'sarana_rekreasi_olaharaga'       => 'required',
            'sarana_pertamanan_rth'           => 'required',
            'sarana_perniagaan'               => 'required',
            'sarana_fasilitas_sosial'         => 'required',
            'sarana_pendidikan'               => 'required',
            'sarana_kesehatan'                => 'required',
            'sarana_pemakaman'                => 'required',
            'sarana_parkir'                   => 'required',
            'sarana_pelayananumum_pemerintah' => 'required',
            'sarana_lainnya'                  => 'required',
            'jaringan_penerangan'        => 'required',
            'jaringan_air_bersih'        => 'required|not_in:0',
            'jaringan_listrik'           => 'required|not_in:0',
            'jaringan_telepon'           => 'required|not_in:0',
            'jaringan_pemadam_kebakaran' => 'required|not_in:0',
            'jaringan_gas'               => 'required|not_in:0',
            'jaringan_transportasi'      => 'required|not_in:0',
        ], $messages, $attribute);

        $validated = $validator->validated();

        if ($validated) {
            
            //Validasi Foto Multiple
            $foto_perumahan = array();
            foreach($foto as $arr_foto){
                $ori_namaFoto     = $arr_foto->getClientOriginalName();
                $ori_ekstensiFoto = $arr_foto->getClientOriginalExtension();
                $ori_sizeFoto     = number_format($arr_foto->getSize() / 1024, 0); //KB
                $size_foto        = str_replace(',', '', $ori_sizeFoto);

                if (($ori_ekstensiFoto == "jpg") || ($ori_ekstensiFoto == "png")) {
                    if (($size_foto < 100) || ($size_foto > 1000)) {
                        $validator->errors()->add('foto', 'foto maksimal 1mb, minimal 100kb!');

                        return redirect()->back()->withInput($request->all())->withErrors($validator);
                    }else{
                        $nama_foto = "foto-".$perusahaan_pengembang."-".rand(). "." . $ori_ekstensiFoto;
                        $foto_perumahan[] = $nama_foto;
                    }
                } else {
                    $validator->errors()->add('foto', 'Ekstensi foto harus .jpg atau .png !');
                    
                    return redirect()->back()->withInput($request->all())->withErrors($validator);
                }
            }

            $id_kecamatan = DB::table('tbl_reff_kode_kecamatan')
                ->where('kd_kecamatan',$kd_kecamatan)
                ->first()->id;
            $id_desa = DB::table('tbl_reff_kode_desa')
                ->where('kd_desa',$kd_desa)
                ->first()->id;

            $arr_maps = explode('"',$maps_lokasi);
            $src_maps = $arr_maps[1];

            $arr_perumahan = array(
                'nm_perumahan'           => $nm_perumahan,
                'id_pengembang'          => $perusahaan_pengembang,
                'luas_lahan_perumahan'   => $luas_lahan_perumahan,
                'luas_lahan_efektif'     => $luas_lahan_efektif,
                'luas_lahan_non_efektif' => $luas_lahan_nonefektif,
                'jml_unit'               => $jml_unit,
                'maps'                   => $src_maps,
                'foto'                   => implode("|",$foto_perumahan),
                'id_kecamatan'           => $id_kecamatan,
                'id_desa'                => $id_desa
            );
            $id_perumahan = DB::table('tbl_perumahan')->insertGetId($arr_perumahan);

            $arr_prasarana = array(
                'id_perumahan'         => $id_perumahan,
                'jaringan_jalan'       => $jaringan_jalan,
                'jaringan_drainase'    => $jaringan_drainase,
                'jaringan_sanitasi'    => $jaringan_sanitasi,
                'jaringan_persampahan' => $jaringan_persampahan,
                'prasarana_lainnya'    => $prasarana_lainnya,
            );
            $add_prasarana = DB::table('tbl_perumahan_prasarana')->insert($arr_prasarana);

            $arr_sarana = array(
                'id_perumahan'                    => $id_perumahan,
                'peribadahan'                     => $peribadahan,
                'rekreasi_dan_olahraga'           => $rekreasi_dan_olahraga,
                'pertamanan_dan_rth'              => $pertamanan_dan_rth,
                'perniagaan'                      => $perniagaan,
                'fasilitas_sosial'                => $fasilitas_sosial,
                'pendidikan'                      => $pendidikan,
                'kesehatan'                       => $kesehatan,
                'pemakaman'                       => $pemakaman,
                'parkir'                          => $parkir,
                'pelayanan_umum_dan_pemerintahan' => $pelayanan_umum_dan_pemerintahan,
                'sarana_lainnya'                  => $sarana_lainnya,
            );
            $add_sarana = DB::table('tbl_perumahan_sarana')->insert($arr_sarana);

            $arr_utilitas = array(
                'id_perumahan'              => $id_perumahan,
                'jaringan_penerangan'       => $jaringan_penerangan,
                'jaringan_air_bersih'       => $jaringan_air_bersih,
                'jaringan_listrik'          => $jaringan_listrik,
                'jaringan_telepon'          => $jaringan_telepon,
                'jaringan_pemadam_kebakaran'=> $jaringan_pemadam_kebakaran,
                'gas'                       => $gas,
                'transportasi'              => $transportasi
            );
            $add_utilitas = DB::table('tbl_perumahan_utilitas')->insert($arr_utilitas);

            //Simpan Foto Multiple
            foreach ($foto as $key => $val_perum) {
                $path = public_path('storage/perumahan/').$perusahaan_pengembang;
                if(!is_dir($path)) {
                    mkdir($path);
                    $val_perum->move(public_path('storage/perumahan/').$perusahaan_pengembang, $foto_perumahan[$key]);
                }else{
                    $val_perum->move(public_path('storage/perumahan/').$perusahaan_pengembang, $foto_perumahan[$key]);
                }
            }
            
            return redirect()->route('be.masterdata.perumahan.semua_perumahan')->with('success', 'Data Perumahan : Berhasil di tambahkan.');
        
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Edit Data
    //--------------------------------------------------------------------------
    public function act_edit_perumahan(Request $request)
    {
        //Perumahan
        $id_perumahan          = base64_decode($request->id_perumahan);
        $perusahaan_pengembang = $request->perusahaan_pengembang;
        $nm_perumahan          = $request->nm_perumahan;
        $jml_unit              = $request->jml_unit;
        $kd_kecamatan          = $request->kd_kecamatan;
        $kd_desa               = $request->kd_desa;
        $luas_lahan_perumahan  = $request->luas_lahan_perumahan;
        $luas_lahan_efektif    = $request->luas_lahan_efektif;
        $luas_lahan_nonefektif = $request->luas_lahan_nonefektif;
        $foto                  = $request->file('foto');
        $maps_lokasi           = $request->maps_lokasi;

        //Prasarana
        $jaringan_jalan       = $request->jaringan_jalan;
        $jaringan_drainase    = $request->jaringan_drainase;
        $jaringan_sanitasi    = $request->jaringan_sanitasi;
        $jaringan_persampahan = $request->jaringan_persampahan;
        $prasarana_lainnya    = $request->prasarana_lainnya;

        //Sarana
        $peribadahan                     = $request->sarana_ibadah;
        $rekreasi_dan_olahraga           = $request->sarana_rekreasi_olaharaga;
        $pertamanan_dan_rth              = $request->sarana_pertamanan_rth;
        $perniagaan                      = $request->sarana_perniagaan;
        $fasilitas_sosial                = $request->sarana_fasilitas_sosial;
        $pendidikan                      = $request->sarana_pendidikan;
        $kesehatan                       = $request->sarana_kesehatan;
        $pemakaman                       = $request->sarana_pemakaman;
        $parkir                          = $request->sarana_parkir;
        $pelayanan_umum_dan_pemerintahan = $request->sarana_pelayananumum_pemerintah;
        $sarana_lainnya                  = $request->sarana_lainnya;

        //Utilitas
        $jaringan_penerangan        = $request->jaringan_penerangan;
        $jaringan_air_bersih        = $request->jaringan_air_bersih;
        $jaringan_listrik           = $request->jaringan_listrik;
        $jaringan_telepon           = $request->jaringan_telepon;
        $jaringan_pemadam_kebakaran = $request->jaringan_pemadam_kebakaran;
        $gas                        = $request->jaringan_gas;
        $transportasi               = $request->jaringan_transportasi;


        //custom notif validasi
        $messages = [
            'required' => ':attribute harus di isi !',
            'not_in'   => ':attribute belum di pilih !',
            'extensions'=> ':attribute harus JPG/PNG'
        ];
        $attribute = array(
            'id_perumahan'          => 'ID Perumahan',
            'perusahaan_pengembang' => 'Perusahaan Pengembang',
            'nm_perumahan'          => 'Nama Perusahaan',
            'jml_unit'              => 'Jumlah Unit',
            'kd_kecamatan'          => 'Kecamatan',
            'kd_desa'               => 'Desa',
            'luas_lahan_perumahan'  => 'Luas Lahan Perumahan',
            'luas_lahan_efektif'    => 'Luas Lahan Efektif',
            'luas_lahan_nonefektif' => 'Luas Lahan Non Efektif',
            'foto'                  => 'Foto',
            'maps_lokasi'           => 'Maps Lokasi',
            'jaringan_jalan'            => 'Jaringan Jalan',
            'jaringan_drainase'         => 'Jaringan Drainase',
            'jaringan_sanitasi'         => 'Jaringan Sanitasi',
            'jaringan_persampahan'      => 'Jaringan Persampahan',
            'prasarana_lainnya'         => 'Prasarana Lainnya',
            'sarana_ibadah'                   => 'Sarana Ibadah',
            'sarana_rekreasi_olaharaga'       => 'Sarana Rekreasi Olahraga',
            'sarana_pertamanan_rth'           => 'Sarana Pertamanan RTH',
            'sarana_perniagaan'               => 'Sarana Perniagaan',
            'sarana_fasilitas_sosial'         => 'Sarana Fasilitas Sosial',
            'sarana_pendidikan'               => 'Sarana Pendidikan',
            'sarana_kesehatan'                => 'Sarana Kesehatan',
            'sarana_pemakaman'                => 'Sarana Pemakaman',
            'sarana_parkir'                   => 'Sarana Parkir',
            'sarana_pelayananumum_pemerintah' => 'Sarana Pelayanan Umum Pemerintah',
            'sarana_lainnya'                  => 'Sarana Lainnya',
            'jaringan_penerangan'        => 'Jaringan Penerangan',
            'jaringan_air_bersih'        => 'Jaringan Air Bersih',
            'jaringan_listrik'           => 'Jaringan Listrik',
            'jaringan_telepon'           => 'Jaringan Telepon',
            'jaringan_pemadam_kebakaran' => 'Jaringan Pemadam Kebakaran',
            'jaringan_gas'               => 'Jaringan Gas',
            'jaringan_transportasi'      => 'Jaringan Transportasi',
        );
        // Terima Data request kemudian validasi dulu
        $validator = Validator::make($request->all(),[
            'id_perumahan'          => 'required',
            'perusahaan_pengembang' => 'required|not_in:0',
            'nm_perumahan'          => 'required',
            'jml_unit'              => 'required',
            'kd_kecamatan'          => 'required|not_in:0',
            'kd_desa'               => 'required|not_in:0',
            'luas_lahan_perumahan'  => 'required',
            'luas_lahan_efektif'    => 'required',
            'luas_lahan_nonefektif' => 'required',
            // 'foto'                  => 'required',
            'maps_lokasi'           => 'required',
            'jaringan_jalan'            => 'required',
            'jaringan_drainase'         => 'required',
            'jaringan_sanitasi'         => 'required',
            'jaringan_persampahan'      => 'required',
            'prasarana_lainnya'         => 'required',
            'sarana_ibadah'                   => 'required',
            'sarana_rekreasi_olaharaga'       => 'required',
            'sarana_pertamanan_rth'           => 'required',
            'sarana_perniagaan'               => 'required',
            'sarana_fasilitas_sosial'         => 'required',
            'sarana_pendidikan'               => 'required',
            'sarana_kesehatan'                => 'required',
            'sarana_pemakaman'                => 'required',
            'sarana_parkir'                   => 'required',
            'sarana_pelayananumum_pemerintah' => 'required',
            'sarana_lainnya'                  => 'required',
            'jaringan_penerangan'        => 'required',
            'jaringan_air_bersih'        => 'required|not_in:0',
            'jaringan_listrik'           => 'required|not_in:0',
            'jaringan_telepon'           => 'required|not_in:0',
            'jaringan_pemadam_kebakaran' => 'required|not_in:0',
            'jaringan_gas'               => 'required|not_in:0',
            'jaringan_transportasi'      => 'required|not_in:0',
        ], $messages, $attribute);

        $validated = $validator->validated();

        if ($validated) {
            $cek_id_perumahan = DB::table('tbl_perumahan')->where('id',$id_perumahan)->count();
            if ($cek_id_perumahan > 0 ) {

                $id_kecamatan = DB::table('tbl_reff_kode_kecamatan')
                    ->where('kd_kecamatan',$kd_kecamatan)
                    ->first()->id;
                $id_desa = DB::table('tbl_reff_kode_desa')
                    ->where('kd_desa',$kd_desa)
                    ->first()->id;
                
                $arr_maps = explode('"',$maps_lokasi);
                $src_maps = $arr_maps[1];

                //cek apakah foto dirubah
                if($request->hasFile('foto')){
                    
                    //Validasi Foto Multiple
                    $foto_perumahan = array();
                    foreach($request->file('foto') as $arr_foto){
                        $ori_namaFoto     = $arr_foto->getClientOriginalName();
                        $ori_ekstensiFoto = $arr_foto->getClientOriginalExtension();
                        $ori_sizeFoto     = number_format($arr_foto->getSize() / 1024, 0); //KB
                        $size_foto        = str_replace(',', '', $ori_sizeFoto);

                        if (($ori_ekstensiFoto == "jpg") || ($ori_ekstensiFoto == "png")) {
                            if (($size_foto < 100) || ($size_foto > 1000)) {
                                $validator->errors()->add('foto', 'foto maksimal 1mb, minimal 100kb!');

                                return redirect()->back()->withInput($request->all())->withErrors($validator);
                            }else{
                                $nama_foto = "foto-".$perusahaan_pengembang."-".rand(). "." . $ori_ekstensiFoto;
                                $foto_perumahan[] = $nama_foto;
                            }
                        } else {
                            $validator->errors()->add('foto', 'Ekstensi foto harus .jpg atau .png !');
                            
                            return redirect()->back()->withInput($request->all())->withErrors($validator);
                        }
                    }
                    
                    //Hapus Foto Sebelumnya
                    $get_perumahan = DB::table('tbl_perumahan')->where('id',$id_perumahan)->first();
                    $arr_foto = explode('|',$get_perumahan->foto);
                    foreach ($arr_foto as $kf => $last_foto) {
                        unlink(public_path('storage/perumahan/').$get_perumahan->id_pengembang.'/'. $last_foto);
                    }

                    $arr_perumahan = array(
                        'nm_perumahan'           => $nm_perumahan,
                        'id_pengembang'          => $perusahaan_pengembang,
                        'luas_lahan_perumahan'   => $luas_lahan_perumahan,
                        'luas_lahan_efektif'     => $luas_lahan_efektif,
                        'luas_lahan_non_efektif' => $luas_lahan_nonefektif,
                        'jml_unit'               => $jml_unit,
                        'maps'                   => $src_maps,
                        'foto'                   => implode("|",$foto_perumahan),
                        'id_kecamatan'           => $id_kecamatan,
                        'id_desa'                => $id_desa
                    );
                    $upd_perumahan_dengan_foto = DB::table('tbl_perumahan')->where('id',$id_perumahan)->update($arr_perumahan);
                    
                    //Simpan Foto Baru Multiple
                    foreach ($foto as $key => $val_perum) {
                        $path = public_path('storage/perumahan/').$perusahaan_pengembang;
                        if(!is_dir($path)) {
                            mkdir($path);
                            $val_perum->move(public_path('storage/perumahan/').$perusahaan_pengembang, $foto_perumahan[$key]);
                        }else{
                            $val_perum->move(public_path('storage/perumahan/').$perusahaan_pengembang, $foto_perumahan[$key]);
                        }
                    }
                }else{
                    
                    $arr_perumahan = array(
                        'nm_perumahan'           => $nm_perumahan,
                        'id_pengembang'          => $perusahaan_pengembang,
                        'luas_lahan_perumahan'   => $luas_lahan_perumahan,
                        'luas_lahan_efektif'     => $luas_lahan_efektif,
                        'luas_lahan_non_efektif' => $luas_lahan_nonefektif,
                        'jml_unit'               => $jml_unit,
                        'maps'                   => $src_maps,
                        'id_kecamatan'           => $id_kecamatan,
                        'id_desa'                => $id_desa
                    );
                    $upd_perumahan_tanpa_foto = DB::table('tbl_perumahan')->where('id',$id_perumahan)->update($arr_perumahan);
                }

                $arr_prasarana = array(
                    'id_perumahan'         => $id_perumahan,
                    'jaringan_jalan'       => $jaringan_jalan,
                    'jaringan_drainase'    => $jaringan_drainase,
                    'jaringan_sanitasi'    => $jaringan_sanitasi,
                    'jaringan_persampahan' => $jaringan_persampahan,
                    'prasarana_lainnya'    => $prasarana_lainnya,
                );
                $upd_prasarana = DB::table('tbl_perumahan_prasarana')->where('id_perumahan',$id_perumahan)->update($arr_prasarana);

                $arr_sarana = array(
                    'id_perumahan'                    => $id_perumahan,
                    'peribadahan'                     => $peribadahan,
                    'rekreasi_dan_olahraga'           => $rekreasi_dan_olahraga,
                    'pertamanan_dan_rth'              => $pertamanan_dan_rth,
                    'perniagaan'                      => $perniagaan,
                    'fasilitas_sosial'                => $fasilitas_sosial,
                    'pendidikan'                      => $pendidikan,
                    'kesehatan'                       => $kesehatan,
                    'pemakaman'                       => $pemakaman,
                    'parkir'                          => $parkir,
                    'pelayanan_umum_dan_pemerintahan' => $pelayanan_umum_dan_pemerintahan,
                    'sarana_lainnya'                  => $sarana_lainnya,
                );
                $upd_sarana = DB::table('tbl_perumahan_sarana')->where('id_perumahan',$id_perumahan)->update($arr_sarana);

                $arr_utilitas = array(
                    'id_perumahan'              => $id_perumahan,
                    'jaringan_penerangan'       => $jaringan_penerangan,
                    'jaringan_air_bersih'       => $jaringan_air_bersih,
                    'jaringan_listrik'          => $jaringan_listrik,
                    'jaringan_telepon'          => $jaringan_telepon,
                    'jaringan_pemadam_kebakaran'=> $jaringan_pemadam_kebakaran,
                    'gas'                       => $gas,
                    'transportasi'              => $transportasi
                );
                $upd_utilitas = DB::table('tbl_perumahan_utilitas')->where('id_perumahan',$id_perumahan)->update($arr_utilitas);

                return redirect()->route('be.masterdata.perumahan.semua_perumahan')->with('success', 'Data Perumahan : Berhasil di perbarui.');
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'ID Perumahan : tidak ditemukan!');
            }
        }
    }   

    //--------------------------------------------------------------------------
    //  Function Semua Action Hapus Data
    //--------------------------------------------------------------------------
    public function act_hapus_perumahan(Request $request)
    {
        $id_perumahan = $request->id_perumahan;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_perumahan'    => 'Id Perumahan',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_perumahan'    => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_perumahan = DB::table('tbl_perumahan')->where('id',$id_perumahan)->count();
            if ($cek_id_perumahan > 0) {
                $cek_permohonan_psu = DB::table('tbl_psu_permohonan')->where('id_perumahan',$id_perumahan)->count();
                if ($cek_permohonan_psu > 0) {
                    return redirect()->back()->with('failed', 'Data Perumahan : Tidak bisa di hapus, karena sudah melakukan permohonan PSU. Hapus data permohonan PSU terlebih dahulu.');
                }else{
                    $del_prasarana = DB::table('tbl_perumahan_prasarana')
                        ->where('id_perumahan',$id_perumahan)->delete();
                    $del_sarana = DB::table('tbl_perumahan_sarana')
                        ->where('id_perumahan',$id_perumahan)->delete();
                    $del_utilitas = DB::table('tbl_perumahan_utilitas')
                        ->where('id_perumahan',$id_perumahan)->delete();
                    
                    //Hapus Foto Multiple di Folder Storage
                    $get_perumahan = DB::table('tbl_perumahan')->where('id', $id_perumahan)->first();
                    $arr_foto = explode("|",$get_perumahan->foto);
                    foreach ($arr_foto as $key => $val_foto) {
                        unlink(public_path('storage/perumahan/').$get_perumahan->id_pengembang.'/'. $val_foto);
                    }
                    
                    $del_perumahan = DB::table('tbl_perumahan')->where('id',$id_perumahan)->delete();

                    return redirect()->back()->with('success', 'Data Perumahan : Berhasil di hapus.');
                }
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Perumahan : tidak ditemukan!');
            }
        }
    }
}

