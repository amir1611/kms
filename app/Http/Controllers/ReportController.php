<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;

class ReportController extends Controller
{
    public function uploadReportData(Request $request)
    {
        // Validate the request
        

        // Handle file upload
        try {

            $request->validate([
                'revenue_Ringgit' => 'required|numeric',
                'revenue_Sen' => 'required|numeric',
                'optHours' => 'required|string', // Adjust if it's not a string
                'remark' => 'required|string',
                'monthPicker' => 'required|date_format:Y-m',
                'formFile' => 'required|mimes:pdf|max:10240', // Assuming PDF files, adjust as needed
            ]);
            
            if ($request->hasFile('formFile') && $request->file('formFile')->isValid()) {
                $file = $request->file('formFile');
                $filePath = $file->store('reports', 'public');
            } else {
                // Handle file validation failure
                return redirect()->route('user.reportList');
                return redirect()->back()->withErrors(['formFile' => 'Invalid file.']);
            }
    
            // Create a new Report instance
            $report = new Report([
                'kiosk_id' => 2, // Assuming you have user authentication and a relationship with Kiosk
                'report_month' => $request->input('monthPicker'),
                'report_monthly_revenue' => $request->input('revenue_Ringgit') + ($request->input('revenue_Sen') / 100),
                'report_operating_hour' => $request->input('optHours'),
                'report_remark' => $request->input('remark'),
                'report_pdf' => $filePath,
                'report_status' => 'Pending',
                'report_suggestion' => '',
            ]);
    
            // Save the Report instance
            $report->save();
    
            // Redirect or do anything else you need after saving the report
            return redirect()->route('user.reportList');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }
}
