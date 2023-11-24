<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Application;
use App\Models\Wali;
use App\Models\Witness;
use App\Models\Spouse;
use App\Models\Applicant;
use App\Models\User;

class ApplicationController extends Controller
{
    public function create(){
        $user = auth()->user();
        return view('manageRegister.create', compact('user'));
    }
    public function manageUser(){
        $user_id = auth()->user()->id;
        $id = Applicant::where('user_id',$user_id)->first()->id;
        $datas = Application::with('applicant','spouse','wali','witness')->where('applicant_id',$id)->paginate(10);
        return view('manageRegister.manageUser', compact('datas'));
    }
    public function payment(Request $request){
        $user = ([
            'name' => $request->applicant_name,
            'email' =>  $request->applicant_email,
            'contact' => $request->applicant_phoneNo,
        ]);
        User::where('id', Auth()->user()->id)->update($user);
        
        $applicant = Applicant::where('user_id', Auth()->user()->id)->first();
        $applicant->birthdate = $request->applicant_birthdate;
        $applicant->nationality = $request->applicant_nationality;
        $applicant->save();
        $existingSpouse = Spouse::where('ic', $request->spouse_IcNum)->first();
        
        if ($existingSpouse) {
            $spouse = $existingSpouse;
        } else {
            $spouse = new Spouse();
            $spouse->ic = $request->spouse_IcNum;
        }
        
        $spouse->name = $request->spouse_name;
        $spouse->birthdate = $request->spouse_birthdate;
        $spouse->email = $request->spouse_email;
        $spouse->gender = $request->spouse_gender;
        $spouse->phonenumber = $request->spouse_phoneNo;
        $spouse->nationality = $request->spouse_nationality;
        $spouse->save();
        
        $wali = new Wali();
        $wali->name = "wali_name";
        $wali->phonenumber = "wali_number";
        $wali->address = "wali_address";
        $wali->relationship = "wali_relationship";
        $wali->save();
        
        $witness = new Witness();
        $witness->name = "witness_name";
        $witness->phonenumber = "witness_number";
        $witness->save();

        $application = ([
            'wali_id' => $wali->id,
            'witness_id' => $witness->id,
            'spouse_id' => $spouse->id,
            'applicant_id' => $applicant->id,
        ]);

        Application::create($application);
        return view('manageCard.uploadPayment');
        
        // return redirect()->route('user.consultation.manage')
        //     ->with('success', "consultation Successfully Posted!");
    }
    public function store(Request $request)
    {
    }
    public function manReg()
    {
        $datas = Application::paginate(8);
        return view('manageRegister.manage', compact('datas'));
    }


    public function manageMarReq()
    {
        $datas = Application::paginate(3);
        return view('manageMarReq.manageMarReq', compact('datas'));
    }

    public function createMarReq()
    {
        $datas = Application::paginate(3);
        return view('manageMarReq.manageMarReq', compact('datas'));
    }

    public function storeMarReq(Request $request)
    {
        $applicant = ([
            'user_id' => Auth()->user()->id,
        ]);

        $app = new Applicant();
        $app->fill($applicant);
        $app->save();
        // Applicant::create($applicant);
        $spouse = ([
            'id' => $request->id,
        ]);
        $sp = new Spouse();
        $sp->fill($spouse);
        $sp->save();

        $application = ([
            'sp_id' => $sp->id
        ]);
        Application::create($application);

        return redirect()->route('user.application.manageMarReq')
            ->with('success', "Successfully Posted!");
    }

}
