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
    public function uploadComplaintData(Request $request)
    {
        try {

            $request->validate([
                'kioskValue' => 'required|numeric',
                'complaint_date' => 'required|string',
                'business_name' => 'required|string',
                'complaint_about' => 'required|string',
                'complaint_description' => 'required|string',


            ]);



            $complaint = new Complaint([
                'kiosk_id' => $request->input('kioskValue'),
                'complaint_date' => $request->input('monthPicker'),

                'complaint_status' => 'Pending',
                'complaint_description' => '',
            ]);


            $complaint->save();


            return redirect()->route('user.complaintList');
        } catch (\Throwable $th) {
            return view('error', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function showKioskListById()
    {
        $kiosks = Kiosk::where('user_id', auth()->user()->id)->get();
        return view('manageComplaint.viewAllComplaint', [
            'kiosks' => $kiosks
        ]);
    }

    public function viewAllComplaint()
    {
        // Assume have user authentication and want to retrieve complaint
        $userId = auth()->user()->id;

        // Retrieve complaints for the authenticated user
        $complaints = Complaint::join('kiosks', 'complaints.id', '=', 'kiosks.kiosk_id')
        ->where('kiosks.user_id', $userId)
        ->select(
            'complaints.*'
        )->get();

        return view('manageComplaint.viewAllComplaint', ['complaints' => $complaints]);
    }
}
