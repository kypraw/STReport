@extends('layouts.master')

@section('content')
    <p><a href="{{route('report.add')}}"><button class="btn btn-md btn-primary">Tambah Laporan</button></a></p>

    <table class="table">
        <tr>
            <th>Nomor ST</th>
            <th>Perihal</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    
    @foreach($reports as $report)
        <tr>
            <td>{{$report->nomor_st}}</td>
            <td>{{$report->perihal}}</td>
            <td><a href="{{route('report.edit', ['report_unique_code' => $report->unique_code])}}"><button class="btn btn-md btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a></td>
            <td>
            <form class="delete" action="{{ route('report.delete', ['report_unique_code' => $report->unique_code]) }}" method="post">
                {{csrf_field()}}
                <button class="btn btn-md btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
            </form>
            </td>
        </tr>
    @endforeach
    </table>

    {{$reports->links()}}
@endsection

@section('script')
<script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@endsection