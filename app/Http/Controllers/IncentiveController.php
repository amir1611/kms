<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Incentive;

class IncentiveController extends Controller
{
    //function to view application form page
    public function indexInc()
    {
        return view('manageIncentive.apply');
    }

    //function to view application for staff
    public function view()
    {
        $data_incentive = \App\Models\Incentive::all();
        return view('manageIncentive.view',['data_incentive'=> $data_incentive]);
    }

    //function to insert to database the application details
    public function insert(Request $request)
	{
		Incentive::insert($request->except(['_token']));
		return redirect()->back()->with('success', 'Your application has been sent.');
	}

    //function to delete application 
    public function delete($id){
        $data_incentive = \App\Models\Incentive::find($id);
        $data_incentive -> delete($data_incentive);
        return redirect('manageIncentive.view') -> with('success','Data Deleted Succesfully');
    }

    //function to view application status for user
    public function view2()
    {
        $data_incentive = \App\Models\Incentive::all();
        return view('manageIncentive.update',['data_incentive'=> $data_incentive]);
    }
}
