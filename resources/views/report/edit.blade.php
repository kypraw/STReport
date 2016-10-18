@extends('layouts.master')

@section('stylesheet')
    <link rel="stylesheet" href="{{ URL::to('src/css/summernote.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/datepicker.min.css') }}">
@endsection

@section('content')
        <form method="post" action="{{route('report.editpost', ['report_unique_code' => $report->unique_code])}}" enctype="multipart/form-data">
        <header><h2>Edit Laporan</h2></header>
        <div class="form-group">
            <label for="nomor_st">Nomor ST</label>
            <input type="text" name="nomor_st" id="nomor_st" class="form-control" value="{{$report->nomor_st}}" required autofocus>
        </div>
        <div class="form-group">
            <label for="daerah">Daerah Tujuan</label>
            <input type="text" name="daerah" id="daerah" class="form-control" value="{{$report->daerah}}" required>
        </div>
        <label for="waktu">Waktu Pelaksanaan</label>
        <div class="input-daterange input-group">
            <input type="text" class="input-sm form-control" name="tanggal_mulai" value="{{$tanggal_mulai}}" />
            <span class="input-group-addon">s.d.</span>
            <input type="text" class="input-sm form-control" name="tanggal_berakhir" value="{{$tanggal_berakhir}}" />
        </div>
        <div class="form-group">
            <label for="perihal">Perihal</label>
            <input type="text" name="perihal" id="perihal" class="form-control" value="{{$report->perihal}}" required>
        </div>
        <div class="form-group">
            <label for="laporan">Laporan</label>
            <textarea name="laporan" id="laporan" class="form-control" rows="10" required>{{$report->laporan}}</textarea>
        </div>
        <div class="form-group">
            <label for="st_upload">Upload ST (jika ada) *pdf</label>
            <input type="file" name="st_upload" id="st_upload">
        </div>
        <div class="form-group">
            <label for="laporan_upload">Upload Laporan Formal (jika ada) *pdf</label>
            <input type="file" name="laporan_upload" id="laporan_upload">
        </div>
        {{csrf_field()}}
        <button class="btn btn-md btn-primary" type="submit">Simpan</button>
      </form>
</div>
@endsection

@section('script')
    <script type="text/javascript" src=" {{ URL::to('src/js/summernote.min.js') }} "></script>
    <script type="text/javascript" src=" {{ URL::to('src/js/datepicker.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#laporan').summernote({
                height:300,
            });
            $('.input-daterange').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
@endsection