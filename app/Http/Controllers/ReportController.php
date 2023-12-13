<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use App\Models\Kiosk;

//  @foreach($kiosks as $kiosk)
// <option value="{{ $kiosk->id }}">1</option>
// @endforeach 

class ReportController extends Controller
{
    public function uploadReportData(Request $request)
    {
        try {

            $request->validate([
                'kioskValue' => 'required|numeric',
                'revenue_Ringgit' => 'required|numeric',
                'revenue_Sen' => 'required|numeric',
                'optHours' => 'required|string',
                'remark' => 'required|string',
                'monthPicker' => 'required|date_format:Y-m',
                'formFile' => 'required|mimes:pdf|max:10240',
            ]);

            if ($request->hasFile('formFile') && $request->file('formFile')->isValid()) {
                $file = $request->file('formFile');
                $filePath = $file->store('reports', 'public');
            } else {
                // Handle file validation failure
                return redirect()->route('user.reportList');
                return redirect()->back()->withErrors(['formFile' => 'Invalid file.']);
            }


            $report = new Report([
                'kiosk_id' => $request->input('kioskValue'),
                'report_month' => $request->input('monthPicker'),
                'report_monthly_revenue' => $request->input('revenue_Ringgit') + ($request->input('revenue_Sen') / 100),
                'report_operating_hour' => $request->input('optHours'),
                'report_remark' => $request->input('remark'),
                'report_pdf' => $filePath,
                'report_status' => 'Pending',
                'report_suggestion' => '',
            ]);


            $report->save();


            return redirect()->route('user.reportList');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function showKioskListById()
    {
        $kiosks = Kiosk::where('user_id', auth()->user()->id)->get();
        return view('manageReport.uploadMonthlyReport', [
            'kiosks' => $kiosks
        ]);
    }

    public function viewReportsList()
    {
        // Assuming you have user authentication and want to retrieve reports for the authenticated user
        $userId = auth()->user()->id;

        // Retrieve reports for the authenticated user
        $reports = Report::join('kiosks', 'reports.id', '=', 'kiosks.kiosk_id')
        ->where('kiosks.user_id', $userId)
        ->select(
            'reports.*'
        )->get();

        return view('manageReport.viewMonthlyReportList', ['reports' => $reports]);
    }
}
