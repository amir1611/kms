<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\applications;
use App\Models\Kiosk;
use App\Models\User;



class KioskController extends Controller
{


    //To display Kiosk Application form and and redirect to relevant view page
    public function showApplyKioskForm()
    {
        $user = Auth::user();

        // Check if the user has an application
        $application = Applications::where('user_id', $user->id)->first();

        if (!$application) {
            // Scenario 1: User doesn't have any application_id
            $application = new Applications(); // Create an empty application object
            return view('manageKiosk.manageApplication.ApplyKiosk', compact('application'));
        }

        switch ($application->application_status) {
            case 'New':
                // Scenario 2: User has application_id with application_status "New"
                return view('manageKiosk.manageApplication.PendingApproval', compact('application'));
            case 'Active':
                // Scenario 3: User has application_id with application_status "Active"
                return view('manageKiosk.manageApplication.EditKiosk', compact('application'));
            case 'Inactive':
                // Scenario 4: User has application_id with application_status "Inactive"
                return view('manageKiosk.manageApplication.ApplyKiosk', compact('application'));
            case 'Rejected':
                // Scenario 5: User has application_id with application_status "Rejected"
                // You can pass the application_comment to the view if needed
                return view('manageKiosk.manageApplication.RejectedApplication', compact('application'));
            default:
                // Handle other scenarios if needed
                return abort(404); // Example: Page not found
        }
    }







    //To update kiosk information
    public function updateKiosk(Request $request, $id)
    {
        // Validate and update the application data
        $request->validate([
            'business_name' => 'required|string',
            'business_role' => 'required|string',
            'business_category' => 'required|string',
            'business_information' => 'required|string',
            'business_operating_hour' => 'required|string',

        ]);

        // Update application data
        $application = Applications::findOrFail($id);

        $application->update([
            'business_name' => $request->input('business_name'),
            'business_role' => $request->input('business_role'),
            'business_category' => $request->input('business_category'),
            'business_information' => $request->input('business_information'),
            'business_operating_hour' => $request->input('business_operating_hour'),

        ]);

        // Pass the updated application data to the view
        return view('manageKiosk.manageApplication.EditKiosk', ['application' => $application])
            ->with('success', 'Kiosk information updated successfully.');
    }






    //To reject Kiosk Application
    public function rejectApplication()
    {
        return view('manageKiosk.manageApplication.ApplyKiosk');
    }







    //To apply for kiosk 
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

            $ssmPdfPath = $request->file('ssm_pdf')->storeAs('applications', 'ssm_' . time() . '.pdf', 'public');
            $businessProposalPdfPath = $request->file('business_proposal_pdf')->storeAs('applications', 'proposal_' . time() . '.pdf', 'public');

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
        $kioskApplications = $query->paginate(10);

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
        $maxActiveApplications = 5; // Set the maximum number of active applications

        // Find the existing active applications
        $activeApplicationsCount = Applications::where('application_status', 'Active')->count();

        // Validate the number of active applications
        if ($request->input('action') === 'approve' && $activeApplicationsCount >= $maxActiveApplications) {
            return redirect()->route('pupuk.viewKioskApplication')->with('error', 'We have reached the maximum number of kiosk participants.');
        }

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








    public function viewKioskParticipant(Request $request)
    {
        // Fetch kiosk applications data from the applications table and related user and kiosk data
        $query = Kiosk::join('applications', 'kiosks.application_id', '=', 'applications.application_id')
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->select(
                'applications.application_id',
                'users.name',
                'applications.business_role',
                'applications.business_name',
                'users.email',
                'users.ic',
                'kiosks.id as kiosk_id',
                'applications.application_status'
            )
            ->where('applications.application_status', 'Active'); // Filter only 'Active' applications

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
        $kioskApplications = $query->paginate(10);

        // Pass the data to the view along with the current search query
        return view('manageKiosk.manageParticipant.KioskParticipant', [
            'kioskApplications' => $kioskApplications,
            'currentSearch' => $searchQuery,
        ]);
    }





    public function deleteKiosk($id)
    {
        // Find the kiosk by id and delete it
        Kiosk::find($id)->delete();

        // Update the corresponding application_status to 'Inactive'
        applications::where('id', $id)->update(['application_status' => 'Inactive']);

        // Redirect back or wherever you want
        return redirect()->back()->with('success', 'Kiosk deleted successfully.');
    }




    public function updateApplicationStatus($id)
    {
        // Find the application by id and update its status to 'Inactive'
        applications::where('application_id', $id)->update(['application_status' => 'Inactive']);

        // Redirect back or wherever you want
        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
}
