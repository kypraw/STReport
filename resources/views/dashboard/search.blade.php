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
            <th>Tahun</th>
            <th>Nomor ST</th>
            <th>Pegawai</th>
            <th>Perihal</th>
            <th>Detail</th>
        </tr>
    
    @foreach($reports as $report)
        <tr>
            <td>{{$report->tahun}}</td>
            <td>{{$report->nomor_st}}</td>
            <td>{{$report->longname}}</td>
            <td>{{$report->perihal}}</td>
            <td><a href="{{route('dashboard.view', [$report->unique_code])}}" target="_blank"><button class="btn btn-md btn-primary"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
        </tr>
    @endforeach
    </table>

    {{$reports->appends(Request::only('cari'))->links()}}
@endsection