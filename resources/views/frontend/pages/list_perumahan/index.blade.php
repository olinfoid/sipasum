@extends('frontend.layouts.app')
@push('meta-seo')
    <title>SIPASUM - List Perumahan</title>
    <meta content="Halaman List Perumahan Kab.Tasikmalaya" name="description">
    <meta content="Ilman Hilmi Oriza, S.T" name="author">
    <meta content="Sistem Informasi Prasarana Sarana dan Utilitas Umum" name="keywords">
@endpush
@push('custom-css')
    <!-- Custom CSS -->
@endpush
@section('konten')
<div class="container my-2 main-content">
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Daftar Perumahan</h1>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                @foreach ($perumahan as $val_perum)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            @php 
                                                $foto = $val_perum->foto;
                                                $arr_foto = explode("|",$foto);
                                            @endphp
                                            <img src="{{asset('public/storage/perumahan/'.$val_perum->id_pengembang.'/'.$arr_foto[0])}}" class="img-fluid w-100 rounded-top" alt="Grapes" style="height: 200px; width: 100%; object-fit: cover;">
                                        </div>  
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h6>{{ $val_perum->nm_perumahan }}</h6>
                                            <p class="small-text">Kecamatan : {{ $val_perum->nm_kecamatan }}</p>
                                            <p class="small-text">Desa : {{ $val_perum->nm_desa }}</p>
                                            <div class="d-flex justify-content-center flex-lg-wrap mt-3">
                                                <button class="btn border border-secondary rounded-pill px-3 text-primary" data-bs-toggle="modal" data-bs-target="#myModal-{{ $val_perum->id }}"> Lihat </Button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>                  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {{ $perumahan->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

        <!-- Modal Detail Start-->
        @foreach ($perumahan as $val_perum)
        <div class="modal fade" id="myModal-{{ $val_perum->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-{{ $val_perum->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel-{{ $val_perum->id }}">Detail Perumahan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    @php 
                                        $foto = $val_perum->foto;
                                        $arr_foto = explode("|",$foto);
                                    @endphp
                                    <img src="{{ asset('public/storage/perumahan/'.$val_perum->id_pengembang.'/'.$arr_foto[0]) }}" alt="Foto Perumahan" class="img-fluid mb-3" style="max-height: 300px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table width="600">
                                        <tr>
                                            <td width="160">Nama Perumahan</td>
                                            <td width="20">:</td>
                                            <td>{{ $val_perum->nm_perumahan }}</td>
                                        </tr>
                                        <tr>
                                            <td width="160">Kecamatan</td>
                                            <td width="20">:</td>
                                            <td>{{ $val_perum->nm_kecamatan }}</td>
                                        </tr>
                                        <tr>
                                            <td width="160">Desa</td>
                                            <td width="20">:</td>
                                            <td>{{ $val_perum->nm_desa }}</td>
                                        </tr>
                                        <tr>
                                            <td width="160">Nama Pengembang</td>
                                            <td width="20">:</td>
                                            <td>{{ $val_perum->nm_perusahaan }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @if($val_perum->status_permohonan == 'serah_terima_psu')
                            <div class="row my-3">
                                <div class="col-12 text-center bg-light p-2">Jenis PSU</div>
                                <div class="col-4 text-center bg-light p-2">Prasarana</div>
                                <div class="col-4 text-center bg-light p-2">Sarana</div>
                                <div class="col-4 text-center bg-light p-2">Utilitas</div>
                            </div>
                            <div class="row my-3">
                                <div class="col-4">
                                    @foreach ($perumahan_prasarana as $prasarana)
                                    @if($prasarana->id_perumahan == $val_perum->id)
                                    <table width="260">
                                        <tr>
                                            <td width="150">Jaringan Jalan</td>
                                            <td width="15">:</td>
                                            <td>{{ $prasarana->jaringan_jalan ? $prasarana->jaringan_jalan . ' m2' : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Jaringan Drainase</td>
                                            <td width="15">:</td>
                                            <td>{{ $prasarana->jaringan_drainase ? $prasarana->jaringan_drainase . ' m2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Jaringan Sanitasi</td>
                                            <td width="15">:</td>
                                            <td>{{ $prasarana->jaringan_sanitasi ?$prasarana->jaringan_sanitasi . ' m2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Jaringan Persampahan</td>
                                            <td width="15">:</td>
                                            <td>{{ $prasarana->jaringan_persampahan ? $prasarana->jaringan_persampahan . ' m2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Prasarana Lainya</td>
                                            <td width="15">:</td>
                                            <td>{{ $prasarana->jaringan_persampahan ? $prasarana->jaringan_persampahan : '-' }}</td>
                                        </tr>
                                    </table>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-4">
                                    @foreach ($perumahan_sarana as $sarana)
                                    @if($sarana->id_perumahan == $val_perum->id)
                                    <table width="270">
                                        <tr>
                                            <td width="180">Peribadatan</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->peribadahan ? $sarana->peribadahan : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Rekreasi & Olahraga</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->rekreasi_dan_olahraga ? $sarana->rekreasi_dan_olahraga . ' m2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Pertamanan & RTH</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->pertamanan_dan_rth ? $sarana->pertamanan_dan_rth . ' m2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Perniagaan</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->perniagaan ? $sarana->perniagaan . ' m2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Fasilitas Sosial</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->fasilitas_sosial ? $sarana->fasilitas_sosial . 'm2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Pendidikan</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->pendidikan ? $sarana->pendidikan : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Kesehatan</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->kesehatan ? $sarana->kesehatan . 'm2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Pemakaman</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->pemakaman ? $sarana->pemakaman . 'm2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Parkir</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->parkir ? $sarana->parkir. 'm2' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Pelayan Umum dan Pemerintahan</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->pelayanan_umum_dan_pemerintahan ? $sarana->pelayanan_umum_dan_pemerintahan : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="180">Sarana Lainnya</td>
                                            <td width="15">:</td>
                                            <td>{{ $sarana->sarana_lainnya ? $sarana->sarana_lainnya : '-' }}</td>
                                        </tr>
                                    </table>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-4">
                                    @foreach ($perumahan_utilitas as $utilitas)
                                    @if($utilitas->id_perumahan == $val_perum->id)
                                    <table width="300">
                                        <tr>
                                            <td width="200">Penerangan</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->jaringan_penerangan) ? $utilitas->jaringan_penerangan : '-'}}</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Air Bersih</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->jaringan_air_bersih) ? $utilitas->jaringan_air_bersih : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Listrik</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->jaringan_listrik == 'tersedia') ? 'Tersedia' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Telepon</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->jaringan_telepon == 'tersedia') ? 'Tersedia' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Pemadam Kebakaran</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->jaringan_pemadam_kebakaran == 'tersedia') ? 'Tersedia' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Gas</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->gas == 'tersedia') ? 'Tersedia' : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Transportasi</td>
                                            <td width="15">:</td>
                                            <td>{{ ($utilitas->transportasi == 'tersedia') ? 'Tersedia' : '-' }}</td>
                                        </tr>
                                    </table>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- Visual separator -->
                            <hr>
                        @endif
                            <div class="row my-3">
                                <div class="col-4 text-center bg-light p-2">Luas Perumahan: <br><strong>{{ $val_perum->luas_lahan_perumahan }} m2</strong></div>
                                <div class="col-4 text-center bg-light p-2">Luas Lahan Non Efektif: <br><strong>{{ $val_perum->luas_lahan_non_efektif }} m2</strong></div>
                                <div class="col-4 text-center bg-light p-2">Luas Lahan Efektif: <br><strong>{{ $val_perum->luas_lahan_efektif }} m2</strong></div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12">
                                    <!-- Embed Google Maps iframe here -->
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $val_perum->maps }}" frameborder="0" style="width: 100%; height: 200px;" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Modal Detail End -->
    </div>
</div>
@endsection
@push('js')
    
@endpush