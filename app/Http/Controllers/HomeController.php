<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexUser()
    {
        return view('manageProfile.userprofile');
    }

    public function monthlyReportList()
    {
        return view('manageReport.viewMonthlyReportList');
    }

    public function uploadMonthlyReport()
    {
        return view('manageReport.uploadMonthlyReport');
    }


    public function indexPupukAdmin()
    {
        return view('manageProfile.pupukadminprofile');
    }

    public function indexAdmin()
    {
        return view('manageProfile.adminprofile');
    }

    public function indexFKTechnical()
    {
        return view('manageProfile.fkTechnicalprofile');
    }

    public function indexFKBursary()
    {
        return view('manageProfile.fkbursaryprofile');
    }


    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // dd($request);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
