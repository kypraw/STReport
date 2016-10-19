<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Datetime;
use App\Report;

class DashboardController extends Controller
{
    public function getDashboard(){
        $reports = DB::table('reports')
                    ->leftJoin('users', 'reports.user_id', '=', 'users.id')
                    ->orderBy('tanggal_mulai', 'desc')
                    ->select('reports.tanggal_mulai', 'reports.tanggal_berakhir','reports.unique_code','reports.perihal', 'users.longname')
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

    public function getDashboardSearch(Request $request){
        $word = $request['cari'];
        $cari = '%' . $word . '%';

        $reports = DB::select('SELECT * FROM reports LEFT JOIN users ON users.id = reports.user_id
                                WHERE nomor_st LIKE ? OR longname LIKE ? or perihal LIKE ? OR daerah LIKE ? ORDER BY tanggal_mulai DESC, nomor_st DESC', [$cari, $cari, $cari, $cari]);
        
        $paginate = 10;
        $page = Input::get('page', 1);
        //perpotongan array
        $offset = ($page * $paginate) - $paginate;
        $itemForCurrentPage = array_slice($reports, $offset, $paginate, true);
        $reports = new LengthAwarePaginator($itemForCurrentPage, count($reports), $paginate, $page);
        $reports->setPath('search');

        return view('dashboard.search', ['reports' => $reports]);
    }
}
