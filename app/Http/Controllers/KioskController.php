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

    public function viewKioskApplication(Request $request)
    {
        // Fetch kiosk applications data from the applications table and related user data
        $query = applications::join('users', 'applications.user_id', '=', 'users.id')
            ->select(
                'applications.application_id',
                'users.name',
                'applications.business_role',
                'applications.business_name',
                'users.email',
                'users.ic',
                'applications.application_status'
            );

        $sort = strtolower($request->input('sort', 'all'));

        if ($sort !== 'all') {
            switch ($sort) {
                case 'active':
                    $query->where('applications.application_status', 'Active');
                    break;
                case 'inactive':
                    $query->where('applications.application_status', 'Inactive');
                    break;
                case 'rejected':
                    $query->where('applications.application_status', 'Rejected');
                    break;
                case 'new':
                    $query->where('applications.application_status', 'New');
                    break;
            }
        }

        // Search logic based on the search query
        $searchQuery = $request->input('search');
        if ($searchQuery) {
            $query->where(function ($subquery) use ($searchQuery) {
                $subquery->where('users.name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('applications.business_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.email', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.ic', 'like', '%' . $searchQuery . '%');
            });
        }

        // Execute the query with pagination
        $kioskApplications = $query->paginate(10); // Adjust the number as per your requirement

        // Pass the data to the view along with the current sorting option and search query
        return view('manageKiosk.manageApplication.KioskApplication', [
            'kioskApplications' => $kioskApplications,
            'currentSort' => $sort,
            'currentSearch' => $searchQuery,
        ]);
    }



    public function viewApplicationApproval($id)
    {
        // Fetch application details along with user details
        $application = Applications::findOrFail($id);
        $user = $application->user;

        return view('manageKiosk.manageApplication.KioskApproval', ['application' => $application, 'user' => $user]);
    }

    public function processApplication(Request $request, $id)
    {
        $application = Applications::findOrFail($id);

        // Validate the request
        $request->validate([
            'application_comment' => 'nullable|string',
        ]);

        // Update application status and comment
        $application->update([
            'application_status' => ($request->input('action') === 'approve') ? 'Active' : 'Rejected',
            'application_comment' => $request->input('application_comment'),
        ]);

        if ($request->input('action') === 'approve') {
            // Create a new kiosk record
            $kiosk = new Kiosk([
                'kiosk_id' => 'K' . $application->user_id . '-' . time(),
                'application_id' => $application->application_id,
                'user_id' => $application->user_id,
            ]);

            // Save the kiosk
            $kiosk->save();
        }

        return redirect()->route('pupuk.viewKioskApplication', ['id' => $id])->with('success', 'Application processed successfully.');
    }

    public function viewApplication($id)
    {
        // Fetch application details along with user details
        $application = Applications::findOrFail($id);
        $user = $application->user;

        return view('manageKiosk.manageParticipant.ViewActiveParticipant', ['application' => $application, 'user' => $user]);
    }
}
