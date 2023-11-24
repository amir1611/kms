<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Spouse;
use App\Models\Application;
class SpouseController extends Controller
{
    public function index(){

    }
    public function manage(){
        
    }
    public function create(){
        
    }
    public function store(){
        
    }
    public function update(){
        
    }
    public function edit(){
        
    }
    public function show(){
        
    }
    public function destroy(){
        
    }
    public function spouseList(){
        $user_id = auth()->user()->id;
        $id = Applicant::where('user_id',$user_id)->first()->id;
        $datas = Application::with('applicant','spouse','wali','witness')->where('applicant_id',$id)->paginate(10);
        return view('manageRegister.spouseList', compact('datas'));
    }
}
