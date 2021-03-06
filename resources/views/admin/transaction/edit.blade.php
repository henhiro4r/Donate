@extends('layouts.adminMaster')
@section('content')
    <div class="container-fluid">
        @include('inc.alert')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 font-weight-bold text-primary" style="margin-top: 0.2em;">Finish Transaction</h1>
            </div>
            <div class="card-body">
                <fieldset>
                    <legend>Detail Pendonor</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Nama</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->user->name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Terakhir Donor</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$last ? \Carbon\Carbon::parse($last->timeTransEnd)->format('d F Y') : 'Belum Pernah Donor'}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Donor ke</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->user->ndonor != 0? $trans->user->ndonor + 1 : 1}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Golongan Darah (rhesus)</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->user->goldarah}}({{$trans->user->rhesus}})
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Jenis Kelamin</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->user->gender == 'l' ? 'Laki - laki' : 'Perempuan'}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="text-success">State saat ini</h6>
                        </div>
                        <div class="col-md-9">
                            : @switch($trans->statetrans)
                                @case('1')
                                <span class="text-success">Diterima - Pengisian Form</span>
                                @break
                                @case('3')
                                <span class="text-success">Diterima - Sudah 2 Bulan</span>
                                @break
                                @case('5')
                                <span class="text-success">Diterima - Kondisi tubuh sesuai</span>
                                @break
                                @case('7')
                                <span class="text-success">Diterima - Tensi normal</span>
                                @break
                                @case('9')
                                <span class="text-success">Diterima - HB sesuai</span>
                                @break
                            @endswitch
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Tahapan 1 (Pengisian Kuisioner & Pengecekan Terakhir Donor)</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Pertanyaan 1 (Lama Tidur)</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->q1_jamtidur}} jam
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Pertanyaan 2 (Minum obat dalam 3 hari)</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->q2_obat == '0' ? 'Tidak' : 'Ya'}}
                        </div>
                    </div>
                    <div class="row">
                        @if($trans->user->gender == 'p')
                        <div class="col-md-3">
                            <h6>Pertanyaan 3 (Sedang Mensturasi, Hamil, Menyusui)</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->q3_mens == '0' ? 'Tidak' : 'Ya'}}
                        </div>
                        @else
                            <div class="col-md-12">
                                <h6 class="text-center">Pertanyaan 3 Khusus Perempuan</h6>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Pertanyaan 4 (Sakit Serius)</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->q4_sick}}
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12 text-right">--}}
                            {{--<button type="button" class="btn btn-primary" data-toggle="modal"--}}
                                    {{--data-target="#stage1">Edit Tahapan 1</button>--}}
                            {{--@include('admin.transaction.modal.stage1')--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </fieldset>
                <fieldset>
                    <legend>Tahapan 2 (Pemeriksaan Kondisi Tubuh)</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Berat Badan</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->beratUser}} Kg
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Tinggi Badan</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->tinggiUser}} cm
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Suhu Badan</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->suhuUser}} °C
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6><b>Petugas</b></h6>
                        </div>
                        <div class="col-md-9">
                            : <b>{{$pawal}}</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#stage2" @if($trans->statetrans != 3) disabled @endif>Edit Tahapan 2</button>
                            @include('admin.transaction.modal.stage2')
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Tahapan 3 (Pengecekan Tensi & Denyut Nadi)</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Tekanan Darah (sistole/diastole)</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->tekananA_user ? $trans->tekananA_user : 0}} mmHg / {{$trans->tekananB_user ? $trans->tekananB_user : 0}} mmHg
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Denyut Nadi</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->denyutNadi_user ? $trans->denyutNadi_user : 0}} / menit
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6><b>Petugas</b></h6>
                        </div>
                        <div class="col-md-9">
                            : <b>{{$ptekanan}}</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#stage3" @if($trans->statetrans != 5) disabled @endif>Edit Tahapan 3</button>
                            @include('admin.transaction.modal.stage3')
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Tahapan 4 (Pengecekan HB & Pengecekan Final)</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Nilai Hb</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->nhbTrans ? $trans->nhbTrans : 0}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Nilai Hct</h6>
                        </div>
                        <div class="col-md-9">
                            : {{$trans->nhctTrans ? $trans->nhctTrans : 0}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Macam Donor</h6>
                        </div>
                        <div class="col-md-9">
                            : @if($trans->macDonTrans == 's') Sukarela @elseif($trans->macDonTrans == 'p') Pengganti @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Metode Pengambilan Darah</h6>
                        </div>
                        <div class="col-md-9">
                            : @if($trans->metDonTrans == 'b') Biasa @elseif($trans->metDonTrans == 'a') Aferesis @elseif($trans->metDonTrans == 'au') Autologus @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Hb Metode Cupri Sulfat</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    : Berat Jenis 1.053
                                </div>
                                <div class="col-md-3">
                                    Berat Jenis 1.062
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    @if($trans->hbmcsa == '1') > 12,5 gr % Tenggelam @elseif($trans->hbmcsa == '2') = 12,5 gr % Melayang
                                    @elseif($trans->hbmcsa == '3') < 12,5 gr % Mengapung @endif
                                </div>
                                <div class="col-md-3">
                                    @if($trans->hbmcsa == '1') > 17 gr % Tenggelam @elseif($trans->hbmcsa == '2') = 17 gr % Melayang
                                    @elseif($trans->hbmcsa == '3') < 17 gr % Mengapung @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h6><b>Petugas</b></h6>
                        </div>
                        <div class="col-md-9">
                            : <b>{{$phb}}</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#stage4"  @if($trans->statetrans != 7) disabled @endif>Edit Tahapan 4</button>
                            @include('admin.transaction.modal.stage4')
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Proses Donor</legend>
                    <div class="row">
                        <div class="col-md-3">
                            Ditolak / Diambil Sebanyak
                        </div>
                        <div class="col-md-9">
                            : {{$trans->statetrans == '11' ? $trans->ccDarah : $trans->ccstopTrans}} cc
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Jenis Kantong
                        </div>
                        <div class="col-md-9">
                            : {{ucwords($trans->kantongDarah)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Pengambilan
                        </div>
                        <div class="col-md-9">
                            : @if($trans->pengambilanTrans == 'l') Lancar @elseif($trans->pengambilanTrans == 't') Tidak Lancar
                            @elseif($trans->pengambilanTrans == 's') Stop : {{$trans->ccstopTrans}} cc @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Reaksi Donor
                        </div>
                        <div class="col-md-9">
                            : @if($trans->reaksiDonTrans == 'h') Hematoma @elseif($trans->reaksiDonTrans == 'p') Pusing
                            @elseif($trans->reaksiDonTrans == 'm') Muntah @elseif($trans->reaksiDonTrans == 'l') {{$trans->ketReaksiDonor}} @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            No. Kantong Darah
                        </div>
                        <div class="col-md-9">
                            : {{$trans->noKantongDarah}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#done" @if($trans->statetrans != 9) disabled @endif>Transaksi Selesai</button>
                            @include('admin.transaction.modal.done')
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#cancel">Batalkan Transaksi</button>
                            @include('admin.transaction.modal.cancel')
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
@endsection