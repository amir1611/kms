<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\applications;
use App\Models\Kiosk;
use App\Models\User;


class KioskController extends Controller
{



    public function showApplyKioskForm()
    {
        return view('manageKiosk.manageApplication.ApplyKiosk');
    }




    public function applyKiosk(Request $request)
    {
        try {
            // Validate the form data and file uploads
            $request->validate([
                'business_name' => 'required|string|max:255',
                'business_role' => 'required|string|max:255',
                'business_category' => 'required|string|max:255',
                'business_information' => 'required|string',
                'business_operating_hour' => 'required|string',
                'business_start_date' => 'required|date',
                'ssm_pdf' => 'required|mimes:pdf|max:2048',  // Assuming a maximum file size of 2 MB for PDF files
                'business_proposal_pdf' => 'required|mimes:pdf|max:2048',
            ]);

            // Handle file storage using the store method
            $ssmPdfPath = $request->file('ssm_pdf')->store('pdfs');
            $businessProposalPdfPath = $request->file('business_proposal_pdf')->store('pdfs');

            // Create a new application record
            $application = new applications([
                'user_id' => Auth::id(),
                'business_name' => $request->input('business_name'),
                'business_role' => $request->input('business_role'),
                'business_category' => $request->input('business_category'),
                'business_information' => $request->input('business_information'),
                'business_operating_hour' => $request->input('business_operating_hour'),
                'business_start_date' => $request->input('business_start_date'),
                'ssm_pdf' => $ssmPdfPath,  // Save the file path in the database instead of raw data
                'business_proposal_pdf' => $businessProposalPdfPath,
                'application_status' => 'New',
                'application_comment' => '',
            ]);

            // Save the application
            $application->save();

            return view('manageKiosk.manageApplication.PendingApproval');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }
}
