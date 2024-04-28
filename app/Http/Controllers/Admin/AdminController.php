<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LeaveApplication;

class AdminController extends Controller
{
    public function index() {
        $total_application = LeaveApplication::count();
        $pending_application = LeaveApplication::where('status','pending')->count();
        $approved_application = LeaveApplication::where('status','approve')->count();
        $rejected_application = LeaveApplication::where('status','reject')->count();
        return view('admin.dashboard', compact('total_application','pending_application','approved_application','rejected_application'));
    }
    public function employeeList() {
        $employees = User::where('user_type','user')->latest()->get();
        return view('admin.employee.index', compact('employees'));
    }

    public function activeNow($id)
    {
        
        try {
            User::findOrFail($id)->update([
                'isActive' => 1
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Updated'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function inactiveNow($id)
    {
        try {
            User::findOrFail($id)->update([
                'isActive' => 0
            ]);
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Updated'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

}
