@extends('layouts.master')

@section('content')
   <table class="table">
        <tr>
            <th>Nomor ST</th>
            <th>Pegawai</th>
            <th>Perihal</th>
            <th>Detail</th>
        </tr>
    
    @foreach($reports as $report)
        <tr>
            <td>{{$report->nomor_st}}</td>
            <td>{{$report->longname}}</td>
            <td>{{$report->perihal}}</td>
            <td><a href="{{route('dashboard.view', [$report->unique_code])}}"><button class="btn btn-md btn-primary"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
        </tr>
    @endforeach
    </table>

    {{$reports->links()}}
@endsection