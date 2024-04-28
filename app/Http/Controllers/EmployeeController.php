<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApplication;

class EmployeeController extends Controller
{
    public function index() {
        $authId = Auth::id();
        $total_application = LeaveApplication::where('user_id', $authId)->count();
        $pending_application = LeaveApplication::where('user_id', $authId)->where('status','pending')->count();
        $approved_application = LeaveApplication::where('user_id', $authId)->where('status','approve')->count();
        $rejected_application = LeaveApplication::where('user_id', $authId)->where('status','reject')->count();

        return view('employee.dashboard', compact('total_application','pending_application','approved_application','rejected_application'));
    }
}
