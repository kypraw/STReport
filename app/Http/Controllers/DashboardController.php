<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datetime;
use App\Report;

class DashboardController extends Controller
{
    public function getDashboard(){
        $reports = DB::table('reports')
                    ->leftJoin('users', 'reports.user_id', '=', 'users.id')
                    ->orderBy('reports.nomor_st', 'desc')
                    ->select('reports.unique_code', 'reports.nomor_st' ,'reports.perihal', 'users.longname')
                    ->paginate(10);
                    

        return view('dashboard.dashboard', ['reports' => $reports]);
    }

    public function getReport($report_unique_code){
        $report = DB::table('reports')
                    ->where('reports.unique_code', $report_unique_code)
                    ->leftJoin('users', 'reports.user_id', '=', 'users.id')
                    ->first();

        $tanggal_mulai = Datetime::createFromFormat('Y-m-d', $report->tanggal_mulai);
        $tanggal_mulai = $tanggal_mulai->format('d/M/Y');
        
        $tanggal_berakhir = Datetime::createFromFormat('Y-m-d', $report->tanggal_berakhir);
        $tanggal_berakhir = $tanggal_berakhir->format('d/M/Y');

        return view('dashboard.view', ['report' => $report, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_berakhir' => $tanggal_berakhir]);
    }
}
