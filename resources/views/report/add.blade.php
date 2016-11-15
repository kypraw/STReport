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
            <input type="text" name="nomor_st" id="nomor_st" class="form-control" placeholder="E.g 100/IT/2016" required autofocus>
        </div>
        <div class="form-group col-md-3">
            <label for="daerah">Daerah Tujuan</label>
            <input type="text" name="daerah" id="daerah" class="form-control" placeholder="E.g Jakarta" required>
        </div>
        <div class="form-group col-md-6">
        <label for="waktu">Waktu Pelaksanaan</label>
        <div class="input-daterange input-group" data-provide="datepicker">
            <input type="text" class="input-sm form-control" name="tanggal_mulai" />
            <span class="input-group-addon">s.d.</span>
            <input type="text" class="input-sm form-control" name="tanggal_berakhir" />
        </div>
        </div>
        <div class="form-group col-md-6">
            <label for="pegawai">Pegawai yang ada dalam ST</label>
            <textarea name="pegawai" id="pegawai" class="form-control" rows="10" required>
                <ol>
                    <li>Nama pegawai(Silahkan Edit)</li>
                    <li>dst.</li>
                </ol>
            </textarea>
        </div>
        <div class="form-group col-md-12">
            <label for="perihal">Perihal</label>
            <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Perihal" required>
        </div>
        <div class="form-group col-md-12">
            <label for="laporan">Summary Laporan</label>
            <textarea name="laporan" id="laporan" class="form-control" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <div>
                <label for="tindak lanjut">Kebutuhan Tindak Lanjut</label>
            </div>
            <label class="radio-inline"><input type="radio" name="urgency" value="1" required checked>Rendah</label>
            <label class="radio-inline"><input type="radio" name="urgency" value="2">Sedang</label>
            <label class="radio-inline"><input type="radio" name="urgency" value="3">Tinggi</label>
        </div>
        <div class="form-group">
            <label for="st_upload">Upload ST *pdf</label>
            <input type="file" name="st_upload" id="st_upload">
        </div>

        <div class="form-group">
            <label for="laporan_upload">Upload Laporan Formal *pdf</label>
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
            $('#pegawai').summernote({
                height:100
            });

            $('#laporan').summernote({
                height:300
            });

            $('.input-daterange').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
@endsection