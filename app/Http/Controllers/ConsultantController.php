<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant;
use App\Models\Reference;

class ConsultantController extends Controller
{
    //redirect staff to staff.contultant.manage route
    public function index()
    {
        return redirect()->route('staff.consultant.manage');
    }

    //redirect staff to manage consultant page
    public function manage()
    {
        $datas = Consultant::with('location','department')->paginate(10);
        return view('manageConsultant.manage',compact('datas'));
    }
    
    //redirect staff to create consultant page
    public function create()
    {
        $locations = Reference::where('name', 'location')->orderBy('code')->get();
        $departments = Reference::where('name', 'department')->orderBy('code')->get();
        
        return view('manageConsultant.create', compact('locations','departments'));
    }

    //store the newly create consultant to database
    public function store(Request $request)
    {
        $request->merge([
            'created_by' => Auth()->user()->id,
        ]);
        Consultant::create($request->all());
        // dd($request);
        return redirect()->route('staff.consultant.manage')
            ->with('success', "consultant Successfully Added");
    }

    //update the consultant info in the database
    public function update(Request $request, $id)
    {
        Consultant::find($id)->update($request->all());
        // dd($request);
        return redirect()->route('staff.consultant.manage')
        ->with('success',"consultant Successfully Updated");

    }
    
    //redirect staff to edit consultant page
    public function edit($id)
    {
        $consultant = Consultant::find($id)->with('location','department')->first();
        $locations = Reference::where('name', 'location')->orderBy('code')->get();
        $departments = Reference::where('name', 'department')->orderBy('code')->get();
        
        return view('manageConsultant.edit', compact('locations','departments','consultant'));

    }

    //redirect staff to show consultant page
    public function show($id)
    {
        $consultant = Consultant::find($id)->with('location','department')->first();
        
        return view('manageConsultant.show', compact('consultant'));
    }

    //delete consultant
    public function destroy($id)
    {
        $consultant = Consultant::find($id);
        
        if (!$consultant) {
            return redirect()->back()->with('error', 'consultant not found.');
        }
        
        $consultant->delete();
        
        return redirect()->route('staff.consultant.manage')->with('success', 'consultant deleted successfully.');
    }
}
