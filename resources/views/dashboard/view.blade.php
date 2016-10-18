@extends('layouts.master')

@section('content')
    <h3><strong>{{$report->perihal}}</strong></h3>
    <p>Oleh: {{$report->longname}}</p>
    <p>Jabatan: {{$report->jabatan}}</p>
    <p>Nomor ST: {{$report->nomor_st}}</p>
    <p>Daerah: {{$report->daerah}}</p>
    <p>Waktu Pelaksanaan: {{$tanggal_mulai}} s.d {{$tanggal_berakhir}}</p>
    <div>
    <p>Laporan Pelaksanaan:</p>
    <?php echo($report->laporan) ?></div>
@endsection