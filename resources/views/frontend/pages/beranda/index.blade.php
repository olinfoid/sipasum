@extends('frontend.layouts.app')
@push('meta-seo')
    <title>SIPASUM - Beranda</title>
    <meta content="Halaman Beranda" name="description">
    <meta content="Ilman Hilmi Oriza, S.T" name="author">
    <meta content="Sistem Informasi Prasarana Sarana dan Utilitas Umum" name="keywords">
@endpush
@push('custom-css')
    <!-- Custom CSS -->
    <link rel="stylesheet"
        href="{{ asset('public/assets/fe/lib/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/fe/lib/selectpicker/bootstrap-select.min.css') }}">

    <style>
        .bootstrap-select > .dropdown-toggle, /* dropdown box */
        .bootstrap-select > .dropdown-toggle:focus, /* dropdown :focus */
        .bootstrap-select > .dropdown-toggle:hover /* dropdown :hover */
        {
            background-color: #fff;
            border-color: #ced4da;
        }
    </style>
@endpush
@section('konten')
<!-- Hero Start -->
<div class="container-fluid hero-header">
    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
        <div class="carousel-inner rounded" role="listbox">
            <div class="carousel-item active">
                <video class="img-fluid w-100" autoplay muted loop>
                    <source src="{{ asset('public/assets/fe/img/sipasum_gif.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Hero End -->

<!-- Data Statistik Start -->
<div class="container my-3">
    <div class="col-md-12 mt-3">
        <h1 class="mb-4 display-5 text-primary text-center">DATA STATISTIK</h1>
        <div class="bg-light p-3 rounded">
            <div class="row g-2 justify-content-center">
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="counter bg-white rounded text-center p-2">
                        <i class="fa fa-home text-secondary"></i>
                        <h4>Jumlah <br> Perumahan</h4>
                        <h1>{{$total_perumahan}}</h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="counter bg-white rounded text-center p-2">
                    <i class="fa-solid fa-handshake text-secondary"></i>
                        <h4>Sudah <br> Serah Terima PSU</h4>
                        <h1>{{$total_perumahan_serah_terima_psu}}</h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="counter bg-white rounded text-center p-2">
                    <i class="fa-solid fa-handshake-slash text-secondary"></i>
                        <h4>Belum <br> Serah Terima PSU</h4>
                        <h1>{{$total_perumahan_belum_serah_terima_psu}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data Statistik End -->

<!-- Filter & Search Start -->
<div class="container my-3">
    <div class="row mt-4">
        <!-- Filter Section -->
        <div class="col-md-8 mb-md-0">
            <div class="row">
                <div class="col-md-6">
                    <label for="kd_kecamatan" class="form-label">Kecamatan</label>
                    <select class="selectpicker form-select form-control" id="kd_kecamatan" name="kd_kecamatan" data-live-search="true"
                    data-size="7">
                        <option value="0" selected>== Pilih Kecamatan ==</option>
                        @foreach($kecamatan as $kec)
                            <option value="{{ $kec->kd_kecamatan }}">{{ ucwords(strtolower($kec->nm_kecamatan)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="kd_desa" class="form-label">Desa</label>
                    <select class="selectpicker form-select form-control" id="kd_desa" name="kd_desa" data-live-search="true" data-size="7">
                        <option value="0" selected>== Pilih Desa ==</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="search" class="form-label">Pencarian</label>
            <div class="input-group">
                <input type="text" class="form-control" id="cari-nm_perumahan" name="cari-nm_perumahan" placeholder="Cari Nama Perumahan">
                <button class="btn btn-primary" onclick="cari_nm_perumahan()">Cari</button>
            </div>
        </div>
    </div>
</div>
<!-- Filter & Search End -->

<!-- Tabel Perumahan Start -->
<div class="container my-3">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="daftar_perumahan" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perumahan</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Status</th>
                            <th>Jumlah Unit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($perumahan as $val_perum)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $val_perum->nm_perumahan }}</td>
                            <td class="text-capitalize">{{ucwords(strtolower($val_perum->nm_kecamatan))}}</td>
                            <td class="text-capitalize">{{ucwords(strtolower($val_perum->nm_desa))}}</td>
                            <td>{{ ($val_perum->status_permohonan == 'serah_terima_psu') ? 'Sudah Serah Terima' : 'Belum Serah Terima'}}</td>
                            <td>{{ $val_perum->jml_unit }}</td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#myModal-{{ $val_perum->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Tabel Perumahan End -->

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

@endsection
@push('js')
<script src="{{ asset('public/assets/fe/lib/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/fe/lib/datatables/language/indonesia.js') }}"></script>
<script src="{{ asset('public/assets/fe/lib/selectpicker/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('public/assets/fe/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<script type="text/javascript">

    const EachWord = str => str.replace(/(^\w|\s\w)(\S*)/g, (_,m1,m2) => m1.toUpperCase()+m2.toLowerCase())

    $('#daftar_perumahan').DataTable({
        "language": indonesia
    });
</script>
<script type="text/javascript">
    $('#kd_kecamatan').on('change', function() {
        var kecamatanId = $(this).val();

        $.ajax({
            url: "{{ route('api.kd_wilayah.getDesa_byKd_kecamatan').'/' }}" + kecamatanId,
            type: "GET",
            success: function (data) {
                var status = data.status;

                if (status == '200') {
                    var records = data.records;
                    var desaSelect = $("#kd_desa");

                    desaSelect.empty().trigger('change');
                    desaSelect.selectpicker('destroy');

                    var option = $('<option selected></option>').attr("value", "0").text("== Pilih Desa ==");
                    desaSelect.append(option);

                    $.each(records, function (_key, value) {
                        desaSelect.append($("<option></option>").attr("value", value.kd_desa).text(EachWord(value.nm_desa.toLowerCase())));
                    });

                    desaSelect.selectpicker('val', "0");
                }
            },
        });
    });

    $('#kd_desa').on('change', function() {
        var kd_kecamatan = $('#kd_kecamatan').val();
        var kd_desa = $('#kd_desa').val();

        if (kd_desa !== null) {
            $.ajax({
                url: "{{ route('api.perumahan.getPerumahan_byKd_Kec_Desa').'/' }}" + kd_kecamatan + '/' + kd_desa,
                type: "GET",
                success: function (data) {
                    var status = data.status;
                    
                    if (status == '200') {
                        var records = data.records;
                        generate_tbl_perumahan(records);
                    }
                },
            });
        }
    });
</script>
<script>
    function cari_nm_perumahan(){
        var txt_pencarian = $('#cari-nm_perumahan').val();
        console.log("{{ route('api.perumahan.getPerumahan_byNm_perumahan').'/' }}" + txt_pencarian);
        $.ajax({
            url: "{{ route('api.perumahan.getPerumahan_byNm_perumahan').'/' }}" + txt_pencarian,
            type: "GET",
            success: function (data) {
                var status = data.status;
                
                if (status == '200') {
                    var records = data.records;
                    generate_tbl_perumahan(records);
                }
            },
        });
    }

    function generate_tbl_perumahan(records){

        $('#daftar_perumahan').DataTable().clear().draw();

        var no = 1;
        $.each(records, function(index) {
            var id           = records[index].id;
            var nm_perumahan = records[index].nm_perumahan;
            var nm_kecamatan = EachWord(records[index].nm_kecamatan);
            var nm_desa      = EachWord(records[index].nm_desa);
            var status_psu   = (records[index].status_permohonan == 'serah_terima_psu') ? 'Sudah Serah Terima' : 'Belum Serah Terima';
            var jml_unit     = records[index].jml_unit;
            var aksi = 
                '<button type="button" class="btn btn-secondary" data-bs-toggle="modal"'+
                    'data-bs-target="#myModal-'+id+'">'+
                    '<i class="fas fa-eye"></i>'+
                '</button>';

            var row = $('#daftar_perumahan').DataTable().row.add([
                no, nm_perumahan, nm_kecamatan, nm_desa, status_psu, jml_unit, aksi
            ]).draw().node();
            $(row).find('td').eq(0).addClass('text-center');
            $(row).find('td').eq(1).addClass('text-start');
            $(row).find('td').eq(2).addClass('text-center');
            $(row).find('td').eq(3).addClass('text-center');
            $(row).find('td').eq(4).addClass('text-center');
            $(row).find('td').eq(5).addClass('text-center');
            
            no++;

        });
    }
</script>
@endpush