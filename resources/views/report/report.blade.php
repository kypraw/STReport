@extends('layouts.master')

@section('content')
    <p><a href="{{route('report.add')}}"><button class="btn btn-md btn-primary">Tambah Laporan</button></a></p>

    <table class="table">
        <tr>
            <th>Tanggal Pelaksanaan</th>
            <th>Perihal</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    
    @foreach($reports as $report)
        <tr class="urgency-{{$report->urgency}}">
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
            <td>{{$report->perihal}}</td>
            <td><a href="{{route('report.view', ['report_unique_code' => $report->unique_code])}}"><button class="btn btn-md btn-primary"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
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