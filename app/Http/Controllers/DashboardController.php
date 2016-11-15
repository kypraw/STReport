<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Datetime;
use App\Report;
use App\Comment;

class DashboardController extends Controller
{
    public function getDashboard(){
        $perPage = 10;
        $reports = DB::table('reports')
                    ->leftJoin('users', 'reports.user_id', '=', 'users.id')
                    ->orderBy('tanggal_mulai', 'desc')
                    ->select('reports.nomor_st', 'reports.tanggal_mulai', 'reports.tanggal_berakhir','reports.unique_code','reports.perihal', 'users.longname', 'reports.urgency')
                    ->paginate($perPage);

        return view('dashboard.dashboard', ['reports' => $reports, 'perPage' => $perPage]);
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
        
        $comments = DB::table('comments')
                    ->select('longname', 'comment', 'user_id', 'comments.id')
                    ->where('report_unique_code', $report_unique_code)
                    ->leftJoin('users', 'comments.user_id', '=', 'users.id')->get();
        
        return view('dashboard.view', ['report' => $report, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_berakhir' => $tanggal_berakhir, 'comments' => $comments]);
    }

    public function getDashboardSearch(Request $request){
        $word = $request['cari'];
        $urgency = $request['urgency'];
        
        $cari = '%' . $word . '%';

        if($urgency == 0){
            $reports = DB::select('SELECT * FROM reports LEFT JOIN users ON users.id = reports.user_id
                                WHERE (nomor_st LIKE ? OR pegawai LIKE ? or perihal LIKE ? OR daerah LIKE ?)
                                ORDER BY tanggal_mulai DESC, nomor_st DESC',
                                [$cari, $cari, $cari, $cari]);
        } else {
            $reports = DB::select('SELECT * FROM reports LEFT JOIN users ON users.id = reports.user_id
                                WHERE (nomor_st LIKE ? OR pegawai LIKE ? or perihal LIKE ? OR daerah LIKE ?)
                                AND (urgency = ?) ORDER BY tanggal_mulai DESC, nomor_st DESC',
                                [$cari, $cari, $cari, $cari, $urgency]);
        }
        
        $paginate = 10;
        $page = Input::get('page', 1);
        //perpotongan array
        $offset = ($page * $paginate) - $paginate;
        $itemForCurrentPage = array_slice($reports, $offset, $paginate, true);
        $reports = new LengthAwarePaginator($itemForCurrentPage, count($reports), $paginate, $page);
        $reports->setPath('search');

        return view('dashboard.search', ['reports' => $reports, 'perPage' => $paginate, 'urgency' => $urgency]);
    }

    public function postDashboardComment($report_unique_code, Request $request){
        $komentar = $request['komentar'];
        $user = $request->user();

        $comment = New Comment();
        $comment->user_id = $user->id;
        $comment->report_unique_code = $report_unique_code;
        $comment->comment = $komentar;
        $comment->save();

        return redirect()->back();
    }

    public function postCommentDelete($comment_id, Request $request){
        $user = $request->user();
        $comment = Comment::where('id', $comment_id)->first();

        if($user->id !== $comment->user_id){
            return redirect()->route('dashboard');
        }
             
        $comment->delete();
        return redirect()->back();
    }
}
