@extends('backend.layouts.app')
@push('be-meta-seo')
    <title>SIPASUM - Edit Perumahan</title>
    <meta content="Halaman Edit Perumahan" name="description">
    <meta content="Ilman Hilmi Oriza, S.T" name="author">
    <meta content="Sistem Informasi Prasarana Sarana dan Utilitas Umum" name="keywords">
@endpush
@push('be-custom-css')
    <!-- Custom CSS -->
    <link rel="stylesheet"
        href="{{ asset('public/assets/be/libs/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
    
@endpush
@section('be.konten')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Breadcrum -->
    <div class="d-flex mb-3">
        <div class="p-2 flex-shrink-1 align-content-center">
            <a href="{{route('be.masterdata.perumahan.semua_perumahan')}}"><i class='bx bx-arrow-back bx-md'></i></a>
        </div>
        <div class="p-2 w-100">
            <h4 class="mb-1">Edit Perumahan</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2 mb-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('be.masterdata.perumahan.edit_perumahan').'/'.$id_perumahan }}">Edit Perumahan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{route('be.masterdata.perumahan.act_edit_perumahan')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" id="edt-id_perumahan" name="id_perumahan" value="{{$id_perumahan}}"/>
    <div class="nav-align-top">
        <ul class="nav nav-pills flex-column flex-md-row mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-perumahan"
                    aria-controls="navs-perumahan"
                    aria-selected="true">
                    <i class='bx bx-home-circle bx-sm'></i> Perumahan
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-prasarana"
                    aria-controls="navs-prasarana"
                    aria-selected="true">
                    <i class='bx bx-recycle bx-sm'></i> Prasarana
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-sarana"
                    aria-controls="navs-sarana"
                    aria-selected="true">
                    <i class='bx bxs-building bx-sm'></i> Sarana
                </button>
            </li>
            <li class="nav-item justify-content-end">
                <button type="button" class="nav-link" role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-utilitas"
                    aria-controls="navs-utilitas"
                    aria-selected="true">
                    <i class='bx bx-traffic-cone bx-sm'></i> Utilitas
                </button>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane fade show active p-0" id="navs-perumahan" role="tabpanel">
                <div class="alert alert-dark alert-dismissible" role="alert">
                    Silahkan Lengkapi Data Perumahan Anda dengan Benar!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-perusahaan_pengembang" class="form-label">Perusahaan Pengembang</label>
                            <select id="edt-perusahaan_pengembang" name="perusahaan_pengembang" class="form-control selectpicker" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Pengembang ==</option>
                                @foreach($pengembang as $val_pengembang)
                                    <option value="{{$val_pengembang->id}}" {{($perumahan->id_pengembang == $val_pengembang->id) ? 'selected' : ''}}>{{strtoupper($val_pengembang->nm_perusahaan)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edt-nm_perumahan" class="form-label">Nama Perumahan</label>
                            <input type="text" class="form-control" id="edt-nm_perumahan" name="nm_perumahan" placeholder="Masukan Nama Perumahan" value="{{$perumahan->nm_perumahan}}" />
                        </div>
                        <div class="mb-3">
                            <label for="edt-jml_unit" class="form-label">Jumlah Unit</label>
                            <input type="number" class="form-control" id="edt-jml_unit" name="jml_unit" placeholder="Jumlah Unit" value="{{$perumahan->jml_unit}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-kd_kecamatan" class="form-label">Kecamatan</label>
                            <select id="edt-kd_kecamatan" name="kd_kecamatan" class="form-control selectpicker" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Kecamatan ==</option>
                                @foreach($kecamatan as $val_kec)
                                    <option value="{{$val_kec->kd_kecamatan}}" @selected($perumahan->kd_kecamatan == $val_kec->kd_kecamatan)>{{ ucwords(strtolower($val_kec->nm_kecamatan))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edt-kd_desa" class="form-label">Desa</label>
                            <select class="selectpicker form-select form-control" id="edt-kd_desa" name="kd_desa" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Desa ==</option>
                                @foreach($desa as $val_desa)
                                    <option value="{{$val_desa->kd_desa}}" @selected($perumahan->kd_desa == $val_desa->kd_desa)>{{ ucwords(strtolower($val_desa->nm_desa))}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-luas_lahan_perumahan" class="form-label">Luas Lahan Perumahan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-luas_lahan_perumahan" name="luas_lahan_perumahan" placeholder="Masukan Luas Lahan Perumahan" value="{{$perumahan->luas_lahan_perumahan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-luas_lahan_efektif" class="form-label">Luas Lahan Efektif <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-luas_lahan_efektif" name="luas_lahan_efektif" placeholder="Masukan Luas Lahan Efektif" value="{{$perumahan->luas_lahan_efektif}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-luas_lahan_nonefektif" class="form-label">Luas Lahan Non Efektif <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-luas_lahan_nonefektif" name="luas_lahan_nonefektif" placeholder="Masukan Luas Lahan Non Efektif" value="{{$perumahan->luas_lahan_non_efektif}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-foto" class="form-label">Foto Perumahan</label>
                            <div class="input-group">
                                <input class="form-control" type="file" 
                                    id="edt-foto" name="foto[]" multiple accept=".jpg,.png"/>
                                <button class="btn btn-outline-primary" type="button" id="btn-lihat_foto" 
                                    data-bs-toggle="modal" data-bs-target="#lihat_foto">Lihat
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            @php 
                                $maps_lokasi = '<iframe src="'.$perumahan->maps.'" class="embed-responsive-item" frameborder="0" style="width: 100%; height: 200px;" allowfullscreen></iframe>';
                            @endphp
                            <label for="edt-maps_lokasi" class="form-label">Maps Lokasi</label>
                            <div class="input-group">
                                <button class="btn btn-outline-primary" type="button" id="btn-cari_maps" data-bs-toggle="modal"
                                    data-bs-target="#cara-cari_maps">Cari
                                </button>
                                <input class="form-control" type="text" id="edt-maps_lokasi" name="maps_lokasi" value="{{$maps_lokasi}}" />
                                <button class="btn btn-outline-primary" type="button" id="btn-lihat_maps" 
                                    onclick="tampilkan_maps()">Lihat
                                </button>
                            </div>
                            <div id="view-maps_lokasi">
                                {!! $maps_lokasi !!}
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="tab-pane fade" id="navs-prasarana" role="tabpanel">
                <div class="alert alert-dark alert-dismissible" role="alert">
                    Prasarana adalah kelengkapan dasar fisik lingkungan hunian yang memenuhi standar tertentu untuk kebutuhan bertempat tinggal yang layak, sehat, aman, dan nyaman.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-jaringan_jalan" class="form-label">Luas Jaringan Jalan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-jaringan_jalan" name="jaringan_jalan" placeholder="Masukan Jaringan Jalan"  value="{{$prasarana->jaringan_jalan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_drainase" class="form-label">Luas Jaringan Drainase <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-jaringan_drainase" name="jaringan_drainase" placeholder="Masukan Jaringan Drainase"  value="{{$prasarana->jaringan_drainase}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-prasarana_lainnya" class="form-label">Luas Prasarana Lainnya <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="text" class="form-control" id="edt-prasarana_lainnya" name="prasarana_lainnya" placeholder="Masukan Prasarana Lainnya"  value="{{$prasarana->prasarana_lainnya}}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-jaringan_sanitasi" class="form-label">Luas Jaringan Sanitasi <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-jaringan_sanitasi" name="jaringan_sanitasi" placeholder="Masukan Jaringan Sanitasi"  value="{{$prasarana->jaringan_sanitasi}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_persampahan" class="form-label">Luas Jaringan Persampahan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-jaringan_persampahan" name="jaringan_persampahan" placeholder="Masukan Jaringan Persampahan"  value="{{$prasarana->jaringan_persampahan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-sarana" role="tabpanel">
                <div class="alert alert-dark alert-dismissible" role="alert">
                    Sarana adalah fasilitas dalam lingkungan hunian yang berfungsi untuk mendukung penyelenggaraan dan pengembangan kehidupan sosial, budaya, dan ekonomi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-sarana_ibadah" class="form-label">Sarana Ibadah <b style="font-size:12pt;">(㎡/Unit)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_ibadah" name="sarana_ibadah" placeholder="Masukan Sarana Ibadah"  value="{{$sarana->peribadahan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_rekreasi_olaharaga" class="form-label">Sarana Rekreasi Olaharaga <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_rekreasi_olaharaga" name="sarana_rekreasi_olaharaga" placeholder="Masukan Sarana Rekreasi Olaharaga"  value="{{$sarana->rekreasi_dan_olahraga}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_pendidikan" class="form-label">Sarana Pendidikan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_pendidikan" name="sarana_pendidikan" placeholder="Masukan Sarana Pendidikan"  value="{{$sarana->pendidikan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_kesehatan" class="form-label">Sarana Kesehatan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_kesehatan" name="sarana_kesehatan" placeholder="Masukan Sarana Kesehatan"  value="{{$sarana->kesehatan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_pemakaman" class="form-label">Sarana Pemakaman <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_pemakaman" name="sarana_pemakaman" placeholder="Masukan Sarana Pemakaman"  value="{{$sarana->pemakaman}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_lainnya" class="form-label">Sarana Lainnya<b style="font-size:12pt;">(㎡)</b></label>
                            <input type="text" class="form-control" id="edt-sarana_lainnya" name="sarana_lainnya" placeholder="Masukan Sarana Lainnya"  value="{{$sarana->sarana_lainnya}}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-sarana_pertamanan_rth" class="form-label">Sarana Pertamanan dan RTH <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_pertamanan_rth" name="sarana_pertamanan_rth" placeholder="Masukan Sarana Pertamanan dan RTH"  value="{{$sarana->pertamanan_dan_rth}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_perniagaan" class="form-label">Sarana Perniagaan/Perbelanjaan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_perniagaan" name="sarana_perniagaan" placeholder="Masukan Sarana Perniagaan"  value="{{$sarana->perniagaan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_fasilitas_sosial" class="form-label">Sarana Fasilitas Sosial <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_fasilitas_sosial" name="sarana_fasilitas_sosial" placeholder="Masukan Sarana Fasilitas Sosial"  value="{{$sarana->fasilitas_sosial}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_parkir" class="form-label">Sarana Parkir <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_parkir" name="sarana_parkir" placeholder="Masukan Sarana Parkir"  value="{{$sarana->parkir}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-sarana_pelayananumum_pemerintah" class="form-label">Sarana Pelayanan Umum dan Pemerintahan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="edt-sarana_pelayananumum_pemerintah" name="sarana_pelayananumum_pemerintah" placeholder="Masukan Sarana Pelayanan Umum"  value="{{$sarana->pelayanan_umum_dan_pemerintahan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-utilitas" role="tabpanel">
                <div class="alert alert-dark alert-dismissible" role="alert">
                    Utilitas umum adalah kelengkapan penunjang untuk pelayanan lingkungan hunian.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="row">
                    @php
                        if($utilitas == null){
                            $jaringan_penerangan = "0";
                            $jaringan_air_bersih = "0";
                            $jaringan_listrik = "0";
                            $jaringan_telepon = "0";
                            $jaringan_pemadam_kebakaran = "0";
                            $gas = "0";
                            $transportasi = "0";
                        }else{
                            $jaringan_penerangan = $utilitas->jaringan_penerangan;
                            $jaringan_air_bersih = $utilitas->jaringan_air_bersih;
                            $jaringan_listrik    = $utilitas->jaringan_listrik;
                            $jaringan_telepon    = $utilitas->jaringan_telepon;
                            $jaringan_pemadam_kebakaran = $utilitas->jaringan_pemadam_kebakaran;
                            $gas                 = $utilitas->gas;
                            $transportasi        = $utilitas->transportasi;
                        }
                    @endphp
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-jaringan_penerangan" class="form-label">Jaringan Penerangan <b style="font-size:10pt;">(Unit)</b></label>
                            <input type="number" class="form-control" id="edt-jaringan_penerangan" name="jaringan_penerangan" placeholder="Masukan Jaringan Penerangan"  value="{{$jaringan_penerangan}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_air_bersih" class="form-label">Jaringan Air Bersih</label>
                            <select id="edt-jaringan_air_bersih" name="jaringan_air_bersih" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Air Bersih ==</option>
                                <option value="pdam" @selected($jaringan_air_bersih == 'pdam')>PDAM</option>
                                <option value="air_tanah" @selected($jaringan_air_bersih == 'air_tanah')>Air Tanah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_listrik" class="form-label">Jaringan Listrik</label>
                            <select id="edt-jaringan_listrik" name="jaringan_listrik" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Listrik ==</option>
                                <option value="tersedia" @selected($jaringan_listrik == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected($jaringan_listrik == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_transportasi" class="form-label">Jaringan Transportasi</label>
                            <select id="edt-jaringan_transportasi" name="jaringan_transportasi" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Transportasi ==</option>
                                <option value="tersedia" @selected($transportasi == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected($transportasi == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="edt-jaringan_telepon" class="form-label">Jaringan Telepon</label>
                            <select id="edt-jaringan_telepon" name="jaringan_telepon" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Telepon ==</option>
                                <option value="tersedia" @selected($jaringan_telepon == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected($jaringan_telepon == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_pemadam_kebakaran" class="form-label">Jaringan Pemadam Kebakaran</label>
                            <select id="edt-jaringan_pemadam_kebakaran" name="jaringan_pemadam_kebakaran" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Pemadam Kebakaran ==</option>
                                <option value="tersedia" @selected($jaringan_pemadam_kebakaran == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected($jaringan_pemadam_kebakaran == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edt-jaringan_gas" class="form-label">Jaringan Gas</label>
                            <select id="edt-jaringan_gas" name="jaringan_gas" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Gas ==</option>
                                <option value="tersedia" @selected($gas == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected($gas == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="alert alert-dark d-flex justify-content-end" role="alert">
                    <button type="submit" class="btn btn-primary">
                        <span class="tf-icons bx bx-save"></span> Update
                    </button> 
                </div>
            </div>
        </div>
    </div>
    </form>
    
    <!-- Modal Lihat Foto Perumahan-->
    <div class="modal fade" id="lihat_foto" aria-labelledby="lbl-lihat_foto" 
        tabindex="-1" style="display: none" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-lihat_foto">Foto Perumahan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php 
                        $path_foto = asset('public/storage/perumahan/').'/'.$perumahan->id_pengembang;
                        $foto = $perumahan->foto;
                        $arr_foto = explode('|',$foto);
                        $foto_ke = 0;
                    @endphp
                    <div id="carousel-foto_perum" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators" id="carousel-indikator_foto">
                            @foreach($arr_foto as $k_foto => $v_foto)
                            @if($k_foto == 0)
                            <li data-bs-target="#carousel-foto_perum" data-bs-slide-to="{{$k_foto}}" class="active"></li>
                            @else
                            <li data-bs-target="#carousel-foto_perum" data-bs-slide-to="{{$k_foto}}"></li>
                            @endif
                            
                            @endforeach
                        </ol>
                        <div class="carousel-inner" id="carousel-content_foto">
                            @foreach($arr_foto as $key_foto => $val_foto)
                            @php $foto_ke += 1; @endphp
                            <div class="carousel-item {{$key_foto == 0 ? 'active' : ''}}">
                                <img class="d-block w-100" src="{{$path_foto.'/'.$val_foto}}" height="400" alt="Gambar {{$foto_ke}}" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>{{'Gambar '.$foto_ke}}</h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel-foto_perum" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-foto_perum" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cek Maps-->
    <div class="modal fade" id="cara-cari_maps" aria-labelledby="lbl-cari_maps" 
        tabindex="-1" style="display: none" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-cari_maps">Cara dapatkan Kode MAPS </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('public/storage/embedmaps/langkah1.jpg')}}" class="w-100" height="400"/>
                    <div class="mt-3">1. Buka Website 
                        <a href="https://www.google.co.id/maps" target="_blank">Google Maps</a></br>
                        2. Cari lokasi Perumahan di kolom pencarian, pastikan titik koordinat sudah sesuai.</br>
                        3. Klik Tombol Bagikan
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#cara-cari_maps2" data-bs-toggle="modal" data-bs-dismiss="modal">
                        Selanjutnya
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2-->
    <div class="modal fade" id="cara-cari_maps2" 
        aria-hidden="true" aria-labelledby="lbl-cari_maps2" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-cari_maps2">Cara dapatkan Kode MAPS </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('public/storage/embedmaps/langkah2.jpg')}}" class="w-100" height="400"/>
                    <div class="mt-3">4. Klik Tombol Sematkan Peta</br>
                        5. Klik Tombol Salin HTML</br>
                        6. Paste di form Input yang sudah tersedia.
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" 
                        data-bs-target="#cara-cari_maps" data-bs-toggle="modal" data-bs-dismiss="modal">
                        Sebelumnya
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('backend.pages.toast')
</div>
@endsection
@push('be-js')
{!! Toastr::message() !!}
<!-- Vendors JS -->
<script src="{{ asset('public/assets/be/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/be/libs/datatables/language/indonesia.js') }}"></script>
<script src="{{ asset('public/assets/be/libs/selectpicker/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('public/assets/be/js/pages/all_function.js') }}"></script>

<script type="text/javascript">

    $('#tbl_permohonan').DataTable({
        "language": indonesia
    });
</script>
<script>
    function tampilkan_maps(){
        var maps_lokasi_baru = $('#edt-maps_lokasi').val();
        var ex_maps = maps_lokasi_baru.split('"');

        var new_maps = '<iframe src="'+ex_maps[1]+'" class="embed-responsive-item" frameborder="0"'+ 
            'style="width: 100%; height: 200px;" allowfullscreen></iframe>';

        $('#view-maps_lokasi').html(new_maps);
    }

    $('#edt-maps_lokasi').on('change', function(){
        var maps_lokasi = $(this).val();

        var cek_string = check_string(maps_lokasi);
        if(cek_string == "true") {
            document.getElementById("btn-lihat_maps").disabled = false;
        }else{
            document.getElementById("btn-lihat_maps").disabled = true;
            $('#view-maps_lokasi').html("");
        }
    });

    $('#edt-foto').on('change', function(){
        var jml_foto = $(this)[0].files.length;
        if (jml_foto > 0) {
            document.getElementById("btn-lihat_foto").disabled = false;

            var content_foto = "";
            var indikator_foto = "";
            let ke = 0;
            for (var index = 0; index < jml_foto; index++) {
                var new_path = window.URL.createObjectURL(this.files[index]);
                var carousel_active = "";
                var indikator_active = "";
                
                if (index == 0) {
                    carousel_active = "active";
                    indikator_active = "class='active'";
                }
                ke += 1;
                indikator_foto += 
                    '<li data-bs-target="#carousel-foto_perum" data-bs-slide-to="'+index+'"'+
                    indikator_active+'></li>';
                content_foto += 
                    '<div class="carousel-item '+carousel_active+'">'+
                        '<img class="d-block w-100" src="'+new_path+'" height="400" alt="Gambar '+ke+'" />'+
                        '<div class="carousel-caption d-none d-md-block">'+
                            '<h3>Gambar '+ke+'</h3>'+
                        '</div>'+
                    '</div>';
            }
            $('#carousel-indikator_foto').html(indikator_foto);
            $('#carousel-content_foto').html(content_foto);

        }else{
            document.getElementById("btn-lihat_foto").disabled = true;
        }
    });
</script>
@endpush
