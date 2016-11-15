<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public static $rules = [
        'nomor_st' => 'required',
        'daerah' => 'required',
        'tanggal_mulai' => 'required | date_format:d/m/Y',
        'tanggal_berakhir' => 'required | date_format:d/m/Y',
        'pegawai' => 'required',
        'perihal' => 'required',
        'laporan' => 'required',
        'st_upload' => 'mimes:pdf',
        'laporan_upload' => 'mimes:pdf',
        'urgency' => 'required|integer'
    ];
}