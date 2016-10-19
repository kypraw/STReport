@extends('layouts.master')

@section('content')
    <p>
    <form action="{{route('dashboard.search')}}" method="get">
    <div class="form-group col-md-3">
        <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari" required>
    </div>
    {{csrf_field()}}
    <button class="btn btn-md btn-primary btn-inline" type="submit">Cari</button>
    </form>
    </p>
   <table class="table">
        <tr>
            <th>Tanggal Pelaksanaan</th>
            <th>Pegawai</th>
            <th>Perihal</th>
            <th>Detail</th>
        </tr>
    
    @foreach($reports as $report)
        <tr>
            <td><?php
                    $tanggal_mulai = Datetime::createFromFormat('Y-m-d', $report->tanggal_mulai);
                    $tanggal_mulai = $tanggal_mulai->format('d/M/Y');
        
                    echo($tanggal_mulai);
                ?>
                s.d
                <?php
                    $tanggal_berakhir = Datetime::createFromFormat('Y-m-d', $report->tanggal_berakhir);
                    $tanggal_berakhir = $tanggal_berakhir->format('d/M/Y');
        
                    echo($tanggal_berakhir);
                ?>
            </td>
            <td>{{$report->longname}}</td>
            <td>{{$report->perihal}}</td>
            <td><a href="{{route('dashboard.view', [$report->unique_code])}}" target="_blank"><button class="btn btn-md btn-primary"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
        </tr>
    @endforeach
    </table>

    {{$reports->links()}}
@endsection