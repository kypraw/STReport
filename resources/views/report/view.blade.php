@extends('layouts.master')

@section('content')
    <a href="{{route('report.edit', ['report_unique_code' => $report->unique_code])}}"><button class="btn btn-md btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>
    <h3><strong>{{$report->perihal}}</strong></h3>
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
            <td>Daerah</td>
            <td>{{$report->daerah}}</td>
        </tr>
        <tr>
            <td>Waktu Pelaksanaan</td>
            <td>{{$tanggal_mulai}} s.d {{$tanggal_berakhir}}</td>
        </tr>
        <tr>
            <td>Kebutuhan Tindak Lanjut</td>
            <td>
                @if($report->urgency == 1)
                    Rendah    
                @elseif($report->urgency == 2)
                    Sedang
                @elseif($report->urgency == 3)
                    Tinggi
                @endif
            </td>
        </tr>
        <tr>
            <td>Pegawai yang ada dalam ST</td>
            <td><?php echo($report->pegawai) ?></td>
        </tr>
        <tr>
            <td>Summary Laporan</td>
            <td><?php echo($report->laporan) ?></td>
        </tr>
    </table>
    <h4><strong>Dokumen Pendukung</strong></h4>
    @if($report->st_path)
        <p><a href="/{{$report->st_path}}">a. Lihat ST</a></p>
    @else
        <p>a. Belum Upload ST</p>
    @endif
    @if($report->laporan_path)
        <p><a href="/{{$report->laporan_path}}">b. Lihat Laporan Formal</a></p>
    @else
        <p>b. Belum Upload Laporan Resmi</p>
    @endif
    <br>
    @if(count($comments) > 0)
        <h4>Arahan Pejabat</h4>
        @foreach($comments as $comment)
            <p class="comment_arahan"><strong>{{$comment->longname}}</strong>: {{$comment->comment}}</p>
        @endforeach
    @endif
@endsection