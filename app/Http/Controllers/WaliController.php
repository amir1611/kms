<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wali;

class WaliController extends Controller
{
    public function index(){

    }
    public function manage(){
        
    }
    public function create(){
        
    }
    public function store(Request $request){
        Wali::create($request->all());
        // dd($request);
        return redirect()->route('user.register.create')->with('success', "Wali added");
    }
    public function update(){
        
    }
    public function edit(){
        
    }
    public function show(){
        
    }
    public function destroy(){
        
    }
}
