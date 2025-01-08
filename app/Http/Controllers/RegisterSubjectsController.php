<?php

namespace App\Http\Controllers;
use App\Models\subject;

use Illuminate\Http\Request;

class RegisterSubjectsController extends Controller
{
    //
    public function getSubject(){
        $items=subject::with(['teacher','detail']) ->get();
        return view('registersubject',[
            'subject'=> $items,
        ]);
    }
}
