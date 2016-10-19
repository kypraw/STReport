<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Datetime;

class ReportController extends Controller
{
    public function getReport(Request $request){
        $user = $request->user();

        $reports = Report::where('user_id', $user->id)->orderBy('tahun', 'desc')->orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('report.report', ['reports' => $reports]);
    }

    public function getReportAdd(){
        return view('report.add');
    }

    public function postReport(Request $request){
        $this->validate($request, Report::$rules);
        $user = $request->user();
        $nomor_st = $request['nomor_st'];
        $daerah = $request['daerah'];
        $nomor_st_tahun = explode("/", $request['nomor_st']);
        $tahun = $nomor_st_tahun[count($nomor_st_tahun) - 1];
        
        $nomor_st_code = implode('_', $nomor_st_tahun);

        $tanggal_mulai = Datetime::createFromFormat('d/m/Y', $request['tanggal_mulai']);
        $tanggal_mulai = $tanggal_mulai->format('Y/m/d');

        $tanggal_berakhir = Datetime::createFromFormat('d/m/Y', $request['tanggal_berakhir']);
        $tanggal_berakhir = $tanggal_berakhir->format('Y/m/d');

        $perihal = $request['perihal'];
        $laporan = $request['laporan'];
        
        $st_upload = $request->file('st_upload');
        $laporan_upload = $request->file('laporan_upload');

        $unique_code = $nomor_st_code . '_' . $user->username;
        $st_code = $unique_code . '.pdf';
        $laporan_code = $unique_code . '.pdf';

        if($st_upload){
            $st_path = $st_upload->storeAs('surat_tugas/' . $tahun, $st_code, 'uploads');
        }

        if($laporan_upload){
            $laporan_path = $laporan_upload->storeAs('laporan/'. $tahun, $laporan_code, 'uploads');
        }
        
        $report = New Report();
        $report->user_id = $user->id;
        $report->jabatan_now = $user->jabatan;
        $report->nomor_st = $nomor_st;
        $report->daerah = $daerah;
        $report->tahun = $tahun;
        $report->tanggal_mulai = $tanggal_mulai;
        $report->tanggal_berakhir = $tanggal_berakhir;
        $report->perihal = $perihal;
        $report->laporan = $laporan;
        $report->unique_code = $unique_code;
        if($st_upload){
            $report->st_path = $st_path;
        }
        if($laporan_upload){
            $report->laporan_path = $laporan_path;
        }
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
        $this->validate($request, Report::$rules);
        $user = $request->user();
        $nomor_st = $request['nomor_st'];
        $daerah = $request['daerah'];
        $nomor_st_tahun = explode("/", $request['nomor_st']);
        $tahun = $nomor_st_tahun[count($nomor_st_tahun) - 1];
        
        $nomor_st_code = implode('_', $nomor_st_tahun);
        
        $tanggal_mulai = Datetime::createFromFormat('d/m/Y', $request['tanggal_mulai']);
        $tanggal_mulai = $tanggal_mulai->format('Y/m/d');

        $tanggal_berakhir = Datetime::createFromFormat('d/m/Y', $request['tanggal_berakhir']);
        $tanggal_berakhir = $tanggal_berakhir->format('Y/m/d');

        $perihal = $request['perihal'];
        $laporan = $request['laporan'];
        $st_upload = $request->file('st_upload');
        $laporan_upload = $request->file('laporan_upload');
        
        $unique_code = $nomor_st_code . '_' . $user->username;
        $st_code = $unique_code . '.pdf';
        $laporan_code = $unique_code . '.pdf';
        if($st_upload){
            $st_path = $st_upload->storeAs('surat_tugas/'. $tahun, $st_code, 'uploads');    
        }

        if($laporan_upload){
            $laporan_path = $laporan_upload->storeAs('laporan/'. $tahun, $laporan_code, 'uploads');
        }

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
        $report->unique_code = $unique_code;
        if($st_upload){
            $report->st_path = $st_path;
        }
        if($laporan_upload){
            $report->laporan_path = $laporan_path;
        }
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
