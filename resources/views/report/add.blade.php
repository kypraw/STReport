@extends('layouts.master')

@section('stylesheet')
    <link rel="stylesheet" href="{{ URL::to('src/css/summernote.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/datepicker.min.css') }}">
@endsection

@section('content')
        <form method="post" action="{{route('report')}}" enctype="multipart/form-data">
        <header><h2>Tambah Laporan</h2></header>
        <div class="form-group col-md-3">
            <label for="nomor_st">Nomor ST</label>
            <input type="text" name="nomor_st" id="nomor_st" class="form-control" placeholder="Nomor ST" required autofocus>
        </div>
        <div class="form-group col-md-3">
            <label for="daerah">Daerah Tujuan</label>
            <input type="text" name="daerah" id="daerah" class="form-control" placeholder="Daerah Tujuan" required>
        </div>
        <div class="form-group col-md-6">
        <label for="waktu">Waktu Pelaksanaan</label>
        <div class="input-daterange input-group" data-provide="datepicker">
            <input type="text" class="input-sm form-control" name="tanggal_mulai" />
            <span class="input-group-addon">s.d.</span>
            <input type="text" class="input-sm form-control" name="tanggal_berakhir" />
        </div>
        </div>
        <div class="form-group col-md-12">
            <label for="perihal">Perihal</label>
            <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Perihal" required>
        </div>
        <div class="form-group col-md-12">
            <label for="laporan">Summary Laporan</label>
            <textarea name="laporan" id="laporan" class="form-control" placeholder="Laporan Anda" rows="10" required></textarea>
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
                height:300
            });

            $('.input-daterange').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
@endsection