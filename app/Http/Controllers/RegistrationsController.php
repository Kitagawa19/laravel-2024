<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\registration;

class RegistrationsController extends Controller
{
    //
    public function index(){
        $userId=Auth::id();
        $registrations=registration::with(['subject', 'subject.teacher', 'subject.detail'])
        ->where('user_id',$userId)
        ->get();
        return view('dashboard', compact('registrations'));
    }
}
