<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\User;
use App\Models\Prep_course;
use App\Models\applicantList;
use App\Models\Reference;

class PrepCourseController extends Controller
{

    public function manage()
    {
        $locations = Reference::where('name', 'location')->orderBy('code')->paginate(8);
        // $datas = Prep_course::paginate(3);
        return view('managePrepCourse.manage', compact('locations'));
    }

    public function create($id)
    {
        $user =  Auth()->user();
        return view('managePrepCourse.create', compact('user','id'));
    }

    public function store(Request $request, $id)
    {
        $prepCourse = ([
            'user_id' => Auth()->user()->id,
            'birthdate' => $request->applicant_birthdate,
            'nationality' => $request->applicant_nationality,
            'houseaddress' => $request->applicant_houseaddress,
            'ref_location_id' => $id,
        ]);

        $pCourse = new Prep_course();
        $pCourse->fill($prepCourse);
        $pCourse->save();

        return redirect()->route('user.prepCourse.manage')
            ->with('success', "Successfully Posted!");
    }

    function show()
    {
        $data = applicantList::all();
        return view('applicantList', ['list' => $data]);
    }
}
