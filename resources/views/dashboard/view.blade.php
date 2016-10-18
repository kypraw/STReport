@extends('layouts.master')

@section('content')
    <h3><strong>{{$report->perihal}}</strong></h3>
    @if($report->st_path)
        <p><a href="/{{$report->st_path}}">Lihat ST</a></p>
    @endif
    @if($report->laporan_path)
        <p><a href="/{{$report->laporan_path}}">Lihat Laporan Formal</a></p>
    @endif
    <table class="table">
        <tr>
            <th>Title</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Oleh</td>
            <td>{{$report->longname}}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>{{$report->jabatan_now}}</td>
        </tr>
        <tr>
            <td>Nomor ST</td>
            <td>{{$report->nomor_st}}</td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>{{$report->tahun}}</td>
        </tr>
        <tr>
            <td>Daerah</td>
            <td>{{$report->daerah}}</td>
        </tr>
        <tr>
            <td>Waktu Pelaksanaan</td>
            <td>{{$tanggal_mulai}} s.d {{$tanggal_berakhir}}</td>
        </tr>
        <tr>
            <td>Laporan Pelaksanaan</td>
            <td><?php echo($report->laporan) ?></td>
        </tr>
    </table>
@endsection