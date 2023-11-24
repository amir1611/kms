<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marriage_card;
use App\Models\Application;
class MarriageCardController extends Controller
{
    public function manage(){
        
        $datas = Application::paginate(10);
        return view('manageCard.manage', compact('datas'));
    }
    public function index(){

    }
    public function create(){
        $user = auth()->user();
        return view('manageCard.create', compact('user'));
    }
    public function manageUser(){
        $datas = Application::paginate(10);
        return view('manageCard.manageUser', compact('datas'));
    }
    public function store(Request $request){
        Marriage_card::create($request->all());
        // dd($request);
        return redirect()->route('user.card.create')->with('success', "Card successfully request");
    }
    public function update(){
        
    }
    public function edit(){
        
    }
    public function show(){
        
    }
    public function destroy(){
        
    }
    public function accept(){

    }
    public function reject(){

    }
    public function payment(){
        return view('manageCard.uploadPayment');
    }
}
