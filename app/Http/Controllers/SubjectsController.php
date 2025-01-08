<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function mvregisterpage(Request $request){
        return view('registersubject');
    }
}
