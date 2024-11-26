@extends('backend.layouts.app')
@push('be-meta-seo')
    <title>SIPASUM - Semua Perumahan</title>
    <meta content="Halaman Perumahan" name="description">
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
            <h4 class="mb-1">Tambah Perumahan</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2 mb-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('be.masterdata.perumahan.tambah_perumahan') }}">Tambah Perumahan</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{route('be.masterdata.perumahan.act_tambah_perumahan')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
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
            <li class="nav-item">
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
                            <label for="add-perusahaan_pengembang" class="form-label">Perusahaan Pengembang</label>
                            <select id="add-perusahaan_pengembang" name="perusahaan_pengembang" 
                                class="form-control selectpicker" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Pengembang ==</option>
                                @foreach($pengembang as $val_pengembang)
                                    <option value="{{$val_pengembang->id}}" @selected(old('perusahaan_pengembang') == $val_pengembang->id)>{{strtoupper($val_pengembang->nm_perusahaan)}}</option>
                                @endforeach
                            </select>
                            @error('perusahaan_pengembang')
                            <div id="hlp-perusahaan_pengembang" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-nm_perumahan" class="form-label">Nama Perumahan</label>
                            <input type="text" class="form-control" id="add-nm_perumahan" name="nm_perumahan" placeholder="Masukan Nama Perumahan" value="{{old('nm_perumahan')}}" />
                            @error('nm_perumahan')
                            <div id="hlp-nm_perumahan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jml_unit" class="form-label">Jumlah Unit</label>
                            <input type="number" class="form-control" id="add-jml_unit" name="jml_unit" placeholder="Jumlah Unit" value="{{old('jml_unit')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('jml_unit')
                            <div id="hlp-jml_unit" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-kd_kecamatan" class="form-label">Kecamatan</label>
                            <select id="add-kd_kecamatan" name="kd_kecamatan" class="form-control selectpicker" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Kecamatan ==</option>
                                @foreach($kecamatan as $val_kec)
                                    <option value="{{$val_kec->kd_kecamatan}}" @selected(old('kd_kecamatan') == $val_kec->kd_kecamatan)>{{ ucwords(strtolower($val_kec->nm_kecamatan))}}</option>
                                @endforeach
                            </select>
                            @error('kd_kecamatan')
                            <div id="hlp-kd_kecamatan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-kd_desa" class="form-label">Desa</label>
                            <select class="selectpicker form-select form-control" id="add-kd_desa" name="kd_desa" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Desa ==</option>
                            </select>
                            @error('kd_desa')
                            <div id="hlp-kd_desa" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="add-luas_lahan_perumahan" class="form-label">Luas Lahan Perumahan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-luas_lahan_perumahan" name="luas_lahan_perumahan" placeholder="Masukan Luas Lahan Perumahan" value="{{old('luas_lahan_perumahan')}}"
                                pattern="/^\d+(,\d+)*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('luas_lahan_perumahan')
                            <div id="hlp-luas_lahan_perumahan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-luas_lahan_efektif" class="form-label">Luas Lahan Efektif <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-luas_lahan_efektif" name="luas_lahan_efektif" placeholder="Masukan Luas Lahan Efektif" value="{{old('luas_lahan_efektif')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('luas_lahan_efektif')
                            <div id="hlp-luas_lahan_efektif" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-luas_lahan_nonefektif" class="form-label">Luas Lahan Non Efektif <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-luas_lahan_nonefektif" name="luas_lahan_nonefektif" placeholder="Masukan Luas Lahan Non Efektif" value="{{old('luas_lahan_nonefektif')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('luas_lahan_efektif')
                            <div id="hlp-luas_lahan_efektif" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-foto" class="form-label">Foto Perumahan</label>
                            <div class="input-group">
                                <input class="form-control" type="file" 
                                    id="add-foto" name="foto[]" multiple 
                                    value="{{old('foto[]')}}" accept=".jpg,.png"/>
                                <button class="btn btn-outline-primary" type="button" id="btn-lihat_foto" 
                                    data-bs-toggle="modal" data-bs-target="#lihat_foto" disabled="disabled">Lihat
                                </button>
                            </div>
                            @error('foto')
                            <div id="hlp-foto" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-maps_lokasi" class="form-label">Maps Lokasi</label>
                            <div class="input-group">
                                <button class="btn btn-outline-primary" type="button" id="btn-cari_maps" data-bs-toggle="modal"
                                    data-bs-target="#cara-cari_maps">Cari
                                </button>
                                <input class="form-control" type="text" id="add-maps_lokasi" name="maps_lokasi" value="{{old('maps_lokasi')}}" />
                                <button class="btn btn-outline-primary" type="button" id="btn-lihat_maps" 
                                    onclick="tampilkan_maps()" disabled="disabled">Lihat
                                </button>
                            </div>
                            @error('maps_lokasi')
                            <div id="hlp-maps_lokasi" class="form-text error">{{ $message }}</div>
                            @enderror
                            <div id="view-maps_lokasi"></div>
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
                            <label for="add-jaringan_jalan" class="form-label">Luas Jaringan Jalan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-jaringan_jalan" name="jaringan_jalan" placeholder="Masukan Jaringan Jalan"  value="{{old('jaringan_jalan')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('jaringan_jalan')
                            <div id="hlp-jaringan_jalan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_drainase" class="form-label">Luas Jaringan Drainase <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-jaringan_drainase" name="jaringan_drainase" placeholder="Masukan Jaringan Drainase"  value="{{old('jaringan_drainase')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('jaringan_drainase')
                            <div id="hlp-jaringan_drainase" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-prasarana_lainnya" class="form-label">Luas Prasarana Lainnya <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-prasarana_lainnya" name="prasarana_lainnya" placeholder="Masukan Prasarana Lainnya"  value="{{old('prasarana_lainnya')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('prasarana_lainnya')
                            <div id="hlp-prasarana_lainnya" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="add-jaringan_sanitasi" class="form-label">Luas Jaringan Sanitasi <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-jaringan_sanitasi" name="jaringan_sanitasi" placeholder="Masukan Jaringan Sanitasi"  value="{{old('jaringan_sanitasi')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('jaringan_sanitasi')
                            <div id="hlp-jaringan_sanitasi" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_persampahan" class="form-label">Luas Jaringan Persampahan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-jaringan_persampahan" name="jaringan_persampahan" placeholder="Masukan Jaringan Persampahan"  value="{{old('jaringan_persampahan')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('jaringan_persampahan')
                            <div id="hlp-jaringan_persampahan" class="form-text error">{{ $message }}</div>
                            @enderror
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
                            <label for="add-sarana_ibadah" class="form-label">Sarana Ibadah <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_ibadah" name="sarana_ibadah" placeholder="Masukan Sarana Ibadah"  value="{{old('sarana_ibadah')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_ibadah')
                            <div id="hlp-sarana_ibadah" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_rekreasi_olaharaga" class="form-label">Sarana Rekreasi Olaharaga <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_rekreasi_olaharaga" name="sarana_rekreasi_olaharaga" placeholder="Masukan Sarana Rekreasi Olaharaga"  value="{{old('sarana_rekreasi_olaharaga')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_rekreasi_olaharaga')
                            <div id="hlp-sarana_rekreasi_olaharaga" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_pendidikan" class="form-label">Sarana Pendidikan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_pendidikan" name="sarana_pendidikan" placeholder="Masukan Sarana Pendidikan"  value="{{old('sarana_pendidikan')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_pendidikan')
                            <div id="hlp-sarana_pendidikan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_kesehatan" class="form-label">Sarana Kesehatan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_kesehatan" name="sarana_kesehatan" placeholder="Masukan Sarana Kesehatan"  value="{{old('sarana_kesehatan')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_kesehatan')
                            <div id="hlp-sarana_kesehatan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_pemakaman" class="form-label">Sarana Pemakaman <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_pemakaman" name="sarana_pemakaman" placeholder="Masukan Sarana Pemakaman"  value="{{old('sarana_pemakaman')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_pemakaman')
                            <div id="hlp-sarana_pemakaman" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_lainnya" class="form-label">Sarana Lainnya<b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_lainnya" name="sarana_lainnya" placeholder="Masukan Sarana Lainnya"  value="{{old('sarana_lainnya')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_lainnya')
                            <div id="hlp-sarana_lainnya" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="add-sarana_pertamanan_rth" class="form-label">Sarana Pertamanan dan RTH <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_pertamanan_rth" name="sarana_pertamanan_rth" placeholder="Masukan Sarana Pertamanan dan RTH"  value="{{old('sarana_pertamanan_rth')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_pertamanan_rth')
                            <div id="hlp-sarana_pertamanan_rth" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_perniagaan" class="form-label">Sarana Perniagaan/Perbelanjaan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_perniagaan" name="sarana_perniagaan" placeholder="Masukan Sarana Perniagaan"  value="{{old('sarana_perniagaan')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_perniagaan')
                            <div id="hlp-sarana_perniagaan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_fasilitas_sosial" class="form-label">Sarana Fasilitas Sosial <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_fasilitas_sosial" name="sarana_fasilitas_sosial" placeholder="Masukan Sarana Fasilitas Sosial"  value="{{old('sarana_fasilitas_sosial')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_fasilitas_sosial')
                            <div id="hlp-sarana_fasilitas_sosial" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_parkir" class="form-label">Sarana Parkir <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_parkir" name="sarana_parkir" placeholder="Masukan Sarana Parkir"  value="{{old('sarana_parkir')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_parkir')
                            <div id="hlp-sarana_parkir" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-sarana_pelayananumum_pemerintah" class="form-label">Sarana Pelayanan Umum dan Pemerintahan <b style="font-size:12pt;">(㎡)</b></label>
                            <input type="number" class="form-control" id="add-sarana_pelayananumum_pemerintah" name="sarana_pelayananumum_pemerintah" placeholder="Masukan Sarana Pelayanan Umum"  value="{{old('sarana_pelayananumum_pemerintah')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('sarana_pelayananumum_pemerintah')
                            <div id="hlp-sarana_pelayananumum_pemerintah" class="form-text error">{{ $message }}</div>
                            @enderror
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
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="add-jaringan_penerangan" class="form-label">Jaringan Penerangan <b style="font-size:10pt;">(Unit)</b></label>
                            <input type="number" class="form-control" id="add-jaringan_penerangan" name="jaringan_penerangan" placeholder="Masukan Jaringan Penerangan"  value="{{old('jaringan_penerangan')}}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                            @error('jaringan_penerangan')
                            <div id="hlp-jaringan_penerangan" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_air_bersih" class="form-label">Jaringan Air Bersih</label>
                            <select id="add-jaringan_air_bersih" name="jaringan_air_bersih" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Air Bersih ==</option>
                                <option value="pdam" @selected(old('jaringan_air_bersih') == 'pdam')>PDAM</option>
                                <option value="air_tanah" @selected(old('jaringan_air_bersih') == 'air_tanah')>Air Tanah</option>
                            </select>
                            @error('jaringan_air_bersih')
                            <div id="hlp-jaringan_air_bersih" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_listrik" class="form-label">Jaringan Listrik</label>
                            <select id="add-jaringan_listrik" name="jaringan_listrik" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Listrik ==</option>
                                <option value="tersedia" @selected(old('jaringan_listrik') == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected(old('jaringan_listrik') == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                            @error('jaringan_listrik')
                            <div id="hlp-jaringan_listrik" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_transportasi" class="form-label">Jaringan Transportasi</label>
                            <select id="add-jaringan_transportasi" name="jaringan_transportasi" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Transportasi ==</option>
                                <option value="tersedia" @selected(old('jaringan_transportasi') == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected(old('jaringan_transportasi') == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                            @error('jaringan_transportasi')
                            <div id="hlp-jaringan_transportasi" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="add-jaringan_telepon" class="form-label">Jaringan Telepon</label>
                            <select id="add-jaringan_telepon" name="jaringan_telepon" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Telepon ==</option>
                                <option value="tersedia" @selected(old('jaringan_telepon') == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected(old('jaringan_telepon') == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                            @error('jaringan_telepon')
                            <div id="hlp-jaringan_telepon" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_pemadam_kebakaran" class="form-label">Jaringan Pemadam Kebakaran</label>
                            <select id="add-jaringan_pemadam_kebakaran" name="jaringan_pemadam_kebakaran" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Pemadam Kebakaran ==</option>
                                <option value="tersedia" @selected(old('jaringan_pemadam_kebakaran') == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected(old('jaringan_pemadam_kebakaran') == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                            @error('jaringan_pemadam_kebakaran')
                            <div id="hlp-jaringan_pemadam_kebakaran" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="add-jaringan_gas" class="form-label">Jaringan Gas</label>
                            <select id="add-jaringan_gas" name="jaringan_gas" class="form-control selectpicker" data-live-search="false" data-size="7">
                                <option value="0" selected>== Pilih Jaringan Gas ==</option>
                                <option value="tersedia" @selected(old('jaringan_gas') == 'tersedia')>Tersedia</option>
                                <option value="tidak_tersedia" @selected(old('jaringan_gas') == 'tidak_tersedia')>Tidak Tersedia</option>
                            </select>
                            @error('jaringan_gas')
                            <div id="hlp-jaringan_gas" class="form-text error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="alert alert-dark d-flex justify-content-end" role="alert">
                    <button type="submit" class="btn btn-primary">
                        <span class="tf-icons bx bx-save"></span> Simpan
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
                    <div id="carousel-foto_perum" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators" id="carousel-indikator_foto">
      
                        </ol>
                        <div class="carousel-inner" id="carousel-content_foto">

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
    const EachWord = str => str.replace(/(^\w|\s\w)(\S*)/g, (_,m1,m2) => m1.toUpperCase()+m2.toLowerCase());
    $('#tbl_permohonan').DataTable({
        "language": indonesia
    });
</script>
<script type="text/javascript">

    function tampilkan_maps(){
        var maps_lokasi_baru = $('#add-maps_lokasi').val();
        var ex_maps = maps_lokasi_baru.split('"');

        var new_maps = '<iframe src="'+ex_maps[1]+'" class="embed-responsive-item" frameborder="0"'+ 
            'style="width: 100%; height: 200px;" allowfullscreen></iframe>';

        $('#view-maps_lokasi').html(new_maps);
    }

    $('#add-maps_lokasi').on('change', function(){
        var maps_lokasi = $(this).val();

        var cek_string = check_string(maps_lokasi);
        if(cek_string == "true") {
            document.getElementById("btn-lihat_maps").disabled = false;
        }else{
            document.getElementById("btn-lihat_maps").disabled = true;
            $('#view-maps_lokasi').html("");
        }
    });
    
    $('#add-foto').on('change', function(){
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

    $('#add-kd_kecamatan').on('change', function() {
        var kecamatanId = $(this).val();
        get_desa(kecamatanId);
    });

    if ('{{old('kd_kecamatan')}}') {
        var kecamatanId = $('#add-kd_kecamatan').val();
        get_desa(kecamatanId);
    }

    function get_desa(kecamatanId){
        $.ajax({
            url: "{{ route('api.kd_wilayah.getDesa_byKd_kecamatan').'/' }}" + kecamatanId,
            type: "GET",
            success: function (data) {
                var status = data.status;

                if (status == '200') {
                    var records = data.records;
                    var desaSelect = $("#add-kd_desa");

                    desaSelect.empty().trigger('change');
                    desaSelect.selectpicker('destroy');

                    var option = $('<option selected></option>').attr("value", "0").text("== Pilih Desa ==");
                    desaSelect.append(option);

                    $.each(records, function (_key, value) {
                        desaSelect.append($("<option></option>").attr("value", value.kd_desa).text(EachWord(value.nm_desa.toLowerCase())));
                    });

                    if ('{{old('kd_desa')}}') {
                        desaSelect.selectpicker('val', "{{old('kd_desa')}}");
                    }else{
                        desaSelect.selectpicker('val', "0");
                    }
                }
            },
        });
    }
</script>
@endpush
