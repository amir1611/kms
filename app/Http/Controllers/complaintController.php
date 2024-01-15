<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Complaint;
use App\Models\Kiosk;

//  @foreach($kiosks as $kiosk)
// <option value="{{ $kiosk->id }}">1</option>
// @endforeach

class complaintController extends Controller
{
      //function for kiosk participant create complaint
    public function createComplaint(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'business_create_complaint' => 'required|date',
            'business_name' => 'required|string',
            'complaint_category' => 'required|string',
            'complaint_information' => 'required|string',
            // 'complaint_justification' => 'required|string',
            // 'status' => 'required|string',
            // 'work_order' => 'required|string',
        ]);

        // Assuming you have a Complaint model
        $complaint = new Complaint();
        $complaint->date_of_filling_form = $validatedData['business_create_complaint'];
        $complaint->business_name = $validatedData['business_name'];
        $complaint->complaint_category = $validatedData['complaint_category'];
        $complaint->complaint_information = $validatedData['complaint_information'];
        $complaint->complaint_justification = 'in progress';
        $complaint->status = 'in progress';
        $complaint->work_order = 'in progress';

        // Assuming you have user authentication and want to associate the complaint with the authenticated user
        $complaint->user_id = auth()->user()->id;

        // Save the complaint to the database
        $complaint->save();

        // Optionally, you can redirect the user after submitting the form
        return redirect()->route('user.viewComplaint')->with('success', 'Complaint submitted successfully');
    }

    public function viewAllComplaint()
    {
        $complaints = Complaint::all();

        // $kiosks = Kiosk::where('user_id', auth()->user()->id)->get();
        // $complaints = auth()->user()->complaints;
        return view('manageComplaint.fkTechnical.viewAllComplaint', ['complaints' => $complaints]);
    }
    public function viewComplaint()
    {
        //$complaints = Complaint::all();

        $complaints = auth()->user()->complaints;
        return view('manageComplaint.kioskParticipant.viewComplaint', ['complaints' => $complaints]);
    }

    public function editComplaint($id)
    {
        // Fetch the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Return the view for editing the complaint
        return view('manageComplaint.kioskParticipant.editComplaint', ['complaint' => $complaint]);
    }

    public function deleteComplaint($id)
    {
        // Find the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Delete the complaint
        $complaint->delete();

        // Optionally, you can redirect the user after deletion
        return redirect()->route('user.viewComplaint')->with('success', 'Complaint deleted successfully');
    }

    public function updateComplaint(Request $request, $id)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string',
            'complaint_category' => 'required|string',
            'complaint_information' => 'required|string',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->business_name = $validatedData['business_name'];
        $complaint->complaint_category = $validatedData['complaint_category'];
        $complaint->complaint_information = $validatedData['complaint_information'];
        $complaint->save();

        return redirect()->route('user.viewComplaint')->with('success', 'Complaint updated successfully');
    }

    public function addComplaint()
    {
        return view('manageComplaint.kioskParticipant.createComplaint');
    }

    public function viewUpdateAllComplaint(){
        $complaints = Complaint::all();

        // $kiosks = Kiosk::where('user_id', auth()->user()->id)->get();
        // $complaints = auth()->user()->complaints;
        return view('manageComplaint.admin.viewUpdateAllComplaint', ['complaints' => $complaints]);

    }

    //function for technical edit
    public function fkeditComplaint($id)
    {
        // Fetch the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Return the view for editing the complaint
        return view('manageComplaint.fkTechnical.fkupdate', ['complaint' => $complaint]);
    }


    //function for technical update
    public function fkupdateComplaint(Request $request, $id)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string',
            'complaint_category' => 'required|string',
            'complaint_information' => 'required|string',
            'complaint_justification' => 'string', // Add any validation rules as needed
            'status' => 'required|in:Accepted,Rejected,Pending',
            'work_order' => 'string', // Add any validation rules as needed
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->business_name = $validatedData['business_name'];
        $complaint->complaint_category = $validatedData['complaint_category'];
        $complaint->complaint_information = $validatedData['complaint_information'];
        $complaint->complaint_justification = $validatedData['complaint_justification'];
        $complaint->status = $validatedData['status'];
        $complaint->work_order = $validatedData['work_order'];
        $complaint->save();

        return redirect()->route('technical.viewAllComplaint')->with('success', 'Complaint updated successfully');
    }


}
