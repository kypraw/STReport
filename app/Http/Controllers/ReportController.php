<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Datetime;

class ReportController extends Controller
{
    public function getReport(Request $request){
        $user = $request->user();

        $reports = Report::where('user_id', $user->id)->orderBy('nomor_st', 'desc')->paginate(10);
        return view('report.report', ['reports' => $reports]);
    }

    public function getReportAdd(){
        return view('report.add');
    }

    public function postReport(Request $request){
        $nomor_st = $request['nomor_st'];
        $daerah = $request['daerah'];
        $tahun = explode("/", $request['tanggal_mulai'])[2];
        
        $tanggal_mulai = Datetime::createFromFormat('d/m/Y', $request['tanggal_mulai']);
        $tanggal_mulai = $tanggal_mulai->format('Y/m/d');

        $tanggal_berakhir = Datetime::createFromFormat('d/m/Y', $request['tanggal_berakhir']);
        $tanggal_berakhir = $tanggal_berakhir->format('Y/m/d');

        $perihal = $request['perihal'];
        $laporan = $request['laporan'];
        $user = $request->user();

        $report = New Report();
        $report->user_id = $user->id;
        $report->nomor_st = $nomor_st;
        $report->daerah = $daerah;
        $report->tahun = $tahun;
        $report->tanggal_mulai = $tanggal_mulai;
        $report->tanggal_berakhir = $tanggal_berakhir;
        $report->perihal = $perihal;
        $report->laporan = $laporan;
        $report->unique_code = $tahun . '_' . $nomor_st . '_' . $user->username;
        $report->save();

        return redirect()->route('report');
    }

    public function getReportEdit(Request $request, $report_unique_code){
        $user = $request->user();
        $report = Report::where('unique_code', $report_unique_code)->first();
        
        $tanggal_mulai = Datetime::createFromFormat('Y-m-d', $report->tanggal_mulai);
        $tanggal_mulai = $tanggal_mulai->format('d/m/Y');
        
        $tanggal_berakhir = Datetime::createFromFormat('Y-m-d', $report->tanggal_berakhir);
        $tanggal_berakhir = $tanggal_berakhir->format('d/m/Y');

        if($user->id !== $report->user_id){
            return redirect()->route('home');
        }

        return view('report.edit', ['report' => $report, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_berakhir' => $tanggal_berakhir]);
    }

    public function postReportEdit($report_unique_code, Request $request){
        $user = $request->user();
        $nomor_st = $request['nomor_st'];
        $daerah = $request['daerah'];
        $tahun = explode("/", $request['tanggal_mulai'])[2];
        
        $tanggal_mulai = Datetime::createFromFormat('d/m/Y', $request['tanggal_mulai']);
        $tanggal_mulai = $tanggal_mulai->format('Y/m/d');

        $tanggal_berakhir = Datetime::createFromFormat('d/m/Y', $request['tanggal_berakhir']);
        $tanggal_berakhir = $tanggal_berakhir->format('Y/m/d');

        $perihal = $request['perihal'];
        $laporan = $request['laporan'];

        $report = Report::where('unique_code', $report_unique_code)->first();
        
        if($user->id !== $report->user_id){
            return redirect()->route('home');
        }

        $report->nomor_st = $nomor_st;
        $report->daerah = $daerah;
        $report->tahun = $tahun;
        $report->tanggal_mulai = $tanggal_mulai;
        $report->tanggal_berakhir = $tanggal_berakhir;
        $report->perihal = $perihal;
        $report->laporan = $laporan;
        $report->unique_code = $tahun . '_' . $nomor_st . '_' . $user->username;
        $report->update();

        return redirect()->route('report');
    }

    public function postReportDelete(Request $request, $report_unique_code) {
        $user = $request->user();
        $report = Report::where('unique_code', $report_unique_code)->first();

        if($user->id !== $report->user_id){
            return redirect()->route('home');
        }
             
        $report->delete();
        return redirect()->route('report');
    }
}
